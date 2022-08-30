<?php

namespace Database\Seeders;

use App\Models\DeclaracionAplicabilidad;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class UpdateDeclaracionAplicabilidadAnexosPolitica extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.2')->first()->update([
            'anexo_politica' => 'Retirada de Soporte.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
        DeclaracionAplicabilidad::where('anexo_indice', 'A.8.3.1')->first()->update([
            'anexo_politica' => 'Gestión de medios extraíbles.'
        ]);
    }
}
