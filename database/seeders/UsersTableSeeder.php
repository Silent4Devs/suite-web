<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('#S3cur3P4$$w0Rd!'),
                'remember_token' => null,
                'verification_token' => '',
                'two_factor_code' => '',
                'empleado_id' => 1,
            ],
        ];

        User::insert($users);
    }
}

// INSERT INTO public.users
// (id, "name", email, email_verified_at, "password", remember_token, approved, verified, verified_at, verification_token, two_factor, two_factor_code, two_factor_expires_at, created_at, updated_at, deleted_at, organizacion_id, area_id, puesto_id, team_id, n_empleado, is_active, empleado_id)
// VALUES(nextval('users_id_seq'::regclass), '', '', '', '', '', false, false, '', '', false, '', '', '', '', '', 0, 0, 0, 0, '', true, 0);

// INSERT INTO public.empleados
// (id, "name", foto, puesto, antiguedad, estatus, email, supervisor_id, area_id, created_at, updated_at, deleted_at, telefono, n_empleado, n_registro, genero, sede_id, direccion, resumen, cumpleaños, telefono_movil, "extension", puesto_id, perfil_empleado_id, tipo_contrato_empleados_id, domicilio_personal, telefono_casa, correo_personal, estado_civil, "NSS", "CURP", "RFC", lugar_nacimiento, nacionalidad, entidad_crediticias_id, numero_credito, descuento, banco, cuenta_bancaria, clabe_interbancaria, centro_costos, salario_bruto, salario_diario, salario_diario_integrado, salario_base_mensual, pagadora_actual, periodicidad_nomina, terminacion_contrato, renovacion_contrato, esquema_contratacion, proyecto_asignado, mostrar_telefono, calle, num_exterior, num_interior, colonia, delegacion, estado, pais, cp, fecha_baja, razon_baja, semanas_min_timesheet, vacante_activa)
// VALUES(nextval('empleados_id_seq'::regclass), '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', 0, 0, 0, 0, '', '', '', false, '', '', false, '', '', '', '', '', '', '', '', '', '', 0, true);