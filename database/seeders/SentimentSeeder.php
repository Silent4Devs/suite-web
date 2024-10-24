<?php

namespace Database\Seeders;

use App\Models\Denuncias;
use App\Models\IncidentesSeguridad;
use App\Models\Mejoras;
use App\Models\Quejas;
use App\Models\QuejasCliente;
use App\Models\RiesgoIdentificado;
use App\Models\Sugerencias;
use App\Services\SentimentService;
use Illuminate\Database\Seeder;

class SentimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            IncidentesSeguridad::class,
            RiesgoIdentificado::class,
            Quejas::class,
            QuejasCliente::class,
            Denuncias::class,
            Mejoras::class,
            Sugerencias::class,
        ];

        foreach ($models as $model) {
            $this->updateSentiments($model);
        }
    }

    private function updateSentiments($model): void
    {
        $records = $model::all();

        foreach ($records as $record) {
            $descripcion = $record->descripcion ?? '["analisis_de_sentimientos" => [["neg" => 0.0,"neu" => 0.0,"pos" => 0.0,"compound" => 0.0]],"sentimientos_textblob" => [["polarity" => 0.0,"subjectivity" => 0.0]],"frases_nominales_spacy" => [[]],"palabras_clave" => [[]]]';
            $sentimiento = SentimentService::analyzeSentiment($descripcion);

            $record->update(['sentimientos' => $sentimiento]);
        }
    }
}
