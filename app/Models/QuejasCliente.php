<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class QuejasCliente extends Model
{
	use SoftDeletes;
	protected $table = 'quejas_clientes';

	protected $casts = [
		'area_quejado_id' => 'int',
		'colaborador_quejado_id' => 'int',
		'proceso_quejado_id' => 'int'
	];

    protected $dates = [
        'fecha',
        'fecha_cierre',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

	protected $fillable = [
        'cliente_id',
        'proyectos_id',
		'nombre',
		'puesto',
		'telefono',
		'correo',
		'estatus',
		'area_quejado',
		'colaborador_quejado',
		'proceso_quejado',
		'otro_quejado',
		'titulo',
		'fecha',
		'fecha_cierre',
		'ubicacion',
		'descripcion',
		'comentarios'
	];

    protected $appends = [
        'folio'
    ];

    public function getFolioAttribute()
    {
        return  sprintf('QUE-%04d', $this->id);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

	public function area()
	{
		return $this->belongsTo(Area::class, 'area_quejado_id');
	}

	public function empleado()
	{
		return $this->belongsTo(Empleado::class, 'colaborador_quejado_id');
	}

	public function proceso()
	{
		return $this->belongsTo(Proceso::class, 'proceso_quejado_id');
	}

    public function cliente()
	{
		return $this->belongsTo(TimesheetCliente::class, 'cliente_id');
	}

    public function proyectos()
	{
		return $this->belongsTo(TimesheetProyecto::class, 'proyectos_id');
	}


    public function analisis()
    {
        return $this->hasMany(AnalisisQuejasClientes::class, 'quejas_clientes_id', 'id');
    }

    public function evidencias_quejas()
    {
        return $this->hasMany(EvidenciaQuejasClientes::class, 'quejas_clientes_id');
    }

    public function cierre_evidencias()
    {
        return $this->hasMany(EvidenciasQuejasClientesCerrado::class, 'quejas_clientes_id');
    }

    public function planes()
    {
        return $this->morphToMany(PlanImplementacion::class, 'plan_implementacionable');
    }

}
