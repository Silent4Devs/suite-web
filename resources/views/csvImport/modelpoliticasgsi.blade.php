<div class="modal fade" id="xlsxImportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Importar Datos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-12'>

                        <form method="POST" action="{{ route($route, ['model' => $model]) }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}"
                                style="display: flex;">
                                <label for="csv_file" class="col-md-4 control-label"><i
                                        class="fas fa-file-excel iconos-crear"></i>Importar xslx</label>

                                <div>
                                    <input id="csv_file" type="file" id="file" class="form-control-file" name="csv_file"
                                        required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <div class="checkbox">
                                        <label style="margin-left: 15px;">
                                            <input type="checkbox" id="eliminar" name=""> Eliminar datos actuales
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text-right">
                                    <button id="btn_importar" class="btn btn-success">
                                        Procesar excel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn_importar').addEventListener('click', async function(e) {
            e.preventDefault();

            const formData = new FormData();
            const archivos = document.getElementById('csv_file').files;
            archivos.forEach(element => {
                formData.append('politica_sgi', element);
            });
            formData.append('eliminar', document.getElementById('eliminar').checked)
            formData.append('tipo', 'tabla')
            if (document.getElementById('eliminar').checked) {
                Swal.fire({
                    title: '¿Eliminar datos actuales?',
                    text: "¡Esto eliminará los datos de la base de datos!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const response  = await importar(formData)
                        if (response.status=='success') {
                            toastr.success(response.message)
                            $('#xlsxImportModal').modal('hide')
                        }
                    }
                })
            } else{
                const response = await importar(formData)
                if (response.status=='success') {
                    toastr.success(response.message)
                    $('#xlsxImportModal').modal('hide')
                }
            }

            // formData.append( 'eliminar', $('#eliminar').val() );

        })
    })

    async function importar(formData) {
        const url = "{{ route('carga-politica_sgi') }}";
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    Accept: "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            })
            const data = await response.json();
            return data;
    }

    // $("#btn_importar").on("click", function(e) {
    //     e.preventDefault();
    //     var condiciones = $("#btn_importar").is(":checked");
    //     if (!condiciones) {
    //         alert("Debe aceptar las condiciones");
    //         event.preventDefault();
    //     }
    // });
</script>
