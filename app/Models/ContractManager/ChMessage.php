<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
class ChMessage extends Model implements Auditable
{
    use ClearsResponseCache;
    use \OwenIt\Auditing\Auditable;
}
