@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.comiteseguridads.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Conformación del Comité</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.comiteseguridads.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label class="required" for="nombre_comite"><i class="fas fa-gavel iconos-crear"></i></i>Nombre del
                        Comité</label>
                    <input class="form-control {{ $errors->has('nombre_comite') ? 'is-invalid' : '' }}" type="text"
                        name="nombre_comite" id="nombre_comite" value="{{ old('nombre_comite', '') }}" required>
                    @if ($errors->has('nombre_comite'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre_comite') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.comiteseguridad.fields.nombrerol_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label class="required" for="descripcion"><i class="fas fa-align-justify iconos-crear"></i>Descripción</label>
                    <textarea required class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.comiteseguridad.fields.nombrerol_helper') }}</span>
                </div>



                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.comiteseguridads.index') }}" class="btn_cancelar">Cancelar</a>
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
        document.addEventListener('DOMContentLoaded', function(e) {

            let asignado = document.querySelector('#id_asignada');
            let area_init = asignado.options[asignado.selectedIndex].getAttribute('data-area');
            let puesto_init = asignado.options[asignado.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_asignada').innerHTML = recortarTexto(puesto_init);
            document.getElementById('area_asignada').innerHTML = recortarTexto(area_init);
            asignado.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_asignada').innerHTML = recortarTexto(puesto);
                document.getElementById('area_asignada').innerHTML = recortarTexto(area);
            })

            function recortarTexto(texto, length = 40)
            {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }

        })
    </script>
@endsection
