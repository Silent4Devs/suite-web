<?php

namespace App\Models\ContractManager;

use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConveniosModificatorios extends Model implements Auditable
{
    public $table = 'convenios_modificatorios';

    protected $appends = ['archivo'];

    use HasFactory, softDeletes, ClearsResponseCache;
    use AuditableTrait;

    protected $fillable = [
        'contrato_id',
        'no_convenio',
        'fecha',
        'descripcion',
        'created_by',
        'updated_by',
    ];

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }

    public function modificados()
    {
        return $this->belongsTo(self::class, 'contrato_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(ConveniosModificatoriosFile::class, 'convenios_modificatorios_id', 'id');
    }

    public function getArchivoAttribute()
    {
        $archivo = ConveniosModificatoriosFile::where('convenios_modificatorios_id', $this->id)->first();
        $archivo = $archivo ? $archivo->pdf : '';
        $ruta = asset('storage/contratos/' . $this->contrato->id . '_contrato_' . $this->contrato->no_contrato . '/convenios/pdf');
        $ruta = $ruta . '/' . $archivo;

        return $ruta;

        // storeAs('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/convenios/pdf/', $convenios->id.$convenios_filename);

        // $this->convenios_file->storeAs('public/contratos/'.$contrato->id.'_contrato_'.$contrato->no_contrato.'/convenios/pdf'.$convenios->id.$convenios_filename);
    }
}
