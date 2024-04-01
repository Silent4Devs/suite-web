@extends('layouts.admin')

@section('content')
    <style>
        .instrucciones {
            background-color: rgb(52, 117, 178);
            color: white;
            border-radius: 8px !important;
            padding: 15px;
            margin-bottom: 20px;
        }

        .title-instru {
            text-align: left;
            font: normal normal 600 20px/27px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
        }

        .text-instru {
            text-align: left;
            font: normal normal normal 12px/16px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
        }
        .title-ejemplo{
            text-align: left;
            font: normal normal medium 22px/20px Roboto;
            letter-spacing: 0px;
            color: #818181;
            opacity: 1;
        }
        .ejemploE{
            width: 68px;
            height: 52px;
            background: #FFCF9E 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            opacity: 1;
        }
        .input-disabled{
            background: #E8F3FF 0% 0% no-repeat padding-box !important;
            border: 1px solid #C5C5C5;
            opacity: 1;
        }
    </style>

    <h5>Análisis de Riesgo</h5>

    <div class="card card-body instrucciones">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('img/analisis-riesgo/instrucion.webp') }}" class="img-fluid"
                    style="width: 192px; height: 119px;">
            </div>
            <div class="col-md-10">
                <h3 class="title-instru">¿Qué es? Análisis de Riesgo</h3>
                <p class="text-instru">El análisis de riesgos es un proceso proactivo que se utiliza para identificar,
                    evaluar y mitigar los
                    riesgos potenciales que pueden afectar a un proyecto, empresa, individuo o cualquier otra entidad. Es
                    una herramienta fundamental para la toma de decisiones estratégicas y la gestión eficaz de riesgos.
                    <br /> Es
                    una herramienta esencial para la gestión eficaz de riesgos en cualquier ámbito. Permite identificar,
                    evaluar y mitigar los riesgos potenciales, lo que ayuda a mejorar la toma de decisiones, optimizar la
                    gestión de recursos y promover una cultura de prevención.
                </p>
            </div>
        </div>
    </div>

    @include('admin.analisis-riesgos.components.tbStepper')


    <div>
        <div class="select-option">
            @include('admin.analisis-riesgos.components.tbEscalasPrincipal',['template_id' => $id])
        </div>
        <div class="select-option">Hola para Review</div>
        <div class="select-option">Hola para Payment</div>
        <div class="select-option">Hola para Success</div>
    </div>

    <button id="miBoton">Haz clic aquí</button>
@endsection

@section('scripts')
    <script>
        var sortable = new Sortable(document.getElementById('sortable-container'), {
            animation: 150, // Animation speed (in milliseconds)
            handle: '.drag-handle', // Selector for the drag handle
            // Additional options if needed
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    {{-- script para darle click al stepper --}}
    <script>
        $(document).ready(function() {
            $('.select-option:not(:first)').hide();
            $('.point').on('click', function(e) {
                var getTotalPoints = $('.point').length,
                    getIndex = $(this).index(),
                    getCompleteIndex = $('.point--active').index();
                $('.select-option').hide();
                $('.select-option:nth-child(' + (getIndex) + ')').show();

                TweenMax.to($('.bar__fill'), 0.6, {
                    width: (getIndex - 1) / (getTotalPoints - 1) * 100 + '%'
                });

                if (getIndex <= getCompleteIndex) {
                    $('.point--active').removeClass('point--complete').removeClass('point--active');
                    $(this).nextAll().removeClass('point--complete');
                    $(this).removeClass('point--complete').addClass('point--active');
                }
                if (getIndex >= getCompleteIndex) {
                    $('.point--active').removeClass('point--active');
                    $(this).addClass('point--active');
                    $(this).prevAll().addClass('point--complete');
                    $(this).nextAll().removeClass('point--complete');
                }
            });


        });
    </script>
    {{-- script para avanzar en el stepper mediante un boton  --}}
    <script>
        $(document).ready(function() {
            $('#miBoton').on('click', function() {
                // Livewire.emit('renderSaveEscala', flag = 1);
                let getTotalPoints = $('.point').length,
                    getIndex = $('.point--active').index();
                    getAdvance = getIndex + 1;

                $('.select-option').hide();
                $('.select-option:nth-child(' + (getAdvance) + ')').show();

                TweenMax.to($('.bar__fill'), 0.6, {
                    width: (getIndex) / (getTotalPoints - 1) * 100 + '%'
                });

                $('.point--active').addClass('point--complete');
                $('.point--active').next().addClass('point--active')
                $('.point--active').prev().removeClass('point--active')
            });
        });
    </script>
    {{-- script con logica para acciones al darle click al stepper de los livewire asociados --}}
    <script>
        $(document).ready(function() {
            let template_id = "{{ $id }}"
            $('.point').on('click', function(e) {
              let getIndex = $('.point--active').index();
              switch(getIndex){
                case 1:
                Livewire.emit('renderReloadEscala',template_id);
                Livewire.emit('renderReloadProbImp',template_id);

                break;
                default:
                    console.log('default');
              }
            });
            $('#miBoton').on('click', function() {
               let getIndex = $('.point--active').index();
               console.log(getIndex)
              switch(getIndex){
                case 2:
                Livewire.emit('renderSaveDataGeneral');
                Livewire.emit('renderSaveEscala');
                Livewire.emit('renderSaveProbImp');
                break;
                default:
                    console.log('default');
              }
            });
        });
    </script>

@endsection
