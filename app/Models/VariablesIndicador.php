<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariablesIndicador extends Model
{
	use SoftDeletes;
	protected $table = 'variables_indicadors';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


	protected $fillable = [
		'variable',
		'valor',
	];

}
