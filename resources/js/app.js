// import Vue from 'vue';
// import Vuex from 'vuex';
// import FileManager from 'laravel-file-manager'

// Vue.use(Vuex);

// // create Vuex store, if you don't have it
// const store = new Vuex.Store();

// Vue.use(FileManager, { store });

// // Vue.component('file-managers',require("./components/FileManagers.vue").default);

// const app = new Vue({
//     el: "#app",
//     store,
//     data() {
//         return {
//             settings: {
//                 baseUrl: 'http://tabantaj.test/file-manager',
//                 lang: 'es',
//             }
//         }
//     }
// });

// Laravel Echo
require("./bootstrap");

Echo.channel("notificaciones-campana").listen(
    ".IncidentesDeSeguridadEvent",
    e => {

        let mensaje = "";
        switch (e.tipo_consulta) {
            case "create":
                mensaje = `Se ha creado un nuevo ${e.slug}`;
                toastr.success(mensaje);
                break;
            case "update":
                mensaje = `El ${e.slug} con folio ${e.incidentesDeSeguridad.folio} ha sido actualizado`;
                toastr.info(mensaje);
                break;
            case "delete":
                mensaje = `El ${e.slug} con folio ${e.incidentesDeSeguridad.folio} ha sido eliminado`;
                toastr.error(mensaje);
                break;
            default:
                break;
        }
    }
);

Echo.channel("notificaciones-campana").listen(".AuditoriaAnualEvent", e => {
    let mensaje = "";
    switch (e.tipo_consulta) {
        case "create":
            mensaje = `Se ha creado una nueva ${e.slug}`;
            toastr.success(mensaje);

            break;
        case "update":
            mensaje = `La ${e.slug} con fecha de inicio ${e.auditoria_anual.fechainicio} ha sido actualizada`;
            console.log("SE ESTA CORRIENDO EL EVENTO");
            toastr.info(mensaje);

            break;
        case "delete":
            mensaje = `La ${e.slug} con fecha de inicio ${e.auditoria_anual.fechainicio} ha sido eliminada`;
            toastr.error(mensaje);
            break;
        default:
            break;
    }
});

Echo.channel("notificaciones-campana").listen(".AccionCorrectivaEvent", e => {

    let mensaje = "";
    switch (e.tipo_consulta) {
        case "create":
            mensaje = `Se ha creado una nueva ${e.slug}`;
            toastr.success(mensaje);
            break;
        case "update":
            mensaje = `La ${e.slug} con tema ${e.accion_correctiva.tema != null
                ? e.accion_correctiva.tema
                : "N/A"
                } ha sido actualizada`;
            toastr.info(mensaje);
            break;
        case "delete":
            mensaje = `La ${e.slug} con tema ${e.accion_correctiva.tema != null
                ? e.accion_correctiva.tema
                : "N/A"
                } ha sido eliminada`;
            toastr.error(mensaje);
            break;
        default:
            break;
    }
});

Echo.channel("notificaciones-campana").listen(".RegistroMejoraEvent", e => {

    let mensaje = "";
    switch (e.tipo_consulta) {
        case "create":
            mensaje = `Se ha creado un nuevo ${e.slug}`;
            toastr.success(mensaje);
            break;
        case "update":
            mensaje = `El ${e.slug} con nombre ${e.registro_mejora.nombre} ha sido actualizado`;
            toastr.info(mensaje);
            break;
        case "delete":
            mensaje = `EL ${e.slug} con nombre ${e.registro_mejora.nombre} ha sido eliminado`;
            toastr.error(mensaje);
            break;
        default:
            break;
    }
});

Echo.channel("notificaciones-campana").listen(".RecursosEvent", e => {

    let mensaje = "";
    switch (e.tipo_consulta) {
        case "create":
            mensaje = `Se ha creado un nuevo ${e.slug}`;
            toastr.success(mensaje);
            break;
        case "update":
            mensaje = `El ${e.slug} con nombre ${e.recurso.cursoscapacitaciones} ha sido actualizado`;
            toastr.info(mensaje);
            break;
        case "delete":
            mensaje = `EL ${e.slug} con nombre ${e.recurso.cursoscapacitaciones} ha sido eliminado`;
            toastr.error(mensaje);
            break;
        default:
            break;
    }
});

Echo.private("App.Models.User." + window.Laravel.user).notification(e => {
    toastr.info(e.mensaje);
    Livewire.emit("render-task-count");
    Livewire.emit("render-task-list");
});

//Echo.channel("notificaciones-campana");
