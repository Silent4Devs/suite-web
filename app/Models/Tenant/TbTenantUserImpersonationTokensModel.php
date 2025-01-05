<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TbTenantUserImpersonationTokensModel extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'tenant_user_impersonation_tokens';

    protected $primaryKey = 'token';

    protected $fillable = [
        'token',
        'tenant_id',
        'user_id',
        'auth_guard',
        'redirect_url',
    ];

    protected $hidden = [
        // 'token',
    ];

    protected $dates = [
        'created_at',
    ];

    // public $incrementing = true;

    // protected $keyType = 'int';

}
