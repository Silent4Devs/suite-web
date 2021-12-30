<?php

Breadcrumbs::for('admin.iso27001.index', function ($trail) {
    $trail->push('ISO 27001', route('iso27001.index'));
});

Breadcrumbs::for('admin.analisisdebrechas.index', function ($trail) {
    $trail->push('ISO 27001', route('admin.iso27001.index'));
    $trail->push('Contexto', route('admin.iso27001.index') . '#contexto');
    $trail->push('Análisis de Brechas', route('admin.analisis-brechas.index'));
});

Breadcrumbs::for('dashboard-iso27001', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Dashboard', route('admin.home'));
});
Breadcrumbs::for('admin.analisis-brechas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('iso27001.index') . '#contexto');
    $trail->push('Análisis de Brechas', route('analisis-brechas.index'));
});

Breadcrumbs::for('admin.planTrabajoBase.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('iso27001.index') . '#contexto');
    $trail->push('Plan de Implementación', route('planTrabajoBase.index'));
});

Breadcrumbs::for('admin.declaracion-aplicabilidad.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('iso27001.index') . '#planificacion');
    $trail->push('Declaración de Aplicabilidad', route('declaracion-aplicabilidad.index'));
});

Breadcrumbs::for('admin.partes-interesadas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('iso27001.index') . '#contexto');
    $trail->push('Partes Interesadas', route('partes-interesadas.index'));
});
Breadcrumbs::for('admin.partes-interesadas.create', function ($trail) {
    $trail->parent('admin.partes-interesadas.index');
    $trail->push('Formulario', route('partes-interesadas.create'));
});

Breadcrumbs::for('admin.matriz-requisito-legales.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('iso27001.index') . '#contexto');
    $trail->push('Matriz de Requisitos Legales', route('matriz-requisito-legales.index'));
});
Breadcrumbs::for('admin.matriz-requisito-legales.create', function ($trail) {
    $trail->parent('admin.matriz-requisito-legales.index');
    $trail->push('Formulario', route('matriz-requisito-legales.create'));
});

Breadcrumbs::for('admin.entendimiento-organizacions.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('iso27001.index') . '#contexto');
    $trail->push('FODA', route('entendimiento-organizacions.index'));
});
Breadcrumbs::for('admin.entendimiento-organizacions.create', function ($trail) {
    $trail->parent('admin.entendimiento-organizacions.index');
    $trail->push('Formulario', route('entendimiento-organizacions.create'));
});

Breadcrumbs::for('admin.alcance-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Contexto', route('iso27001.index') . '#contexto');
    $trail->push('Determinación de Alcance', route('alcance-sgsis.index'));
});
Breadcrumbs::for('admin.alcance-sgsis.create', function ($trail) {
    $trail->parent('admin.alcance-sgsis.index');
    $trail->push('Formulario', route('alcance-sgsis.create'));
});

// Breadcrumbs::for('admin..index', function ($trail) {perfil-puesto
// $trail->parent('admin.iso27001.index');                   generar reporte-------------
// $trail->push('', route('.index'));
// });

Breadcrumbs::for('admin.comiteseguridads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('iso27001.index') . '#liderazgo');
    $trail->push('Conformación del Comité de Seguridad', route('comiteseguridads.index'));
});
Breadcrumbs::for('admin.comiteseguridads.create', function ($trail) {
    $trail->parent('admin.comiteseguridads.index');
    $trail->push('Formulario', route('comiteseguridads.create'));
});
Breadcrumbs::for('admin.comiteseguridads.visualizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('portal-comunicacion.index'));
    $trail->push('Comite de Seguridad');
});

Breadcrumbs::for('admin.minutasaltadireccions.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('iso27001.index') . '#liderazgo');
    $trail->push('Minutas de Sesiones con Alta Dirección', route('minutasaltadireccions.index'));
});
Breadcrumbs::for('admin.minutasaltadireccions.create', function ($trail) {
    $trail->parent('admin.minutasaltadireccions.index');
    $trail->push('Formulario', route('minutasaltadireccions.create'));
});

Breadcrumbs::for('admin.evidencias-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('iso27001.index') . '#liderazgo');
    $trail->push('Evidencia de Asignación de Recursos al SGSI', route('evidencias-sgsis.index'));
});
Breadcrumbs::for('admin.evidencias-sgsis.create', function ($trail) {
    $trail->parent('admin.evidencias-sgsis.index');
    $trail->push('Formulario', route('evidencias-sgsis.create'));
});

Breadcrumbs::for('admin.politica-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('iso27001.index') . '#liderazgo');
    $trail->push('Política SGSI', route('politica-sgsis.index'));
});
Breadcrumbs::for('admin.politica-sgsis.create', function ($trail) {
    $trail->parent('admin.politica-sgsis.index');
    $trail->push('Formulario', route('politica-sgsis.create'));
});

Breadcrumbs::for('admin.politicaSgsis.visualizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('portal-comunicacion.index'));
    $trail->push('Politica SGSI');
});

Breadcrumbs::for('admin.roles-responsabilidades.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Liderazgo', route('iso27001.index') . '#liderazgo');
    $trail->push('Roles y Responsabilidades', route('roles-responsabilidades.index'));
});
Breadcrumbs::for('admin.roles-responsabilidades.create', function ($trail) {
    $trail->parent('admin.roles-responsabilidades.index');
    $trail->push('Formulario', route('roles-responsabilidades.create'));
});

Breadcrumbs::for('admin.amenazas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('iso27001.index') . '#planificacion');
    $trail->push('Amenazas', route('amenazas.index'));
});

Breadcrumbs::for('admin.vulnerabilidads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('iso27001.index') . '#planificacion');
    $trail->push('Vulnerabilidades', route('vulnerabilidads.index'));
});

Breadcrumbs::for('admin.analisis-riesgos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('iso27001.index') . '#planificacion');
    $trail->push('Matriz de Riesgos', route('analisis-riesgos.index'));
});

Breadcrumbs::for('admin.riesgosoportunidades.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('iso27001.index') . '#planificacion');
    $trail->push('Riesgos y Oportunidades', route('riesgosoportunidades.index'));
});
Breadcrumbs::for('admin.riesgosoportunidades.create', function ($trail) {
    $trail->parent('admin.riesgosoportunidades.index');
    $trail->push('Formulario', route('riesgosoportunidades.create'));
});
Breadcrumbs::for('admin.paneldeclaracion.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('admin.iso27001.index') . '#planificacion');
    $trail->push('Asignación Controles', route('admin.paneldeclaracion.index'));
});

Breadcrumbs::for('admin.objetivosseguridads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Planificación', route('iso27001.index') . '#planificacion');
    $trail->push('Objetivos de Seguridad', route('objetivosseguridads.index'));
});
Breadcrumbs::for('admin.objetivosseguridads.create', function ($trail) {
    $trail->parent('admin.objetivosseguridads.index');
    $trail->push('Formulario', route('objetivosseguridads.create'));
});

Breadcrumbs::for('admin.recursos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('admin.iso27001.index') . '#soporte');
    $trail->push('Capacitaciones', route('admin.recursos.index'));
});
Breadcrumbs::for('admin.recursos.create', function ($trail) {
    $trail->parent('admin.recursos.index');
    $trail->push('Formulario', route('recursos.create'));
});

// Breadcrumbs::for('admin.competencia.index', function ($trail) {
//  	$trail->parent('admin.iso27001.index');
//     $trail->push('Soporte',route('iso27001.index').'#soporte');
//  	$trail->push('Competencias', route('competencia.index'));
// });

// Breadcrumbs::for('admin.competencia.create', function ($trail) {
//     $trail->parent('admin.competencia.index');
//     $trail->push('Formulario', route('competencia.create'));
// });

Breadcrumbs::for('admin.competencia.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Competencias', route('buscarCV') . '#soporte');
});

Breadcrumbs::for('admin.concientizacion-sgis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Concientización SGSI', route('concientizacion-sgis.index'));
});
Breadcrumbs::for('admin.concientizacion-sgis.create', function ($trail) {
    $trail->parent('admin.concientizacion-sgis.index');
    $trail->push('Formulario', route('concientizacion-sgis.create'));
});

Breadcrumbs::for('admin.material-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Material SGSI', route('material-sgsis.index'));
});
Breadcrumbs::for('admin.material-sgsis.create', function ($trail) {
    $trail->parent('admin.material-sgsis.index');
    $trail->push('Formulario', route('material-sgsis.create'));
});

Breadcrumbs::for('admin.material-iso-veinticientes.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Material ISO 27001:2013', route('material-iso-veinticientes.index'));
});
Breadcrumbs::for('admin.material-iso-veinticientes.create', function ($trail) {
    $trail->parent('admin.material-iso-veinticientes.index');
    $trail->push('Formulario', route('material-iso-veinticientes.create'));
});

Breadcrumbs::for('admin.comunicacion-sgis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Comunicación SGSI', route('comunicacion-sgis.index'));
});
Breadcrumbs::for('admin.comunicacion-sgis.create', function ($trail) {
    $trail->parent('admin.comunicacion-sgis.index');
    $trail->push('Formulario', route('comunicacion-sgis.create'));
});

Breadcrumbs::for('admin.politica-del-sgsi-soportes.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Política del SGSI', route('politica-del-sgsi-soportes.index'));
});

Breadcrumbs::for('admin.control-accesos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Control de Acceso', route('control-accesos.index'));
});
Breadcrumbs::for('admin.control-accesos.create', function ($trail) {
    $trail->parent('admin.control-accesos.index');
    $trail->push('Formulario', route('control-accesos.create'));
});

Breadcrumbs::for('admin.informacion-documetadas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Soporte', route('iso27001.index') . '#soporte');
    $trail->push('Información Documentada', route('informacion-documetadas.index'));
});
Breadcrumbs::for('admin.informacion-documetadas.create', function ($trail) {
    $trail->parent('admin.informacion-documetadas.index');
    $trail->push('Formulario', route('informacion-documetadas.create'));
});

Breadcrumbs::for('admin.planificacion-controls.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Operación', route('iso27001.index') . '#operacion');
    $trail->push('Planificación y Control', route('planificacion-controls.index'));
});
Breadcrumbs::for('admin.planificacion-controls.create', function ($trail) {
    $trail->parent('admin.planificacion-controls.index');
    $trail->push('Formulario', route('planificacion-controls.create'));
});

Breadcrumbs::for('admin.tratamiento-riesgos.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Operación', route('iso27001.index') . '#operacion');
    $trail->push('Tratamiento de los Riesgos', route('tratamiento-riesgos.index'));
});
Breadcrumbs::for('admin.tratamiento-riesgos.create', function ($trail) {
    $trail->parent('admin.tratamiento-riesgos.index');
    $trail->push('Formulario', route('tratamiento-riesgos.create'));
});

Breadcrumbs::for('admin.indicadores-sgsis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Indicadores SGSI', route('indicadores-sgsis.index'));
});
Breadcrumbs::for('admin.indicadores-sgsis.create', function ($trail) {
    $trail->parent('admin.indicadores-sgsis.index');
    $trail->push('Formulario', route('indicadores-sgsis.create'));
});

Breadcrumbs::for('admin.incidentes-de-seguridads.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Incidentes de Seguridad', route('incidentes-de-seguridads.index'));
});
Breadcrumbs::for('admin.incidentes-de-seguridads.create', function ($trail) {
    $trail->parent('admin.incidentes-de-seguridads.index');
    $trail->push('Formulario', route('incidentes-de-seguridads.create'));
});

Breadcrumbs::for('admin.indicadorincidentessis.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Indicador de Incidentes', route('indicadorincidentessis.index'));
});

Breadcrumbs::for('admin.auditoria-anuals.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Programa Anual de Auditoría', route('auditoria-anuals.index'));
});
Breadcrumbs::for('admin.auditoria-anuals.create', function ($trail) {
    $trail->parent('admin.auditoria-anuals.index');
    $trail->push('Formulario', route('auditoria-anuals.create'));
});

Breadcrumbs::for('admin.plan-auditoria.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Plan de Auditoría', route('plan-auditoria.index'));
});
Breadcrumbs::for('admin.plan-auditoria.create', function ($trail) {
    $trail->parent('admin.plan-auditoria.index');
    $trail->push('Formulario', route('plan-auditoria.create'));
});

Breadcrumbs::for('admin.auditoria-internas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Auditoría Interna', route('auditoria-internas.index'));
});
Breadcrumbs::for('admin.auditoria-internas.create', function ($trail) {
    $trail->parent('admin.auditoria-internas.index');
    $trail->push('Formulario', route('auditoria-internas.create'));
});

Breadcrumbs::for('admin.revision-direccions.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Evaluacion', route('iso27001.index') . '#evaluacion');
    $trail->push('Revisión por Dirección', route('revision-direccions.index'));
});
Breadcrumbs::for('admin.revision-direccions.create', function ($trail) {
    $trail->parent('admin.revision-direccions.index');
    $trail->push('Formulario', route('revision-direccions.create'));
});

Breadcrumbs::for('admin.accion-correctivas.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Mejora', route('iso27001.index') . '#mejora');
    $trail->push('Acciones Correctivas', route('accion-correctivas.index'));
});
Breadcrumbs::for('admin.accion-correctivas.create', function ($trail) {
    $trail->parent('admin.accion-correctivas.index');
    $trail->push('Formulario', route('accion-correctivas.create'));
});

Breadcrumbs::for('admin.registromejoras.index', function ($trail) {
    $trail->parent('admin.iso27001.index');
    $trail->push('Mejora', route('iso27001.index') . '#mejora');
    $trail->push('Registro de Mejoras', route('registromejoras.index'));
});
Breadcrumbs::for('admin.registromejoras.create', function ($trail) {
    $trail->parent('admin.registromejoras.index');
    $trail->push('Formulario', route('registromejoras.create'));
});

Breadcrumbs::for('admin.portal-comunicacion.reportes', function ($trail) {
    $trail->push('Portal de comunicación', route('portal-comunicacion.index'));
    $trail->push('Reportes');
});

Breadcrumbs::for('admin.portal-comunicacion.sedes-organizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('portal-comunicacion.index'));
    $trail->push('Sedes');
});

Breadcrumbs::for('admin.comunicacion-sgis.show', function ($trail) {
    $trail->push('Portal de comunicación', route('portal-comunicacion.index'));
    $trail->push('Comunicados');
});

Breadcrumbs::for('admin.system-calendar', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Calendario');
});

// Breadcrumbs::for('admin..index', function ($trail) {
// $trail->parent('admin.iso27001.index');
// $trail->push('', route('.index'));
// });

// MODULO CAPITAL HUMANO
Breadcrumbs::for('capital-humano', function ($trail) {
    $trail->push('Capital Humano', route('admin.capital-humano.index'));
});

Breadcrumbs::for('perfil-puesto', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Empleados');
    $trail->push('Perfiles de Puestos', route('admin.puestos.index'));
});
Breadcrumbs::for('areas-render', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Áreas', route('admin.areas.renderJerarquia'));
});
Breadcrumbs::for('perfil-puesto-create', function ($trail) {
    $trail->parent('perfil-puesto');
    $trail->push('Crear', route('admin.puestos.create'));
});
Breadcrumbs::for('perfil-puesto-edit', function ($trail, $puesto) {
    $trail->parent('perfil-puesto');
    $trail->push('Editar', route('admin.puestos.edit', $puesto));
});
Breadcrumbs::for('perfil-puesto-show', function ($trail, $puesto) {
    $trail->parent('perfil-puesto');
    $trail->push('Visualizar', route('admin.puestos.show', $puesto));
});
Breadcrumbs::for('niveles-jerarquicos', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Empleados');
    $trail->push('Niveles Jerárquicos', route('admin.perfiles.index'));
});
Breadcrumbs::for('niveles-jerarquicos-create', function ($trail) {
    $trail->parent('niveles-jerarquicos');
    $trail->push('Crear', route('admin.perfiles.create'));
});
Breadcrumbs::for('niveles-jerarquicos-edit', function ($trail, $perfil) {
    $trail->parent('niveles-jerarquicos');
    $trail->push('Editar', route('admin.perfiles.edit', $perfil));
});
Breadcrumbs::for('niveles-jerarquicos-show', function ($trail, $perfil) {
    $trail->parent('niveles-jerarquicos');
    $trail->push('Visualizar', route('admin.perfiles.show', $perfil));
});
Breadcrumbs::for('empleados', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Empleados', route('admin.empleados.index'));
});
Breadcrumbs::for('empleados-create', function ($trail) {
    $trail->parent('empleados');
    $trail->push('Crear', route('admin.empleados.create'));
});
Breadcrumbs::for('empleados-edit', function ($trail, $empleado) {
    $trail->parent('empleados');
    $trail->push('Editar', route('admin.empleados.edit', $empleado));
});
Breadcrumbs::for('empleados-show', function ($trail, $empleado) {
    $trail->parent('empleados');
    $trail->push('Visualizar', route('admin.empleados.show', $empleado));
});

Breadcrumbs::for('expedientes-profesionales', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Empleados');
    $trail->push('Expedientes Profesionales', route('admin.capital.expedientes-profesionales'));
});

Breadcrumbs::for('Evaluacion360', function ($trail) {
    $trail->push('RH - Evaluación 360 Grados', route('rh-evaluacion360.index'));
});

Breadcrumbs::for('EV360-Evaluaciones', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Evaluación 360');
    $trail->push('Evaluaciones', route('admin.ev360-evaluaciones.index'));
});

Breadcrumbs::for('EV360-Evaluaciones-Create', function ($trail) {
    $trail->parent('EV360-Evaluaciones');
    $trail->push('Crear Evaluación', route('ev360-evaluaciones.create'));
});

Breadcrumbs::for('EV360-Evaluaciones-Evaluacion', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones');
    $trail->push('Evaluación', route('ev360-evaluaciones.evaluacion', $evaluacion->id));
});

Breadcrumbs::for('EV360-Competencias', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Evaluación 360');
    $trail->push('Competencias', route('admin.ev360-competencias.index'));
});
Breadcrumbs::for('EV360-Competencias-Create', function ($trail) {
    $trail->parent('EV360-Competencias');
    $trail->push('Crear Competencia', route('ev360-competencias.create'));
});
Breadcrumbs::for('EV360-Competencias-Edit', function ($trail) {
    $trail->parent('EV360-Competencias');
    $trail->push('Editar Competencia', '/recursos-humanos/evaluacion-360/evaluaciones/*/evaluacion');
});

Breadcrumbs::for('EV360-Competencias-Por-Puesto', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Evaluación 360');
    $trail->push('Competencias por puesto', route('admin.ev360-competencias-por-puesto.index'));
});
Breadcrumbs::for('EV360-Competencias-Por-Puesto-Create', function ($trail) {
    $trail->parent('EV360-Competencias-Por-Puesto');
    $trail->push('Asignar competencia al puesto', 'recursos-humanos/evaluacion-360/competencias-por-puesto/*/create');
});

Breadcrumbs::for('EV360-Objetivos', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Evaluación 360');
    $trail->push('Objetivos', route('admin.ev360-objetivos.index'));
});
Breadcrumbs::for('EV360-Objetivos-Create', function ($trail, $empleado) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Asignar Objetivo', route('ev360-objetivos-empleado.create', $empleado));
});
Breadcrumbs::for('EV360-Objetivos-Show', function ($trail, $empleado) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Vista de objetivos estratégicos', route('admin.ev360-objetivos-empleado.show', $empleado));
});
Breadcrumbs::for('EV360-Objetivos-Edit', function ($trail) {
    $trail->parent('EV360-Objetivos');
    $trail->push('Editar Objetivo', '/recursos-humanos/evaluacion-360/objetivos/*/edit');
});

Breadcrumbs::for('EV360-Evaluacion-Resumen', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion);
    $trail->push($evaluacion->nombre, '/recursos-humanos/evaluacion-360/evaluacion/*/resumen');
});
Breadcrumbs::for('EV360-Evaluacion-Consulta-Evaluado', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion['evaluacion']);
    $trail->push($evaluacion['evaluado']->name, route('ev360-evaluaciones.autoevaluacion.consulta.evaluado', ['evaluacion' => $evaluacion['evaluacion']->id, 'evaluado' => $evaluacion['evaluado']->id]));
});
Breadcrumbs::for('EV360-Evaluacion-Cuestionario', function ($trail, $evaluacion) {
    $trail->parent('EV360-Evaluaciones-Evaluacion', $evaluacion['evaluacion']);
    $trail->push('Cuestionario', route('ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion['evaluacion']->id, 'evaluado' => $evaluacion['evaluado']->id, 'evaluador' => $evaluacion['evaluador']->id]));
});

Breadcrumbs::for('centro-atencion', function ($trail) {
    $trail->parent('capital-humano');
    $trail->push('Calendario y Comunicación');
    $trail->push('Centro de atención', route('admin.desk.index'));
});

Breadcrumbs::for('mapa-procesos', function ($trail) {
    $trail->parent('Portal de Comunicación');
    $trail->push('Mapa de procesos', route('admin.procesos.vistas.mapa_procesos'));
});

Breadcrumbs::for('seguridad-create', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Incidentes de Seguridad');
    $trail->push('Crear', route('admin.reportes-seguridad'));
});
Breadcrumbs::for('seguridad-edit', function ($trail, $incidentesSeguridad) {
    $trail->parent('centro-atencion');
    $trail->push('Incidentes de Seguridad');
    $trail->push('Editar', route('admin.desk.seguridad-edit', $incidentesSeguridad));
});
Breadcrumbs::for('seguridad-archivo', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Incidentes de Seguridad');
    $trail->push('Archivo', route('admin.desk.seguridad-archivo'));
});

Breadcrumbs::for('riesgos-create', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Riesgos Identificados');
    $trail->push('Crear', route('admin.reportes-riesgos'));
});
Breadcrumbs::for('riesgos-edit', function ($trail, $riesgo) {
    $trail->parent('centro-atencion');
    $trail->push('Riesgos Identificados');
    $trail->push('Editar', route('admin.desk.riesgos-edit', $riesgo));
});
Breadcrumbs::for('riesgos-archivo', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Riesgos Identificados');
    $trail->push('Archivo', route('admin.desk.riesgos-archivo'));
});
Breadcrumbs::for('quejas-create', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Quejas');
    $trail->push('Crear', route('admin.reportes-quejas'));
});
Breadcrumbs::for('quejas-edit', function ($trail, $queja) {
    $trail->parent('centro-atencion');
    $trail->push('Quejas');
    $trail->push('Editar', route('admin.desk.quejas-edit', $queja));
});
Breadcrumbs::for('quejas-archivo', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Quejas');
    $trail->push('Archivo', route('admin.desk.quejas-archivo'));
});
Breadcrumbs::for('denuncias-create', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Denuncias');
    $trail->push('Crear', route('admin.reportes-denuncias'));
});
Breadcrumbs::for('denuncias-edit', function ($trail, $denuncia) {
    $trail->parent('centro-atencion');
    $trail->push('Denuncias');
    $trail->push('Editar', route('admin.desk.denuncias-edit', $denuncia));
});
Breadcrumbs::for('denuncias-archivo', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Denuncias');
    $trail->push('Archivo', route('admin.desk.denuncias-archivo'));
});
Breadcrumbs::for('mejoras-create', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Mejoras');
    $trail->push('Crear', route('admin.reportes-mejoras'));
});
Breadcrumbs::for('mejoras-edit', function ($trail, $mejora) {
    $trail->parent('centro-atencion');
    $trail->push('Mejoras');
    $trail->push('Editar', route('admin.desk.mejoras-edit', $mejora));
});
Breadcrumbs::for('mejoras-archivo', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Mejoras');
    $trail->push('Archivo', route('admin.desk.mejoras-archivo'));
});
Breadcrumbs::for('sugerencias-create', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Sugerencias');
    $trail->push('Crear', route('admin.reportes-sugerencias'));
});
Breadcrumbs::for('sugerencias-edit', function ($trail, $sugerencia) {
    $trail->parent('centro-atencion');
    $trail->push('Sugerencias');
    $trail->push('Editar', route('admin.desk.sugerencias-edit', $sugerencia));
});
Breadcrumbs::for('sugerencias-archivo', function ($trail) {
    $trail->parent('centro-atencion');
    $trail->push('Sugerencias');
    $trail->push('Archivo', route('admin.desk.sugerencias-archivo'));
});
// Breadcrumbs::for('EV360-Objetivos-Edit', function ($trail) {
//     $trail->parent('EV360-Objetivos');
//     $trail->push('Editar Objetivo', route('ev360-objetivos.edit'));
// });

Breadcrumbs::for('Mi-Perfil', function ($trail) {
    $trail->push('Mi Perfil', route('admin.inicio-Usuario.index'));
});

Breadcrumbs::for('Mi-CV', function ($trail, $empleado = null) {
    $trail->parent('Mi-Perfil');
    $trail->push('Perfil Profesional', route('admin.miCurriculum', ['empleado' => $empleado]));
});
Breadcrumbs::for('Editar-Curriculum', function ($trail, $empleado = null) {
    $trail->parent('Mi-CV', $empleado);
    $trail->push('Editar', route('admin.editarCompetencias', ['empleado' => $empleado]));
});

Breadcrumbs::for('admin.mapa-procesos', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Mapa de Procesos');
});

Breadcrumbs::for('admin.visualizarorganizacion', function ($trail) {
    $trail->push('Portal de comunicación', route('admin.portal-comunicacion.index'));
    $trail->push('Organización');
});
