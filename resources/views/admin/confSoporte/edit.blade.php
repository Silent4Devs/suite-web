@extends('layouts.admin')
@section('content')

<h5 class="col-12 titulo_general_funcion">Editar: Partes Interesadas</h5>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" class="row" action="{{ route('admin.configurar-soporte.update', [$ConfigurarSoporteModel->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-md-4">
                <label class="required" for="rol"> <i class="fas fa-user-tie iconos-crear"></i>Rol</label>
                <select class="form-control" id="rol" name="rol">
                    <option value="Consultor" @if ($ConfigurarSoporteModel->rol == "Consultor") {{ 'selected' }} @endif>Consultor</option>
                    <option value="Soporte técnico" @if ($ConfigurarSoporteModel->rol == "Soporte técnico") {{ 'selected' }} @endif>Soporte técnico</option>
                </select>
            </div>
            <div class="form-group col-md-4 col-sm-4">
                <label for="id_elaboro"><i class="fas fa-user-tie iconos-crear"></i>Empleado</label>
                <select class="form-control {{ $errors->has('id_elaboro') ? 'is-invalid' : '' }}"
                    name="id_elaboro" id="id_elaboro">
                    <option value disabled {{ old('id_elaboro', null) === null ? 'selected' : '' }}>
                        Selecciona una opción</option>
                    @foreach ($empleados as $key => $label)
                        <option data-name="{{ $label->name }}" value="{{ $label->id }}" {{ old('id_elaboro', $ConfigurarSoporteModel->id_elaboro) == $label->id ? 'selected' : '' }}>{{ $label->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('id_elaboro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_elaboro') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-4 col-sm-4">
                <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto </label>
                <select class="form-control {{ $errors->has('id_puesto') ? 'is-invalid' : '' }}"
                    name="puesto" id="id_puesto" style="pointer-events: none; background-color: #e9ecef; opacity: 1; -webkit-appearance: none;" >
                    <option value {{ old('id_puesto', null) === null ? 'selected' : '' }}>
                        Selecciona una opción</option>
                    @foreach ($empleados as $key => $label)
                        <option  data-name="{{ $label->puesto }}" value="{{ $label->id }}" {{ old('id_elaboro', $ConfigurarSoporteModel->puesto) == $label->id ? 'selected' : '' }}>{{ $label->puesto }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('id_puesto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_puesto') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-4 col-sm-4">
                <label for="id_telefono"><i class="fas fa-briefcase iconos-crear"></i>Telefono</label>
                <input class="form-control {{ $errors->has('id_telefono') ? 'is-invalid' : '' }}" type="string" maxlength="10"
                    id="id_telefono" name="telefono" value="{{ old('telefono', $ConfigurarSoporteModel->telefono) }}" style="pointer-events: none; background-color: #e9ecef; opacity: 1;">
                @if ($errors->has('id_telefono'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_telefono') }}
                    </div>
                @endif
            </div> 
            <div class="form-group col-md-4 col-sm-4">
                <label for="id_extension"><i class="fas fa-briefcase iconos-crear"></i>Extensión</label>
                <input class="form-control {{ $errors->has('id_extension') ? 'is-invalid' : '' }}" type="string" maxlength="10"
                    id="id_extension" name="extension" value="{{ old('extension', $ConfigurarSoporteModel->extension) }}" style="pointer-events: none; background-color: #e9ecef; opacity: 1;">
                @if ($errors->has('id_extension'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_extension') }}
                    </div>
                @endif
            </div> 
            <div class="form-group col-md-4 col-sm-4">
                <label for="id_telefono_movil"><i class="fas fa-briefcase iconos-crear"></i>Telefono Móvil</label>
                <input class="form-control {{ $errors->has('id_telefono_movil') ? 'is-invalid' : '' }}" type="string" maxlength="10"
                    id="id_telefono_movil" name="tel_celular" value="{{ old('tel_celular', $ConfigurarSoporteModel->tel_celular) }}" style="pointer-events: none; background-color: #e9ecef; opacity: 1;">
                @if ($errors->has('id_telefono_movil'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_telefono_movil') }}
                    </div>
                @endif
            </div>  
            <div class="form-group col-md-4 col-sm-4">
                <label for="id_email"><i class="fas fa-briefcase iconos-crear"></i>Correo</label>
                <input class="form-control {{ $errors->has('id_email') ? 'is-invalid' : '' }}" type="string" maxlength="10"
                    id="id_email" name="correo" value="{{ old('correo', $ConfigurarSoporteModel->correo) }}" style="pointer-events: none; background-color: #e9ecef; opacity: 1;">
                @if ($errors->has('id_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_email') }}
                    </div>
                @endif
            </div>  
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
    <script type=text/javascript>
        $('#id_elaboro').change(function() {
            var elaboroID = $(this).val();
            // console.log( "id: ",  $(this).val() );
            if (elaboroID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getgetEmployeeData') }}?id=" + elaboroID,
                    success: function(res) {
                        if (res) {
                            // console.log(res);
                            // $("#id_puesto").empty();

                            console.log(res.id_puesto);

                            $("#id_puesto option[value="+res.id_puesto+"]").prop('selected', true);
                            $("#id_telefono").empty();
                            $("#id_telefono").attr("value", res.telefono);
                            $("#id_extension").empty();
                            $("#id_extension").attr("value", res.extension);
                            $("#id_telefono_movil").empty();
                            $("#id_telefono_movil").attr("value", res.telefono);
                            $("#id_email").empty();
                            $("#id_email").attr("value", res.email);
                        } else {
                            $("#id_puesto").empty();
                            $("#id_telefono").empty();
                            $("#id_extension").empty();
                            $("#id_telefono_movil").empty();
                            $("#id_email").empty();
                        }
                    }
                });
            } else {
                $("#id_puesto").empty();
                $("#id_telefono").empty();
                $("#id_extension").empty();
                $("#id_telefono_movil").empty();
                $("#id_email").empty();
            }
        });
    </script>
@endsection
