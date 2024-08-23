<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBCatalogueTrainingModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'catalogue_training';

    protected $fillable = [
        'id',
        'name',
        'issuing_company',
        'mark',
        'manufacturer',
        'norma',
        'type_id',
        'status',
        'empleado_id',
    ];

    public function category()
    {
        return $this->belongsTo(TBTypeCatalogueTrainingModel::class, 'type_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
