<?php

namespace App\Models\Tenant;

use App\Models\Tenant\TbTenantsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class TbTenantUserModel extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'tenant_Id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    public $incrementing = true;

    protected $keyType = 'int';

    /**
     * Método para obtener el tenant asociado mediante el id.
     *
     * @return TbTenantsModel|null
     */
    public function tenant()
    {
        return $this->belongsTo(TbTenantsModel::class, 'tenant_Id', 'id')
            ->when($this->email, function ($query, $email) {
                $query->where('email', $email);
        });
    }
}
