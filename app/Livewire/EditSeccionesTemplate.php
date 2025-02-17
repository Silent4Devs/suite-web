<?php

namespace App\Livewire;

use App\Models\Norma;
use App\Models\ParametrosTemplateAnalisisdeBrechas;
use App\Models\PreguntasTemplateAnalisisdeBrechas;
use App\Models\SeccionesTemplateAnalisisdeBrechas;
use App\Models\TemplateAnalisisdeBrechas;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditSeccionesTemplate extends Component
{
    use LivewireAlert;

    public $id_template;

    public $nombre_template = '';

    public $norma = 0;

    public $descripcion = '';

    public $estatus_1 = '';

    public $estatus_2 = '';

    public $estatus_3 = '';

    public $estatus_4 = '';

    public $valor_estatus_1 = '';

    public $valor_estatus_2 = '';

    public $valor_estatus_3 = '';

    public $valor_estatus_4 = '';

    public $descripcion_parametros_1 = '';

    public $descripcion_parametros_2 = '';

    public $descripcion_parametros_3 = '';

    public $descripcion_parametros_4 = '';

    public $color_estatus_1 = '';

    public $color_estatus_2 = '';

    public $color_estatus_3 = '';

    public $color_estatus_4 = '';

    public $porcentaje_seccion_1;

    public $porcentaje_seccion_2;

    public $porcentaje_seccion_3;

    public $porcentaje_seccion_4;

    public $descripcion_s1;

    public $descripcion_s2;

    public $descripcion_s3;

    public $descripcion_s4;

    public $normas;

    public $pregunta1 = '';

    public $pregunta2 = '';

    public $pregunta3 = '';

    public $pregunta4 = '';

    public $preguntas_s1 = [];

    public $preguntas_s2 = [];

    public $preguntas_s3 = [];

    public $preguntas_s4 = [];

    public $secciones = 1;

    public $posicion_seccion = 1;

    public $datos_seccion = 1;

    public $template;

    public $seccion;

    public $s1;

    public $s2;

    public $s3;

    public $s4;

    public function nextSeccion()
    {
        $this->datos_seccion = $this->posicion_seccion;
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion >= 1 && $this->posicion_seccion < $this->secciones) {
            $this->posicion_seccion++;
        }
    }

    public function backSeccion()
    {
        $this->datos_seccion = $this->posicion_seccion;
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion > 1 && $this->posicion_seccion <= $this->secciones) {
            $this->posicion_seccion--;
        }
    }

    public function addPreguntaSeccion1()
    {
        $this->preguntas_s1[] = '';
    }

    public function removePreguntaSeccion1($index)
    {
        // dd($index);
        unset($this->preguntas_s1[$index]);
        $this->preguntas_s1 = array_values($this->preguntas_s1);
    }

    public function addPreguntaSeccion2()
    {
        $this->preguntas_s2[] = '';
    }

    public function removePreguntaSeccion2($index)
    {
        // dd($index);
        unset($this->preguntas_s2[$index]);
        $this->preguntas_s2 = array_values($this->preguntas_s2);
    }

    public function addPreguntaSeccion3()
    {
        $this->preguntas_s3[] = '';
    }

    public function removePreguntaSeccion3($index)
    {
        // dd($index);
        unset($this->preguntas_s3[$index]);
        $this->preguntas_s3 = array_values($this->preguntas_s3);
    }

    public function addPreguntaSeccion4()
    {
        $this->preguntas_s4[] = '';
    }

    public function removePreguntaSeccion4($index)
    {
        // dd($index);
        unset($this->preguntas_s4[$index]);
        $this->preguntas_s4 = array_values($this->preguntas_s4);
    }

    public function updatedSecciones($value)
    {
        $this->secciones = $value;
        $this->posicion_seccion = 1;
        $this->datos_seccion = 1;

        $this->s1 = [];
        $this->s2 = [];
        $this->s3 = [];
        $this->s4 = [];
        // dd($this->secciones);
    }

    public function mount($id_template)
    {
        $this->id_template = $id_template;
        $template = TemplateAnalisisdeBrechas::with('parametros', 'secciones.preguntas')->find($this->id_template);
        $this->asignarInputs($template);
    }

    public function render()
    {
        // dd($template);
        $this->normas = Norma::get();

        return view('livewire.edit-secciones-template');
    }

    public function asignarInputs($template)
    {
        $this->nombre_template = $template->nombre_template;

        $this->norma = $template->norma_id;

        $this->descripcion = $template->descripcion;

        $this->secciones = $template->no_secciones;

        foreach ($template->parametros as $key => $parametro) {
            $posicion = $key + 1;

            // Construct the variable name by concatenating $posicion to $estatus_
            $estatus_variable_name = 'estatus_'.$posicion;
            $valor_estatus_name = 'valor_estatus_'.$posicion;
            $descripcion_parametros_name = 'descripcion_parametros_'.$posicion;
            $color_estatus_name = 'color_estatus_'.$posicion;

            $this->$estatus_variable_name = $parametro->estatus;
            $this->$valor_estatus_name = $parametro->valor;
            $this->$descripcion_parametros_name = $parametro->descripcion;
            $this->$color_estatus_name = $parametro->color;
        }

        // $secInput = $template->secciones->where('numero_seccion', '=', $this->posicion_seccion);
        $secInput = $template->secciones;
        // dd($secInput);
        foreach ($secInput as $key => $sec) {
            $descripcion_seccion_name = 'descripcion_s'.$sec->numero_seccion;
            $porcentaje_seccion_name = 'porcentaje_seccion_'.$sec->numero_seccion;
            $primera_pregunta_seccion_name = 'pregunta'.$sec->numero_seccion;
            $preguntas_seccion_name = 'preguntas_s'.$sec->numero_seccion;

            $this->$descripcion_seccion_name = $sec->descripcion;
            $this->$porcentaje_seccion_name = $sec->porcentaje_seccion;
            $primpreg = 1;
            $this->$preguntas_seccion_name = [];
            foreach ($sec->preguntas as $key => $preg) {
                if ($primpreg == 1) {
                    $this->$primera_pregunta_seccion_name = $preg->pregunta;
                } else {
                    $this->$preguntas_seccion_name[] = $preg->pregunta;
                }
                $primpreg++;
            }

            // dd($seccion);
        }
    }

    public function submitForm($data)
    {
        $porcentaje = 0;
        $result = [];
        // $this->posicion_seccion++;
        if ($this->posicion_seccion == $this->secciones && $this->datos_seccion == $this->posicion_seccion) {

            // dd($data["descripcion_s" . $this->datos_seccion]);

            $template = TemplateAnalisisdeBrechas::find($this->id_template);
            $template->update([
                'nombre_template' => $data['nombre_template'],
                'norma_id' => $data['norma'],
                'descripcion' => $data['descripcion'],
                'no_secciones' => $this->secciones,
            ]);

            $groupedValues = $this->groupValues($data);

            $borrarColores = ParametrosTemplateAnalisisdeBrechas::where('template_id', '=', $template->id)->delete();

            foreach ($groupedValues as $estatus) {
                // dd($estatus);
                $colores = ParametrosTemplateAnalisisdeBrechas::create([
                    'template_id' => $template->id,
                    'estatus' => $estatus['estatus'],
                    'valor' => $estatus['valor'],
                    'color' => $estatus['color'],
                    'descripcion' => $estatus['descripcion'],
                ]);
            }

            // dd($this->s1, $this->s2);

            $borrarSecciones = SeccionesTemplateAnalisisdeBrechas::where('template_id', '=', $template->id)->delete();

            if ($this->secciones > 1 && $this->secciones <= 4) {
                for ($i = 1; $i < $this->secciones; $i++) {
                    $numeroSeccion = 's'.$i;
                    // dd($this->$numeroSeccion);
                    $this->$numeroSeccion['seccion']['porcentaje_seccion'];
                    $seccion = SeccionesTemplateAnalisisdeBrechas::create([
                        'template_id' => $template->id,
                        'numero_seccion' => $this->$numeroSeccion['seccion']['numero_seccion'],
                        'descripcion' => $this->$numeroSeccion['seccion']['descripcion'],
                        'porcentaje_seccion' => $this->$numeroSeccion['seccion']['porcentaje_seccion'],
                    ]);

                    $porcentaje += $this->$numeroSeccion['seccion']['porcentaje_seccion'];

                    $numero = 1;

                    foreach ($this->$numeroSeccion['preguntas'] as $prg) {
                        $preguntas = PreguntasTemplateAnalisisdeBrechas::create([
                            'seccion_id' => $seccion->id,
                            'pregunta' => $prg,
                            'numero_pregunta' => $numero,
                        ]);
                        $numero++;
                    }
                }

                $porcentaje += $data['porcentaje_seccion_'.$this->datos_seccion];

                if ($porcentaje == 100) {

                    $seccion = SeccionesTemplateAnalisisdeBrechas::create([
                        'template_id' => $template->id,
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data['descripcion_s'.$this->datos_seccion],
                        'porcentaje_seccion' => $data['porcentaje_seccion_'.$this->datos_seccion],
                    ]);

                    $numero = 1;

                    foreach ($data as $key => $value) {
                        if (preg_match('/^pregunta'.$this->secciones.'/', $key, $matches) || preg_match('/^pregunta'.$this->secciones.'_(\d+)$/', $key, $matches)) {

                            $preguntas = PreguntasTemplateAnalisisdeBrechas::create([
                                'seccion_id' => $seccion->id,
                                'pregunta' => $value,
                                'numero_pregunta' => $numero,
                            ]);
                            $numero++;
                        }
                    }
                } else {
                    // dd("Error");
                    $this->addError('porcentaje', 'La evaluación debe tener un valor total del 100% entre las secciones');

                    return null;
                }

                $this->alert('success', '¡El template ha sido editado con éxito!', [
                    'position' => 'center',
                    'timer' => 5000,
                    'toast' => true,
                    'text' => 'Se ha modificado tu plantillas y tu cuestionario, lo puedes consultar y editar cuando lo necesites.',
                ]);

                return redirect(route('admin.analisisdebrechas-2022.create'));
            } else {
                if ($this->secciones == 1) {
                    $porcentaje = 100;
                }

                $seccion = SeccionesTemplateAnalisisdeBrechas::create([
                    'template_id' => $template->id,
                    'numero_seccion' => $this->datos_seccion,
                    'descripcion' => $data['descripcion_s'.$this->datos_seccion],
                    'porcentaje_seccion' => $porcentaje,
                ]);

                $numero = 1;

                foreach ($data as $key => $value) {
                    if (preg_match('/^pregunta1/', $key, $matches) || preg_match('/^pregunta1_(\d+)$/', $key, $matches)) {

                        $preguntas = PreguntasTemplateAnalisisdeBrechas::create([
                            'seccion_id' => $seccion->id,
                            'pregunta' => $value,
                            'numero_pregunta' => $numero,
                        ]);
                        // dd($value);
                        // $index = intval($matches[1]);
                        // dd($key, $value);
                        // $result[$key] = $value;

                        $numero++;
                    }
                }
            }

            return redirect(route('admin.analisisdebrechas-2022.create'));
        } else {
            switch ($this->datos_seccion) {
                case '1':
                    // dd("Seccion 1", $data);

                    $seccion = [
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data['descripcion_s'.$this->datos_seccion],
                        'porcentaje_seccion' => $data['porcentaje_seccion_'.$this->datos_seccion],
                    ];

                    $preguntas1 = $this->preguntas($data, 1);

                    $this->s1 = [
                        'seccion' => $seccion,
                        'preguntas' => $preguntas1,
                    ];

                    // dd($this->s1);

                    $this->datos_seccion = $this->posicion_seccion;
                    break;

                case '2':
                    // dd("Seccion 2", $data);

                    $seccion = [
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data['descripcion_s'.$this->datos_seccion],
                        'porcentaje_seccion' => $data['porcentaje_seccion_'.$this->datos_seccion],
                    ];

                    $preguntas2 = $this->preguntas($data, 2);

                    $this->s2 = [
                        'seccion' => $seccion,
                        'preguntas' => $preguntas2,
                    ];

                    $this->datos_seccion = $this->posicion_seccion;
                    break;

                case '3':
                    // dd("Seccion 3 ", $data);

                    $seccion = [
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data['descripcion_s'.$this->datos_seccion],
                        'porcentaje_seccion' => $data['porcentaje_seccion_'.$this->datos_seccion],
                    ];

                    $preguntas3 = $this->preguntas($data, 3);

                    $this->s3 = [
                        'seccion' => $seccion,
                        'preguntas' => $preguntas3,
                    ];

                    $this->datos_seccion = $this->posicion_seccion;

                    break;

                case '4':
                    // dd("Seccion 4", $data);

                    // $seccion = [
                    //     'numero_seccion' => $this->datos_seccion,
                    //     'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                    //     'porcentaje_seccion' => $data["porcentaje_seccion_" . $this->datos_seccion],
                    // ];

                    // $preguntas2 = $this->preguntas($data);

                    // $this->s2 = [
                    //     "seccion" => $seccion,
                    //     "preguntas" => $preguntas2,
                    // ];
                    $this->datos_seccion = $this->posicion_seccion;

                    break;
            }
        }
    }

    public function groupValues($values)
    {
        $groupedValues = [];

        for ($i = 1; $i <= 4; $i++) {
            $estatusKey = "estatus_{$i}";
            $valorKey = "valor_estatus_{$i}";
            $descripcionKey = "descripcion_parametros_{$i}";

            if (
                isset($values[$estatusKey]) && isset($values[$valorKey]) &&
                ! empty($values[$estatusKey]) && ! empty($values[$valorKey])
            ) {
                $groupedValues["group_{$i}"] = [
                    'estatus' => $values[$estatusKey],
                    'valor' => $values[$valorKey],
                    'color' => $values["color_estatus_{$i}"] ?? null,
                    'descripcion' => $values[$descripcionKey],
                ];
            }
        }

        return $groupedValues;
    }

    public function preguntas($data, $seccion)
    {
        $result = [];
        // $numero = 1;
        foreach ($data as $key => $value) {
            if (preg_match('/^pregunta'.$seccion.'/', $key, $matches) || preg_match('/^pregunta'.$seccion.'_(\d+)$/', $key, $matches)) {

                // dd($value);
                // $index = intval($matches[1]);
                // dd($key, $value);
                $result[$key] = $value;

                // $numero++;
            }
        }

        return $result;
    }
}
