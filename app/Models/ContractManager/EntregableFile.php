<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntregableFile extends Model
{
    use ClearsResponseCache, HasFactory, softDeletes;

    public $table = 'entregables_files';

    protected $dates = ['deleted_at'];

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'pdf',
        'entregable_id',
        'created_by',
        'updated_by',
    ];
}
