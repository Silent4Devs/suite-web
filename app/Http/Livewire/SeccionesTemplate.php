<?php

namespace App\Http\Livewire;

use App\Models\ColoresTemplateAnalisisdeBrechas;
use App\Models\Norma;
use App\Models\PreguntasTemplateAnalisisdeBrechas;
use App\Models\SeccionesTemplateAnalisisdeBrechas;
use App\Models\TemplateAnalisisdeBrechas;
use Livewire\Component;

class SeccionesTemplate extends Component
{

    public $normas;

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
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion >= 1 &&  $this->posicion_seccion < $this->secciones) {
            $this->posicion_seccion++;
        }
    }

    public function backSeccion()
    {
        $this->datos_seccion = $this->posicion_seccion;
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion > 1 &&  $this->posicion_seccion <= $this->secciones) {
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

    public function mount()
    {
        $this->normas = Norma::get();
    }

    public function render()
    {
        return view('livewire.secciones-template')->with("normas", $this->normas);
    }

    public function submitForm($data)
    {
        $result = [];
        // $this->posicion_seccion++;
        if ($this->posicion_seccion == $this->secciones && $this->datos_seccion == $this->posicion_seccion) {

            if ($this->secciones == 1) {
                $porcentaje = 100;
            }
            // dd($data["descripcion_s" . $this->datos_seccion]);

            $template = TemplateAnalisisdeBrechas::create([
                'nombre_template' => $data["nombre_template"],
                'norma_id' => $data["norma"],
                'descripcion' => $data["descripcion"],
                'no_secciones' => $this->secciones,
            ]);

            $groupedValues = $this->groupValues($data);

            foreach ($groupedValues as $estatus) {
                // dd($estatus);
                $colores = ColoresTemplateAnalisisdeBrechas::create([
                    'template_id' => $template->id,
                    'estatus' => $estatus['estatus'],
                    'valor' => $estatus['valor'],
                    'color' => $estatus['color'],
                    // 'descripcion' => $estatus['descripcion'],
                ]);
            }

            // dd($this->s1, $this->s2);

            if ($this->secciones > 1 && $this->secciones <= 4) {
                for ($i = 1; $i < $this->secciones; $i++) {
                    $numeroSeccion = 's' . $i;
                    // dd($this->$numeroSeccion["preguntas"]);
                    $this->$numeroSeccion["seccion"]["porcentaje_seccion"];
                    $seccion = SeccionesTemplateAnalisisdeBrechas::create([
                        'template_id' => $template->id,
                        'numero_seccion' => $this->$numeroSeccion["seccion"]["numero_seccion"],
                        'descripcion' => $this->$numeroSeccion["seccion"]["descripcion"],
                        'porcentaje_seccion' => $this->$numeroSeccion["seccion"]["porcentaje_seccion"],
                    ]);

                    $numero = 1;

                    foreach ($this->$numeroSeccion["preguntas"] as $prg) {
                        $preguntas = PreguntasTemplateAnalisisdeBrechas::create([
                            'seccion_id' => $seccion->id,
                            'pregunta' => $prg,
                            'numero_pregunta' => $numero,
                        ]);
                        $numero++;
                    }
                }

                $seccion = SeccionesTemplateAnalisisdeBrechas::create([
                    'template_id' => $template->id,
                    'numero_seccion' => $this->datos_seccion,
                    'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                    'porcentaje_seccion' => $data["porcentaje_seccion_" . $this->datos_seccion],
                ]);

                $numero = 1;

                foreach ($data as $key => $value) {
                    if (preg_match('/^pregunta' . $this->secciones . '/', $key, $matches) || preg_match('/^pregunta' . $this->secciones . '_(\d+)$/', $key, $matches)) {

                        $preguntas = PreguntasTemplateAnalisisdeBrechas::create([
                            'seccion_id' => $seccion->id,
                            'pregunta' => $value,
                            'numero_pregunta' => $numero,
                        ]);
                        $numero++;
                    }
                }

                return redirect(route('admin.inicio-Usuario.index'));
            } else {
                $seccion = SeccionesTemplateAnalisisdeBrechas::create([
                    'template_id' => $template->id,
                    'numero_seccion' => $this->datos_seccion,
                    'descripcion' => $data["descripcion_s" . $this->datos_seccion],
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

            return redirect(route('admin.inicio-Usuario.index'));
        } else {
            switch ($this->datos_seccion) {
                case "1":
                    // dd("Seccion 1", $data);

                    $seccion = [
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                        'porcentaje_seccion' => $data["porcentaje_seccion_" . $this->datos_seccion],
                    ];

                    $preguntas1 = $this->preguntas($data, 1);

                    $this->s1 = [
                        "seccion" => $seccion,
                        "preguntas" => $preguntas1,
                    ];

                    // dd($this->s1);

                    break;

                case "2":
                    // dd("Seccion 2", $data);

                    $seccion = [
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                        'porcentaje_seccion' => $data["porcentaje_seccion_" . $this->datos_seccion],
                    ];

                    $preguntas2 = $this->preguntas($data, 2);

                    $this->s2 = [
                        "seccion" => $seccion,
                        "preguntas" => $preguntas2,
                    ];

                    break;

                case "3":
                    // dd("Seccion 3 ", $data);

                    $seccion = [
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                        'porcentaje_seccion' => $data["porcentaje_seccion_" . $this->datos_seccion],
                    ];

                    $preguntas3 = $this->preguntas($data, 3);

                    $this->s3 = [
                        "seccion" => $seccion,
                        "preguntas" => $preguntas3,
                    ];

                    break;

                case "4":
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

                    break;
            }
        }
        // dd($data);
        // $additional = json_decode($boton, true);
    }

    function groupValues($values)
    {
        $groupedValues = [];

        for ($i = 1; $i <= 4; $i++) {
            $estatusKey = "estatus_{$i}";
            $valorKey = "valor_estatus_{$i}";

            if (
                isset($values[$estatusKey]) && isset($values[$valorKey]) &&
                !empty($values[$estatusKey]) && !empty($values[$valorKey])
            ) {
                $groupedValues["group_{$i}"] = [
                    'estatus' => $values[$estatusKey],
                    'valor' => $values[$valorKey],
                    'color' => $values["color_estatus_{$i}"] ?? null
                ];
            }
        }

        return $groupedValues;
    }

    function preguntas($data, $seccion)
    {
        $result = [];
        // $numero = 1;
        foreach ($data as $key => $value) {
            if (preg_match('/^pregunta' . $seccion . '/', $key, $matches) || preg_match('/^pregunta' . $seccion . '_(\d+)$/', $key, $matches)) {

                // dd($value);
                // $index = intval($matches[1]);
                // dd($key, $value);
                $result[$key] = $value;

                // $numero++;
            }
        }

        return $result;
    }

    // public function saveDataSeccion1()
    // {
    //     dd("seccion1");
    // }
}
