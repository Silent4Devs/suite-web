<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class TbTenantsModel extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tenants';

    protected $primaryKey = 'id';

    protected $hidden = [
        // 'token',
    ];

    protected $dates = [
        'created_at',
    ];

    public function users()
    {
        return $this->hasMany(TbTenantUserModel::class, 'tenant_Id', 'id');
    }
}
