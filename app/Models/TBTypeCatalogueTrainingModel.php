<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBTypeCatalogueTrainingModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'type_catalogue_training';

    protected $fillable = [
        'id',
        'name',
        'default',
    ];

    public function catalogue()
    {
        return $this->hasMany(TBCatalogueTrainingModel::class, 'type_id')->where('status', 'approved');
    }
}
