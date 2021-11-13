@extends('layouts.admin')
@section('content')

    <style>
        .select-revisores .select2-selection {
            height: 50px !important;
        }

        .select-revisores .select2-selection,
        .select-revisores textarea {
            border: 2px solid #0b9095 !important;
            height: 50px !important;
        }

        .labels-publicacion {
            color: #0b9095 !important;
            font-weight: normal !important;
        }

    </style>

    <div class="form-group">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="mb-3 d-flex select-revisores">
                <label for="id_amenaza"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                <select class="revisoresSelect" id="revisores1" name="revisores1[]" multiple="multiple">
                    @foreach ($empleados as $empleado)
                        <option data-image="{{ $empleado->foto }}" data-id-empleado="{{ $empleado->id }}"
                            data-gender="{{ $empleado->genero }}" value="{{ $empleado->id }}">
                            {{ $empleado->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="revisores1_error"></span>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="mb-3 d-flex select-revisores">
                <div class="circulo"><i class="fas fa-user-tie iconos-crear"></i>Aprobador</div>
                <select class="revisoresSelect" id="revisores1" name="revisores1[]" multiple="multiple">
                    @foreach ($empleados as $empleado)
                        <option data-image="{{ $empleado->foto }}" data-id-empleado="{{ $empleado->id }}"
                            data-gender="{{ $empleado->genero }}" value="{{ $empleado->id }}">
                            {{ $empleado->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="revisores1_error"></span>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('select').select2({
                theme: 'bootstrap4',
            });

            $('select.empleado').select2({
                theme: 'bootstrap4',
                templateResult: formatState,
                templateSelection: formatState
            });

            $('.revisoresSelect').select2({
                theme: 'bootstrap4',
                templateResult: formatState,
                templateSelection: formatStateMulti
            });

        });
    </script>

@endsection
