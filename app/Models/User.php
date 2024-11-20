<?php

namespace App\Models;

use App\Notifications\MyResetPassword;
use App\Traits\ClearsResponseCache;
use Auth;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Stancl\Tenancy\Facades\Tenancy;

class User extends Authenticatable implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $table = 'users';

    protected $connection;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        self::created(function (self $user) {
            $registrationRole = config('panel.registration_default_role');

            if ($registrationRole && !$user->roles()->get()->contains($registrationRole)) {
                $user->roles()->attach($registrationRole);
            }
        });
    }

    protected $hidden = [
        'remember_token',
        'two_factor_code',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];

    protected $fillable = [
        'id',
        'name',
        'n_empleado',
        'email',
        'email_verified_at',
        'two_factor',
        'password',
        'two_factor_code',
        'approved',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'created_at',
        'organizacion_id',
        'area_id',
        'puesto_id',
        'updated_at',
        'deleted_at',
        'team_id',
        'two_factor_expires_at',
        'is_active',
        'empleado_id',
    ];

    //Redis methods
    public static function getExists()
    {
        return Cache::remember('Users:users_exists', 3600 * 12, function () {
            return DB::table('users')->orderBy('id')->first()->empleado_id != null ? true : false;
        });
    }

    public static function getAll()
    {
        return Cache::remember('Users:users_all', 3600 * 13, function () {
            return self::select('id', 'name', 'n_empleado', 'email', 'approved', 'verified', 'organizacion_id', 'area_id', 'puesto_id', 'is_active', 'empleado_id')->get();
        });
    }

    public static function getAllWithEmpleado()
    {
        return Cache::remember('Users:users_with_empleado', 3600 * 13, function () {
            return self::select('id', 'name', 'n_empleado', 'email', 'approved', 'verified', 'organizacion_id', 'area_id', 'puesto_id', 'is_active', 'empleado_id')
                ->with('empleado')
                ->get();
        });
    }

    public static function getUserWithRole()
    {
        return Cache::remember('Users:user_with_role', 3600 * 12, function () {
            return self::with('roles', 'empleado.puesto', 'organizacion')->get();
        });
    }

    public static function getCurrentUser()
    {
        if (! Auth::check()) {
            return null; // or handle the unauthenticated case as needed
        }

        $cacheKey = 'Auth_user:user' . Auth::user()->id;

        return Cache::remember($cacheKey, now()->addMinutes(60), function () {
            return Auth::user();
        });
    }

    // public static function getCurrentUser()
    // {
    //     if (!Auth::check()) {
    //         return null;
    //     }

    //     $tenant = tenancy()->tenant;
    //     if (!$tenant) {
    //         throw new \Exception('No tenant initialized.');
    //     }

    //     $tenantPrefix = $tenant->getTenantKey();
    //     $cacheKey = $tenantPrefix . ':Auth_user:user' . Auth::user()->id;
    //     $databaseName = DB::connection()->getDatabaseName();
    //     //dd($cacheKey, $tenantPrefix, $tenant, Auth::user(), $databaseName);
    //   h::  return Cache::remember($cacheKey, now()->addMinutes(60), function () {
    //         return Autuser();
    //     });
    // }

    public function empleado()
    {
        if ($this->empleado_id != null) {
            return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->alta();
        } else {
            return $this->belongsTo(Empleado::class, 'n_empleado', 'n_empleado')->alta();
        }
    }

    //Funcion para capacitaciones devuelve pocos datos
    public function profesor()
    {
        if ($this->empleado_id != null) {
            return $this->belongsTo(Empleado::class, 'empleado_id', 'id')->select('id', 'name', 'foto', 'email', 'n_empleado')->alta();
        } else {
            return $this->belongsTo(Empleado::class, 'n_empleado', 'n_empleado')->select('id', 'name', 'foto', 'email', 'n_empleado')->alta();
        }
    }

    //empleadoId attribute
    public function getEmpleadoIdAttribute($value)
    {
        return $value ? $value : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    /*public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }*/
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function organizacion()
    {
        return $this->belongsTo(Organizacione::class, 'organizacion_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    //# Get empleado_id
    public function getEmpleadoId()
    {
        return $this->empleado_id;
    }

    public function nEmpleado()
    {
        return $this->belongsTo(Empleado::class, 'n_empleado', 'n_empleado')->alta();
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\esculea\Review');
    }
}