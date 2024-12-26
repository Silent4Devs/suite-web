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

    // Puedes ayudarme, estoy usando laravel 11 y necesito relacionar 2 tablas a traves de una tercera que puede servir como pivote, las 3 comparten un campo llamado tenant_id, la primera y la segunda deben relacionarse a traves del campo email, la primera y la tercera(pivote) se relacionan a traves del id (id en la primera, user_id en la tercera); y la segunda y la tercera(pivote) se relacionan a traves del id igualmente (id en la segunda, tenant_id en la tercera)
    // public function tenantUser(){
    //     return $this->hasOneThrough(TbTenantsModel::class, TbTenantUserImpersonationTokensModel::class, 'user_id', 'id', 'id', 'tenant_id');
    // }
}
