<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use ClearsResponseCache, HasFactory;

    protected $table = 'monedas';

    protected $fillable = ['nombre'];
}
