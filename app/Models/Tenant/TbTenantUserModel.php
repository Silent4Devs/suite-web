<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TbTenantUserModel extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'users_tenant';

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
}