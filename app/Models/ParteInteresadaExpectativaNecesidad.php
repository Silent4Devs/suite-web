<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ParteInteresadaExpectativaNecesidad extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'interesadas_nececidades_expectativas';
    // protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'necesidades',
        'expectativas',
        'id_interesada',
        'created_at',
        'updated_at',
    ];

    public function interesada()
    {
        return $this->belongsTo(PartesInteresada::class, 'id_interesada', 'id');
    }

    public function normas()
    {
        return $this->belongsToMany(Norma::class, 'normas_nececidades_expectativas', 'id_necesidad_expectativa', 'id_norma');
    }
}
