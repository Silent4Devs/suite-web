<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSettingsTemplateAR_TBFormulaTemplateARModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'settings_template_ar_formulas_templates_ar_pivote_table';

    protected $fillable = [
        'id',
        'template_id',
        'formula_id',
        'is_show',
    ];

    public function formula()
    {
        return $this->belongsTo(TBFormulaTemplateAnalisisRiesgoModel::class, 'formula_id');
    }
}
