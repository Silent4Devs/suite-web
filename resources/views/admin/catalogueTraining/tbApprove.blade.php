@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="titulo_general_funcion">Catalogo de Certificaciones</h5>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 form-group pl-0 anima-focus">
                    <input id="inputName" class="form-control" placeholder="" name="name"
                        value="{{ $catalogueTraining->name }}" type="text" readonly>
                    <label for="name">Nombre de la capacitación</label>
                </div>
                <div class="col-12 col-sm-6 form-group pl-0 anima-focus">
                    <input id="inputType" class="form-control" placeholder="" name="type"
                        value="{{ $catalogueTraining->category->name }}" type="text" readonly>
                    <label for="type">Tipo de capacitación</label>
                </div>
                <div class="col-12 col-sm-6 form-group pl-0 anima-focus">
                    <input id="issuing_company" class="form-control" placeholder="" name="issuing_company"
                        value="{{ $catalogueTraining->issuing_company }}" type="text" readonly>
                    <label for="issuing_company">Empresa emisora</label>
                </div>
                <div class=" col-12 col-sm-6 form-group pl-0 anima-focus">
                    <input id="mark" class="form-control" placeholder="" name="mark"
                        value="{{ $catalogueTraining->mark }}" type="text" readonly>
                    <label for="mark">Marca</label>
                </div>
                <div class=" col-12 col-sm-6 form-group pl-0 anima-focus">
                    <input id="manufacturer" class="form-control" placeholder="" name="manufacturer"
                        value="{{ $catalogueTraining->manufacturer }}" type="text" readonly>
                    <label for="manufacturer">Fabricante</label>
                </div>
                <div class=" col-12 col-sm-6 form-group pl-0 anima-focus">
                    <input id="norma" class="form-control" placeholder="" name="norma"
                        value="{{ $catalogueTraining->norma }}" type="text" readonly>
                    <label for="norma">Norma</label>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" id="formularioRevision" enctype="multipart/form-data">
        @csrf
        <div class="card card-body shadow-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group anima-focus">
                        <textarea name="comentario" id="comentario" class="form-control" placeholder=""></textarea>
                        <label for="comentario">Comentario</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-sm btn_cancelar " type="submit" id="rechazado">Rechazar</button>
                <button class="btn btn-sm btn-success" type="submit" id="aprobado">
                    Aprobar Solicitud
                </button>
            </div>
            {{-- <div class="row">
                <div class="text-center form-group col-12">
                    <button class="btn aprobar" id="aprobado" type="submit">
                        Aprobar Solicitud
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="text-center form-group col-12">
                    <button class="btn btn-link" id="rechazado" type="submit">
                        Rechazar
                    </button>
                </div>
            </div> --}}
        </div>
    </form>

    @switch($acceso_restringido)
        @case('correcto')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        // title: 'No es posible acceder a esta vista.',
                        imageUrl: `{{ asset('img/errors/palomita_correcta.svg') }}`, // Replace with the path to your image
                        imageWidth: 100, // Set the width of the image as needed
                        imageHeight: 100,
                        html: `<h4 style="color:red;">Es tu turno para aceptar el flujo en la lista de aprobación</h4>`,
                        // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    });
                });
            </script>
        @break;
        @case('turno')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        Swal.fire({
                            // title: 'No es posible acceder a esta vista.',
                            imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                            imageWidth: 100, // Set the width of the image as needed
                            imageHeight: 100,
                            html: `<h4 style="color:red;">Aun no es tu turno de revisar la Certificación</h4>
                <br><p>No es tu turno de revisar el flujo de Certificaciones en la lista de aprobación.</p><br>`,
                            // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });

                        setTimeout(function() {
                            window.location.href =
                                '{{ route('admin.portal-comunicacion.index') }}';
                        }, 5000);
                    }, 0);
                });
            </script>
        @break

        @case('aprobado')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        Swal.fire({
                            // title: 'No es posible acceder a esta vista.',
                            imageUrl: `{{ asset('img/errors/circulo_denegado.svg') }}`, // Replace with the path to your image
                            imageWidth: 100, // Set the width of the image as needed
                            imageHeight: 100,
                            html: `<h4 style="color:red;">Se ha aprobado/rechazado el registro al que se intenta acceder</h4>
            <br><p>Ya no es necesario volverlo a revisar.</p><br>`,
                            // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });

                        setTimeout(function() {
                            window.location.href =
                                '{{ route('admin.portal-comunicacion.index') }}';
                        }, 5000);
                    }, 0);
                });
            </script>
        @break

        @case('denegado')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        Swal.fire({
                            // title: 'No es posible acceder a esta vista.',
                            imageUrl: `{{ asset('img/errors/ojo_denegado.svg') }}`, // Replace with the path to your image
                            imageWidth: 100, // Set the width of the image as needed
                            imageHeight: 100,
                            html: `<h4 style="color:red;">No tienes permiso para acceder a esta vista</h4>`,
                            // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });

                        // Redirect after 5 seconds (adjust the time as needed)
                        setTimeout(function() {
                            window.location.href =
                                '{{ route('admin.portal-comunicacion.index') }}';
                        }, 5000);
                    }, 0);
                });
            </script>
        @break

        @default
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        Swal.fire({
                            // title: 'No es posible acceder a esta vista.',
                            imageUrl: `{{ asset('img/errors/ojo_denegado.svg') }}`, // Replace with the path to your image
                            imageWidth: 100, // Set the width of the image as needed
                            imageHeight: 100,
                            html: `<h4 style="color:red;">No tienes permiso para acceder a esta vista</h4>`,
                            // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                        });

                        // Redirect after 5 seconds (adjust the time as needed)
                        setTimeout(function() {
                            window.location.href =
                                '{{ route('admin.portal-comunicacion.index') }}';
                        }, 5000);
                    }, 0);
                });
            </script>
    @endswitch
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('aprobado').addEventListener('click', function(e) {

                let aprobar =
                    "{{ route('user-catalogue-training.aprobado', $catalogueTraining) }}";
                document.getElementById('formularioRevision').setAttribute('action',
                    aprobar);

            });

            document.getElementById('rechazado').addEventListener('click', function(e) {

                let comentario_if = $("#comentario").val();
                if (comentario_if == '' || comentario_if == null) {
                    e.preventDefault();
                    Swal.fire(
                        'Debe escribir comentarios de retroalimentacion al rechazar',
                        '',
                        'info');
                } else {
                    let rechazar =
                        "{{ route('user-catalogue-training.rechazado', $catalogueTraining) }}";
                    document.getElementById('formularioRevision').setAttribute('action',
                        rechazar);
                }
            });
        });
    </script>
@endsection
