<?php

namespace App\Models;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use OwenIt\Auditing\Contracts\Auditable;

class Tenant extends BaseTenant implements TenantWithDatabase, Auditable
{
    use HasDatabase, HasDomains;
    use \OwenIt\Auditing\Auditable;
}
