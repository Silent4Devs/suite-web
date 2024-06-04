import '../../../css/common/alerts.css';
export const AlertSimple = (destroyElement = null ,destroyRegister = null, text = null) => {
    Swal.fire({
        html: `
                <div class='d-flex justify-content-center'>
                    <div class="fondo-icon-delete">
                    <i class="material-symbols-outlined custom-icon-delete">
                        delete
                    </i>
                    </div>
                </div>
                <h2 class='title'>Eliminar este elemento</h2>
                <p class='text'>${text ? text : "¿Estás seguro de querer eliminar este registro?"}</p>
                ` ,
        showCancelButton: true,
        confirmButtonText: "Si, Eliminar",
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: 'btn-primary',
            cancelButton: 'btn-secondary',
          },
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            destroyElement();
            destroyRegister();
            Swal.fire({
                html: `
                        <div class='d-flex justify-content-center'>
                            <div class="fondo-icon-succeed">
                            <span class="material-symbols-outlined custom-icon-succeed">
                                done
                            </span>
                            </div>
                        </div>
                        <h2 class='title'>Acción realizada con éxito</h2>
                        <p class='text'>Se elimino el registro exitosamente</p>
                        ` ,
            });
        }
    });
 }
