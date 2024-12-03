<?php

namespace App\Models;

use App\Models\Iso27\GapDosCatalogoIso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBControlRiskAnalysisModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'risk_analysis_controls';

    protected $fillable = [
        'id',
        'control_id',
        'applicability',
        'is_apply',
        'justification',
        'file',
    ];

    public function control()
    {
        return $this->hasOne(GapDosCatalogoIso::class, 'id', 'control_id');
    }
}
