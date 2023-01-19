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

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white align-items-centera"><strong> Registrar: </strong>Panel declaración aplicabilidad </h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.paneldeclaracion.store') }}" class="row">
            @csrf
            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="id_amenaza"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                <select class="revisoresSelect" id="revisores" name="revisores[]" multiple="multiple">
                    @foreach ($empleados as $empleado)
                        <option data-image="{{ $empleado->foto }}" data-id-empleado="{{ $empleado->id }}"
                            data-gender="{{ $empleado->genero }}" value="{{ $empleado->id }}">
                            {{ $empleado->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label class="circulo"><i class="fas fa-user-tie iconos-crear"></i>Aprobador</label>
                <select class="revisoresSelect" id="aprobadores" name="aprobadores[]" multiple="multiple">
                    @foreach ($empleados as $empleado)
                        <option data-image="{{ $empleado->foto }}" data-id-empleado="{{ $empleado->id }}"
                            data-gender="{{ $empleado->genero }}" value="{{ $empleado->id }}">
                            {{ $empleado->name }}</option>
                    @endforeach
                </select>
            </div>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Anexo Indice</th>
                        <th>Anexo Politica</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($controles as $control)
                    <tr>
                        <td><input type="checkbox" name="controles[]" value="{{$control->id}}"/></td>
                        <td>{{$control->anexo_indice}}</td>
                        <td>{{$control->anexo_politica}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>


            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                </button>
            </div>
        </form>
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

        function formatStateMulti(opt) {
            if (!opt.id) {
                return opt.text;
            }

            var optimage = $(opt.element).attr('data-image');
            var gender = $(opt.element).attr('data-gender');
            if (!optimage) {
                let foto = 'ususario_no_cargado.png'
                if (gender == 'M') {
                    foto = 'woman.png';
                }

                if (gender == 'H') {
                    foto = 'man.png';
                }

                var $opt = $(
                    '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' + foto +
                    '" class="img-fluid rounded-circle" width="30" height="30"/></span>'
                );
                return $opt;
            } else {
                var $opt = $(
                    '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' + optimage +
                    '" class="img-fluid rounded-circle" width="30" height="30"/></span>'
                );
                return $opt;
            }
        };

        function formatState(opt) {
            if (!opt.id) {
                return opt.text;
            }

            var optimage = $(opt.element).attr('data-image');
            var gender = $(opt.element).attr('data-gender');
            if (!optimage) {
                let foto = 'ususario_no_cargado.png'
                if (gender == 'M') {
                    foto = 'woman.png';
                }

                if (gender == 'H') {
                    foto = 'man.png';
                }

                var $opt = $(
                    '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' + foto +
                    '" class="img-fluid rounded-circle" width=25 height=25/> ' +
                    opt.text + '</span>'
                );
                return $opt;
            } else {
                var $opt = $(
                    '<span><img src="{{ asset('storage/empleados/imagenes/') }}/' + optimage +
                    '" class="img-fluid rounded-circle" width=25 height=25/> ' +
                    opt.text + '</span>'
                );
                return $opt;
            }
        };
    </script>

@endsection
