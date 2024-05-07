{/* <script> */}
        function mostrarAlerta(url) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás deshacer esta acción',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Coloca aquí la lógica para eliminar el elemento
                    // Esto puede incluir una solicitud AJAX al servidor o cualquier otra lógica de eliminación
                    // Una vez que el elemento se haya eliminado, puedes mostrar un mensaje de éxito
                    Swal.fire('¡Eliminado!', 'El elemento ha sido eliminado.', 'success');
                    console.log(url);
                    window.location.href = url;
                }
            });
        }

        function mostrarAlertaVinculacion(url) {
            Swal.fire({
                title: '¿Vincular?',
                text: 'No podrás deshacer esta acción',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: 'Sí, vincular',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Vinculado!', 'El elemento ha sido vinculado.', 'success');
                    console.log(url);
                    window.location.href = url;
                }
            });
        }
    // </script>
