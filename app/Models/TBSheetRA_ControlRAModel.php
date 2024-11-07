<?php

namespace App\Models;

use App\Models\Iso27\GapDosCatalogoIso;
use App\Models\TBControlRiskAnalysisModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBSheetRA_ControlRAModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'ra_sheets_ar_controls_pivote';

    protected $fillable = [
        'id',
        'sheet_id',
        'control_sheet_id',
    ];

    public function controlSheet()
    {
        return $this->hasOne(TBControlRiskAnalysisModel::class,'id','control_sheet_id');
    }

}
