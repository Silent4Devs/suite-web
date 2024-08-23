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
                    <a href="{{ route('admin.auditoria-clasificacion') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('clasificacionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe normalmente

            let form = this;
            let formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = data
                                .redirect_url; // Redirigir después de cerrar SweetAlert
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error inesperado.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
@endsection
