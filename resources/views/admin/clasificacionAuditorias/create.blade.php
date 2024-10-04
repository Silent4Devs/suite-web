@extends('layouts.admin')
@section('content')
    <style type="text/css">
        label {
            background-color: white;
            transform: translate(15px, 15px);
            padding: 0px 10px;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Catálogo Clasificación</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <p style="font-size: 18px; color: #788BAC;"><strong>Clasificación</strong></p>
                </div>
            </div>
            <form id="clasificacionForm" method="POST" action="{{ route('admin.auditoria-clasificacion.store') }}">
                @csrf
                <div class="row">
                    <div class="distancia form-group col-md-6">
                        <label for="identificador">ID</label>
                        <input class="form-control {{ $errors->has('identificador') ? 'is-invalid' : '' }}" type="number"
                            name="identificador" id="identificador" value="{{ old('identificador', '') }}" min="0"
                            max="999999">
                        @if ($errors->has('identificador'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="required">Clasificación</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', '') }}" required maxlength="220">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="distancia form-group col-md-12">
                        <label for="nombre">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.auditoria-clasificacion') }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('clasificacionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe normalmente

            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: form.attr('action'), // Usa la URL de acción del formulario
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = response
                                .redirect_url; // Redirigir después de cerrar SweetAlert
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Manejo de errores de validación
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            console.log(errors[field][
                                0
                            ]); // Aquí puedes mostrar los errores en el frontend
                        }
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error inesperado.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    </script>
@endsection
