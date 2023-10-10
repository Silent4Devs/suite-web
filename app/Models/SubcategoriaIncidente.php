<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SubcategoriaIncidente extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subcategorias_incidentes';

    protected $guarded = [
        'id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaIncidente::class, 'categoria_id', 'id');
    }
}
