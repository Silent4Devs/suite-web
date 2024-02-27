<?php

namespace Database\Seeders;

use App\Models\RH\Conducta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenciasCeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cero = [
            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 1],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 2],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 3],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 4],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 5],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 6],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 7],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 8],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 9],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 10],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 11],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 12],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 13],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 14],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 15],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 16],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 17],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 18],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 19],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 20],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 21],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 22],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 23],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 24],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 25],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 26],

            ['ponderacion' => 0, 'definicion' => '<ul>
	<li style="text-align: justify;">No cumple con los requerimientos minimos.</li>
	</ul>', 'competencia_id' => 27],
        ];

        Conducta::insert($cero);
    }
}
