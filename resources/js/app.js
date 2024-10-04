// Laravel Echo

// import "bootstrap/dist/css/bootstrap.min.css"; // Importar CSS
import "bootstrap"; // Importar JavaScript de Bootstrap

Echo.private("user-notifications").listen("UserSessionChanged", (e) => {
    Push.create("TABANTAJ", {
        body: e.message,
        icon: "https://media.licdn.com/dms/image/C560BAQEAAuwsMNj7PQ/company-logo_200_200/0/1648073467411/tabantaj_logo?e=2147483647&v=beta&t=_qmqbkyFGaUr6pZAW9UXk7NE6zowZLlgSyNs-YSf_QI",
        timeout: 5000, // Notification will close after 4 seconds
        onClick: function () {
            // Handle notification click event if needed
            window.focus();
            this.close();
        },
    });
});

Echo.private("user-notifications").listen("UserSessionChanged", (e) => {
    // Mostrar el toast con SweetAlert2
    Swal.fire({
        title: e.message,
        icon: "info",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000, // Duración del toast en milisegundos (3 segundos)
    });
});

Echo.channel(
    "notificaciones-campana"
  ).listen(".IncidentesDeSeguridadEvent", e => {
    let mensaje = "";
    switch (e.tipo_consulta) {
      case "create":
        mensaje = `Se ha creado un nuevo ${e.slug}`;
        toastr.success(mensaje);
        break;
      case "update":
        mensaje = `El ${e.slug} con folio ${e.incidentesDeSeguridad
          .folio} ha sido actualizado`;
        toastr.info(mensaje);
        break;
      case "delete":
        mensaje = `El ${e.slug} con folio ${e.incidentesDeSeguridad
          .folio} ha sido eliminado`;
        toastr.error(mensaje);
        break;
      default:
        break;
    }
  });

  Echo.channel("notificaciones-campana").listen(".AuditoriaAnualEvent", e => {
    let mensaje = "";
    switch (e.tipo_consulta) {
      case "create":
        mensaje = `Se ha creado una nueva ${e.slug}`;
        toastr.success(mensaje);

        break;
      case "update":
        mensaje = `La ${e.slug} con fecha de inicio ${e.auditoria_anual
          .fechainicio} ha sido actualizada`;
        console.log("SE ESTA CORRIENDO EL EVENTO");
        toastr.info(mensaje);

        break;
      case "delete":
        mensaje = `La ${e.slug} con fecha de inicio ${e.auditoria_anual
          .fechainicio} ha sido eliminada`;
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
          : "N/A"} ha sido actualizada`;
        toastr.info(mensaje);
        break;
      case "delete":
        mensaje = `La ${e.slug} con tema ${e.accion_correctiva.tema != null
          ? e.accion_correctiva.tema
          : "N/A"} ha sido eliminada`;
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
        mensaje = `El ${e.slug} con nombre ${e.registro_mejora
          .nombre} ha sido actualizado`;
        toastr.info(mensaje);
        break;
      case "delete":
        mensaje = `EL ${e.slug} con nombre ${e.registro_mejora
          .nombre} ha sido eliminado`;
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
        mensaje = `El ${e.slug} con nombre ${e.recurso
          .cursoscapacitaciones} ha sido actualizado`;
        toastr.info(mensaje);
        break;
      case "delete":
        mensaje = `EL ${e.slug} con nombre ${e.recurso
          .cursoscapacitaciones} ha sido eliminado`;
        toastr.error(mensaje);
        break;
      default:
        break;
    }
  });

  Echo.channel("notificaciones-campana").listen(".PoliticasSgiEvent", e => {
    let mensaje = "";
    console.log('PoliticasSgiEvent recibido:', e); // Para verificar la recepción

    switch (e.tipo_consulta) {
        case "create":
            mensaje = `Se ha creado un nuevo ${e.slug}`;
            toastr.success(mensaje);
            break;
        case "update":
            mensaje = `El ${e.slug} ha sido actualizado`;
            toastr.info(mensaje);
            break;
        case "delete":
            mensaje = `El ${e.slug} ha sido eliminado`;
            toastr.error(mensaje);
            break;
        default:
            console.warn('Tipo de consulta no reconocido:', e.tipo_consulta);
            break;
    }
});
