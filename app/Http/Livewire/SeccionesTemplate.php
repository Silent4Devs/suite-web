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

    public function nextSeccion()
    {
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion >= 1 &&  $this->posicion_seccion < $this->secciones) {
            // dd($this->posicion_seccion);
            $this->datos_seccion = $this->posicion_seccion;
            $this->posicion_seccion++;
        }
    }

    public function backSeccion()
    {
        if ($this->secciones > 1 && $this->secciones <= 4 && $this->posicion_seccion > 1 &&  $this->posicion_seccion <= $this->secciones) {
            $this->datos_seccion = $this->posicion_seccion;
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
        if ($this->posicion_seccion == $this->secciones) {

            if ($this->secciones == 1) {
                $porcentaje = 100;
            }
            // dd($data["descripcion_s" . $this->datos_seccion]);

            $template = TemplateAnalisisdeBrechas::updateOrCreate([
                'nombre_template' => $data["nombre_template"],
                'norma_id' => $data["norma"],
                'descripcion' => $data["descripcion"],
                'no_secciones' => $this->secciones,
            ]);

            $secciones = SeccionesTemplateAnalisisdeBrechas::updateOrCreate([
                'template_id' => $template->id,
                'numero_seccion' => $this->datos_seccion,
                'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                'porcentaje_seccion' => $porcentaje,
            ]);

            $groupedValues = $this->groupValues($data);

            foreach ($groupedValues as $estatus) {
                // dd($estatus);
                $colores = ColoresTemplateAnalisisdeBrechas::updateOrCreate([
                    'template_id' => $template->id,
                    'estatus' => $estatus['estatus'],
                    'color' => $estatus['valor'],
                    // 'descripcion' => $estatus['descripcion'],
                ]);
            }

            $numero = 1;

            foreach ($data as $key => $value) {
                if (preg_match('/^pregunta1/', $key, $matches) || preg_match('/^pregunta1_(\d+)$/', $key, $matches)) {

                    $preguntas = PreguntasTemplateAnalisisdeBrechas::updateOrCreate([
                        'seccion_id' => $secciones->id,
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

            // dd($template, $secciones, $preguntas);
            return redirect(route('admin.inicio-Usuario.index'));
        } else {
            switch ($this->datos_seccion) {
                case "1":
                    dd("Seccion 1", $data);
                    $template = TemplateAnalisisdeBrechas::updateOrCreate([
                        'nombre_template' => $data["nombre_template"],
                        'norma_id' => $data["norma"],
                        'descripcion' => $data["descripcion"],
                        'no_secciones' => $this->secciones,
                    ]);

                    $secciones = SeccionesTemplateAnalisisdeBrechas::updateOrCreate([
                        'template_id' => $template->id,
                        'numero_seccion' => $this->datos_seccion,
                        'descripcion' => $data["descripcion_s" . $this->datos_seccion],
                        'porcentaje_seccion' => $porcentaje,
                    ]);

                    $groupedValues = $this->groupValues($data);

                    foreach ($groupedValues as $estatus) {
                        // dd($estatus);
                        $colores = ColoresTemplateAnalisisdeBrechas::updateOrCreate([
                            'template_id' => $template->id,
                            'estatus' => $estatus['estatus'],
                            'color' => $estatus['valor'],
                            // 'descripcion' => $estatus['descripcion'],
                        ]);
                    }

                    $numero = 1;

                    foreach ($data as $key => $value) {
                        if (preg_match('/^pregunta1/', $key, $matches) || preg_match('/^pregunta1_(\d+)$/', $key, $matches)) {

                            $preguntas = PreguntasTemplateAnalisisdeBrechas::updateOrCreate([
                                'seccion_id' => $secciones->id,
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
                    break;

                case "2":
                    dd("Seccion 2", $data);
                    break;

                case "3":
                    dd("Seccion 3 ", $data);
                    break;

                case "4":
                    dd("Seccion 4", $data);
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


    // public function saveDataSeccion1()
    // {
    //     dd("seccion1");
    // }
}
