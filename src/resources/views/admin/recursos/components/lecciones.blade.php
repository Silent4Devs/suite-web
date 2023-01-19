<div class="row">
    <div class="col-12">
        <h5>Lecciones Para La Capacitación: <strong id="tituloCapacitacionLecciones"></strong></h5>
    </div>
    <div class="col-12 text-center" id="sinSecciones">
        <p class="text-muted">Esta capacitación no contiene secciones aún</p>
    </div>
    <div class="col-12" id="contenedorSecciones"></div>
    <div class="col-12 text-center justify-content-center align-items-center mb-3">
        <button class="btn btn-primary" id="btnAgregarSeccion"><i class="fas fa-plus mr-2"></i>
            Agregar Sección
        </button>
    </div>
    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
        <button class="btn btn-danger btnGuardarDraftRecurso" type="submit" id="btnGuardarDraftRecurso">
            Borrador
        </button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnAgregarSeccion = document.getElementById('btnAgregarSeccion');
        const contenedorSecciones = document.getElementById('contenedorSecciones');
        let contador = 0;
        btnAgregarSeccion.addEventListener('click', function(e) {
            e.preventDefault();
            $('#contenedorSecciones').append(agregarSeccion(contador));
            if (contenedorSeccionesContieneNodos()) {
                sinSecciones.style.display = 'none';
            } else {
                sinSecciones.style.display = 'block';
            }
            contador++;
        })

        contenedorSecciones.addEventListener('click', function(e) {
            e.preventDefault();
            if (e.target.getAttribute('data-type') == 'agregar-leccion') {
                let contadorLeccion = Number(e.target.getAttribute('data-contador-leccion'));
                let contadorSeccion = Number(e.target.getAttribute('data-seccion-id'));
                $(`#contenedor_lecciones${contadorSeccion}`).append(agregarLeccion(contadorLeccion));
                contadorLeccion++;
                e.target.setAttribute('data-contador-leccion', contadorLeccion);
            }
            if (e.target.getAttribute('data-type') == 'eliminar-seccion') {
                const parent = e.target.closest('.card');
                Swal.fire({
                    title: '¿Quieres eliminar esta sección?',
                    text: "¡No podrás revertir esto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Conservar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        parent.remove();
                        const sinSecciones = document.getElementById('sinSecciones');
                        if (contenedorSeccionesContieneNodos()) {
                            sinSecciones.style.display = 'none';
                        } else {
                            sinSecciones.style.display = 'block';
                        }
                    }
                })
            }
            if (e.target.getAttribute('data-type') == 'eliminar-leccion') {
                const parent = e.target.closest('.card');
                Swal.fire({
                    title: '¿Quieres eliminar esta lección?',
                    text: "¡No podrás revertir esto!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Conservar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        parent.remove();
                    }
                })
            }
        })

        contenedorSecciones.addEventListener('keyup', function(e) {
            if (e.target.getAttribute('data-type') == 'cambiar-header-seccion') {
                const seccionID = e.target.getAttribute('data-seccion-id');
                const cardSeccion = document.getElementById(`header_seccion${seccionID}`);
                cardSeccion.innerText = e.target.value;
            }
            if (e.target.getAttribute('data-type') == 'cambiar-header-leccion') {
                const leccionID = e.target.getAttribute('data-leccion-id');
                const cardLeccion = document.getElementById(`header_leccion${leccionID}`);
                cardLeccion.innerText = e.target.value;
            }
        })
        contenedorSecciones.addEventListener('change', function(e) {
            if (e.target.getAttribute('data-type') == 'url-capacitacion') {
                if (!esUnaURLValidaDeYoutube(e.target.value)) {
                    toastr.info('La URL ingresada no corresponde al formato de Youtube');
                    e.target.value = null;
                }
            }
        })

        function agregarSeccion(contador) {
            let html = `
            <div class="card">
                <div class="card-header"><span id="header_seccion${contador}">Nueva Sección</span><i class="ml-2 fas fa-trash-alt text-danger"
                        style="cursor: pointer" data-type="eliminar-seccion" data-seccion-id="${contador}"></i></div>
                <div class="card-body" style="padding:10px;">
                    <div class="form-group">
                        <label for="nombre_seccion${contador}" class="required">Nombre</label>
                        <input type="text" placeholder="Nombre de la sección" value="" id="nombre_seccion${contador}" class="form-control" data-type="cambiar-header-seccion" data-seccion-id="${contador}">
                        <small class="text-muted">La sección debe contener al menos una lección</small>
                    </div>
                    <div id="contenedor_lecciones${contador}"></div>
                    <button class=" btn btn-primary" data-type="agregar-leccion" data-contador-leccion="0" data-seccion-id="${contador}"><i class="fas fa-plus mr-2"></i>Agregar Lección</button>
                </div>
            </div>
            `;
            return html;
        }

        function agregarLeccion(contadorLeccion) {
            let html = `
            <div class="card">
                <div class="card-header"><span id="header_leccion${contadorLeccion}">Nueva Lección</span><i
                        class="fas fa-trash-alt text-danger ml-2" style="cursor: pointer" data-type="eliminar-leccion" data-leccion-id="${contador}"></i></div>
                <div class="card-body" style="padding:10px;">
                    <div class="form-group">
                        <label for="nombre_leccion" class="required">Nombre</label>
                        <input type="text" placeholder="Nombre de la lección" id="nombre_leccion${contadorLeccion}"
                        data-type="cambiar-header-leccion" data-leccion-id="${contadorLeccion}"
                            class="form-control" name="secciones[${contador}][lecciones][${contadorLeccion}][name]">
                        <label for="url_leccion" class="required">URL</label>
                        <input type="text" placeholder="https://www.youtube.com/watch?v=video" id="url_leccion${contadorLeccion}" class="form-control" name="secciones[${contador}][lecciones][${contadorLeccion}][url]" data-type="url-capacitacion" data-leccion-id="${contadorLeccion}">
                    </div>
                </div>
            </div>
            `;
            return html;
        }

        function contenedorSeccionesContieneNodos() {
            if (contenedorSecciones.childElementCount !== 0) {
                return true;
            } else {
                return false;
            }
        }

        function esUnaURLValidaDeYoutube(url) {
            if (url != undefined || url != '') {
                let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                let match = url.match(regExp);
                if (match && match[2].length == 11) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    })
</script>
