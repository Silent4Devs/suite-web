<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(
            [
                // PermissionsTableSeeder::class,
                // RolesTableSeeder::class,
                // UsersTableSeeder::class,
                // GapunoTableSeeder::class,
                // GaptresTableSeeder::class,
                // // GapdosTableSeeder::class,
                // declaracion_aplicabilidad_table::class,
                // EstadodocumentosTableSeeder::class,
                // // ControlDocumentosSeeder::class,
                // EstadoincidentesTableSeeder::class,
                // EstusplatrabajoTableSeeder::class,
                // // Ev360RangosResultadoSeeder::class,
                // // ActividadFaseSeeder::class,
                // // OrganizacionSeeder::class,
                // // SedeSeeder::class,
                // // GrupoSeeder::class,
                // // AreaSeeder::class,
                // // PuestoSeeder::class,
                // PerfilEmpleadosSeeder::class,
                // TipoContratosEmpleadoSeeder::class,
                // // EmpleadosSeeder::class,
                // // MacroprocesoSeeder::class,
                // // DocumentoSeeder::class,
                // PlanImplementacionSeeder::class,  // Necesario se carga inicialmente el Diagrama Universal de Gantt
                // // PlanImplementacion9001Seeder::class,
                // CategoriaIncidenteSeeder::class,
                // SubcategoriaIncidenteSeeder::class,
                // ClausulasSeeder::class,
                // VulnerabilidadesTableSeeder::class,
                // AmenazasTableSeeder::class,
                // PanelInicioSeeder::class,
                // PanelOrganizacionSeeder::class,
                // PermissionRoleTableSeeder::class,
                // LanguageSeeder::class,
                // GlosarioSeeder::class,
                // RoleUserTableSeeder::class,
                // // Clausula9001Seeder::class,
                // NormasSeeder::class,
                // // ConfigurarSoporteSeeder::class,
                // CategoriaActivosSeeder::class,
                // SubcategoriaActivosSeeder::class,
                // activosDisponibilidadSeeder::class,
                // activosConfidencialidadSeeder::class,
                // activosIntegridadSeeder::class,
                // // // PlanBaseSeeder::class,
                // // TablaImpactoSeeder::class,
                // PermissionQuejasClientesSeeder::class,
                // AjustesEnvioDocumentosSeeder::class,
                // AjustesBIASeeder::class,
                // PermisosMensajeriaSeeder::class,
                // PermissionsVisitantesSeeder::class,
                // VacacionesPermisosSeeder::class,
                // PermisosBIASeeder::class,
                // AjustesAIASeeder::class,
                // VersionIsoHistoricoSeeder::class,
                // GapUnoCatalogoIsoSeeder::class,
                // GapTresCatalogoIsoSeeder::class,
                // ClasificacionSeeder::class,
                // GapDosCatalogoIsoSeeder::class,
                // Declaracion_aplicabilidad_concentrado_Seeder::class,
                // Declaracion_aplicabilidad_responsable_Seeder::class,
                // Declaracion_aplicabilidad_aprobador_Seeder::class,
                // PermissionVersionesIso::class,
                // PermissionsAgregarEmpExtProyectos::class,
                // PermisosDashboardTimesheet::class,
                // PermisosTimesheetAdministrador::class,

                //Katbol
                CentroCostosTableSeeder::class,
                CompradoresTableSeeder::class,
                ProductosTableSeeder::class,
                ProveedorOCSTableSeeder::class,
                SucursalesTableSeeder::class,
                // FacturacionTableSeeder::class,
                ProveedoresTableSeeder::class,
                ContratosTableSeeder::class,
                // ConveniosModificatoriosTableSeeder::class,
                // EntregasMensualesTableSeeder::class,
                // CierreContratosTableSeeder::class,
                PermisosKatbol::class,

            ]
        );
    }
}
