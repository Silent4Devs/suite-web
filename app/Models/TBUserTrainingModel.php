<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBUserTrainingModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'user_training';

    protected $fillable = [
        'id',
        'type_id',
        'name_id',
        'start_date',
        'end_date',
        'credential_id',
        'credential_url',
        'isChecked',
        'validity',
        'validityStatus',
        'evidence_id',
        'empleado_id',
    ];

    public function category()
    {
        return $this->belongsTo(TBTypeCatalogueTrainingModel::class, 'type_id');
    }

    public function getName()
    {
        return $this->belongsTo(TBCatalogueTrainingModel::class, 'name_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
