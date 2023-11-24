<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SubcategoriaIncidente extends Model implements Auditable
{
    use ClearsResponseCache, \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = 'subcategorias_incidentes';

    protected $guarded = [
        'id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaIncidente::class, 'categoria_id', 'id');
    }
}
