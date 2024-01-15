@extends('layouts.admin')
<style>
    #card{
        /* UI Properties */
        height: 11rem;
        background: #306BA9 0% 0% no-repeat padding-box;
        border-radius: 8px;
        opacity: 1;
        margin: 0 auto;
    }
    .h2doc{
        position: relative;
        top: -129px;
        left: 8%;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal 600 var(--unnamed-font-size-20)/27px Segoe UI;
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-ffffff);
        text-align: left;
        font: normal normal 600 20px/27px Segoe UI;
        letter-spacing: 0px;
        color: #FFFFFF;
        opacity: 1;
    }
    .pdoc{
        position: relative;
        top: -129px;
        left: 8%;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/19px Segoe UI;
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-ffffff);
        text-align: left;
        font: normal normal normal 14px/19px Segoe UI;
        letter-spacing: 0px;
        color: #FFFFFF;
        opacity: 1;
    }
     .imgdoc{
        width: 140px;
        height: 140px;
        /* UI Properties */
        background: transparent url('img/icono_onboarding.png') 0% 0% no-repeat padding-box;
        opacity: 1;
    }
    .small {
          width: 80%;
          margin: 0 auto; /* Esto centra el div horizontalmente en la página */
        }
    #btn_cancelar{

        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        border: 1px solid var(--unnamed-color-057be2);
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #057BE2;
        border-radius: 4px;
        opacity: 1;
    }

    .card {
        border-radius: 15px; /* Puedes ajustar el valor según tus preferencias */
        overflow: hidden; /* Asegura que las esquinas redondas se apliquen correctamente */
    }
</style>
@section('content')

    {{ Breadcrumbs::render('admin.comiteseguridads.create') }}
    <h5 class="col-12 titulo_general_funcion">Conformación del Comité</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
            <div>
                <br>
                <h4>¿Qué es Conformación del Comité?</h4>
                <p>
                    Refiere al proceso de establecer un grupo de individuos con roles y responsabilidades definidos para abordar un tema o llevar a cabo una tarea específica en una organización o proyecto.
                </p>
                <p>
                    Los comités se crean para abordar una variedad de asuntos, como la toma de decisiones, la resolución de problemas  la supervisión de proyectos, la formulación de políticas, la revisión de procesos, entre otros.
                </p>
            </div>
        </div>
    </div>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.comiteseguridads.update", [$comiteseguridad->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-sm-12 col-md-12 col-lg-12  anima-focus">
                <input class="form-control  {{ $errors->has('nombre_comite') ? 'is-invalid' : '' }}"  maxlength="255" type="text"
                    name="nombre_comite" id="nombre_comite"
                    value="{{ old('nombre_comite', $comiteseguridad->nombre_comite) }}" placeholder=" " required>
                    {!! Form::label('nombre_comite', 'Nombre del Comité*', ['class' => 'asterisco']) !!}
                @if ($errors->has('nombre_comite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre_comite') }}
                    </div>
                @endif

            </div>

            <div class="form-group col-sm-12 col-md-12 col-lg-12 anima-focus">
                <textarea required class="form-control" id="descripcion" name="descripcion"  placeholder=" " rows="4">{{ old('descripcion',  $comiteseguridad->descripcion) }}</textarea>
                {!! Form::label('descripcion', 'Descripción*', ['class' => 'asterisco']) !!}
                @if ($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif

            </div>

            <div class="text-right form-group col-12" id="miDiv" style="display: none;">
                <a href="{{ route('admin.comiteseguridads.index') }}" class="btn" id="btn_cancelar" style="color:#057BE2; width:6rem; height: 10rem;">Cancelar</a>
                <button class="btn btn-primary" id="botonFormulario" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<div class="mt-4 card">
    <div class="card-body">
        @livewire('show-miembros-comite-seguridad',['id_comite'=>$comiteseguridad->id])
    </div>
</div>

<div class="text-right form-group col-12">
    <a href="{{ route('admin.comiteseguridads.index') }}" class="btn_cancelar" style="text-decoration: none;">Cancelar</a>
    <button class="btn btn-primary"  type="submit" style="width: 13%;">
        {{ trans('global.save') }}
    </button>
</div>



@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('miFormulario').addEventListener('submit', function(event) {
            // Prevenir el comportamiento predeterminado del formulario (recargar la página)
            event.preventDefault();

            // Ocultar el div al hacer clic en el botón
            document.getElementById('miDiv').style.display = 'none';
        });
    });
</script>

<script>
    document.getElementById('botonPrincipal').addEventListener('click', function() {
        // Simula el clic en el botón del formulario
        document.getElementById('botonFormulario').click();
    });
</script>

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
