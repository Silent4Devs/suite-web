<?php

namespace Database\Seeders;

use App\Models\PlanImplementacion;
use App\Models\Puesto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([

            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            GapunoTableSeeder::class,
            GaptresTableSeeder::class,
            GapdosTableSeeder::class,
            declaracion_aplicabilidad_table::class,
            EstadodocumentosTableSeeder::class,
            ControlDocumentosSeeder::class,
            EstadoincidentesTableSeeder::class,
            EstusplatrabajoTableSeeder::class,
            ActividadFaseSeeder::class,
            OrganizacionSeeder::class,
            SedeSeeder::class,
            GrupoSeeder::class,
            AreaSeeder::class,
            PuestoSeeder::class,
            EmpleadosSeeder::class,
            MacroprocesoSeeder::class,
            DocumentoSeeder::class,
            PlanImplementacionSeeder::class,  // Necesario se carga inicialmente el Diagrama Universal de Gantt
            CategoriaIncidenteSeeder::class,
            SubcategoriaIncidenteSeeder::class,
            ClausulasSeeder::class,
            //PlanBaseSeeder::class,
        ]);
    }
}
