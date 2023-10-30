<?php

namespace App\Models;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubcategoriaIncidente extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable, ClearsResponseCache;

    protected $table = 'subcategorias_incidentes';

    protected $guarded = [
        'id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaIncidente::class, 'categoria_id', 'id');
    }
}
