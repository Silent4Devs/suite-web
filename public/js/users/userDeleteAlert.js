{
    /* <script> */
}
function mostrarAlerta(url) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "No podrás deshacer esta acción",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire("¡Eliminado!", response.message, "success");
                        // Aquí puedes actualizar la tabla o redirigir a otra página
                        location.reload();
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function (xhr) {
                    Swal.fire(
                        "Error",
                        "No se pudo eliminar el elemento.",
                        "error"
                    );
                },
            });
        }
    });
}

function mostrarAlertaVinculacion(userId, userName) {
    Swal.fire({
        title: "¿Vincular?",
        text: "No podrás deshacer esta acción",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, vincular",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Abre el modal en lugar de redirigir
            $(`#vincularEmpleado${userId}`).modal("show");
        }
    });
}
// </script>
