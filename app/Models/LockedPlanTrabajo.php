<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LockedPlanTrabajo extends Model
{
    use HasFactory;

    protected $table = 'locked_plan_trabajos';
    protected $dates = ['locked_to'];
    protected $fillable = [
        'locked_to',
        'blocked',
        'locked_by',
    ];
}
