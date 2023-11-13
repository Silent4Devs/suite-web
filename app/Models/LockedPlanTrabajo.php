<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LockedPlanTrabajo extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'locked_plan_trabajos';

    protected $dates = ['locked_to'];

    protected $fillable = [
        'locked_to',
        'blocked',
        'locked_by',
    ];
}
