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

        .title-ejemplo {
            text-align: left;
            font: normal normal medium 22px/20px Roboto;
            letter-spacing: 0px;
            color: #818181;
            opacity: 1;
        }

        .ejemploE {
            width: 68px;
            height: 52px;
            background: #FFCF9E 0% 0% no-repeat padding-box;
            border: 1px solid #B5B5B5;
            opacity: 1;
        }

        .input-disabled {
            background: #E8F3FF 0% 0% no-repeat padding-box !important;
            border: 1px solid #C5C5C5;
            opacity: 1;
        }

        .column-asignar {
            text-align: left;
            font: normal normal normal 12px Roboto;
            letter-spacing: 0px;
            color: var(--color-tbj);
            opacity: 1;
        }

        .title-rango {
            text-align: left;
            font: normal normal medium 14px/20px Roboto;
            letter-spacing: 0px;
            color: #575757;
            opacity: 1;
        }

        .subtitle-rango {
            text-align: left;
            font: normal normal normal 14px/17px Roboto;
            letter-spacing: 0px;
            color: #575757;
            opacity: 1;
        }

        .btnBack {
            width: 142px;
            height: 48.5px;
            text-align: "center";
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid var(--color-tbj);
            border-radius: 6px;
            opacity: 1;
            margin-right: 12px;
            color: var(--color-tbj);
        }

        .btnDraft {
            background: 'none';
            color: var(--color-tbj);
            height: 45px;
            border: "none";
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
            @include('admin.analisis-riesgos.components.tbEscalasPrincipal', ['template_id' => $id])
        </div>
        <div class="select-option">
            @include('admin.analisis-riesgos.components.tbGenerateTemplate', ['template_id' => $id])
        </div>
        <div class="select-option">
            @include('admin.analisis-riesgos.components.tbGenerateFormulas', ['template_id' => $id])
        </div>
        <div class="select-option">
            @include('admin.analisis-riesgos.components.tbGenerateSettings', ['template_id' => $id])
        </div>
        <div class="select-option">
            @include('admin.analisis-riesgos.components.tbTemplateViewPrev', ['template_id' => $id])
        </div>
    </div>

    {{-- <button id="miBoton">Haz clic aquí</button> --}}
    <div class="row">
        <div class="col-12 col-sm-6">
            <button id="btnDraft" type="button" class="btn btnDraft mt-3 ml-0">GUARDAR EN BORRADOR</button>
        </div>
        <div class="col-12 col-sm-6">
            <div class="d-flex justify-content-end">
                <button id="btnBack" type="button" class="btn btnBack mt-3 ml-0">Atras</button>
                <button id="miBoton" type="button" class="btn btn-primary mt-3 ml-0">GUARDAR Y CONTINUAR</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#btnDraft').on('click', function() {
                Swal.fire({
                    title: "Se ha guardado tu template como borrador.",
                    icon: "success"
                });
            })
        })
    </script>
    {{-- <script>
        var sortable = new Sortable(document.getElementById('sortable-container'), {
            animation: 150, // Animation speed (in milliseconds)
            handle: '.drag-handle', // Selector for the drag handle
            // Additional options if needed
        });
    </script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.5.0/echarts.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
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

    {{-- Reload and save functions for node stepper  --}}
    <script>
        // node template
        function reloadGenerateFormTemplate(reload) {
            let reloadGenerateFormTemplate = new CustomEvent('updateReload', {
                detail: {
                    reload: reload
                }
            });
            window.dispatchEvent(reloadGenerateFormTemplate);
        }

        function saveGenerateFormTemplate(save) {
            let saveGenerateFormTemplate = new CustomEvent('saveFormTemplate', {
                detail: {
                    save: save
                }
            });
            window.dispatchEvent(saveGenerateFormTemplate);
        }
        //node formulas
        function reloadGenerateFormulas(reload) {
            let reloadGenerateFormulas = new CustomEvent('reloadModuleFormulas', {
                detail: {
                    reload: reload
                }
            });
            window.dispatchEvent(reloadGenerateFormulas);
        }

        function saveGenerateFormulas(save) {
            let saveGenerateFormulas = new CustomEvent('saveFormTemplateFormulas', {
                detail: {
                    save: save
                }
            });
            window.dispatchEvent(saveGenerateFormulas);
        }
        //node settigns
        function reloadGenerateSettigns(reload) {
            let reloadGenerateSettigns = new CustomEvent('reloadModuleSettigns', {
                detail: {
                    reload: reload
                }
            });
            window.dispatchEvent(reloadGenerateSettigns);
        }

        function saveGenerateSettigns(save) {
            let saveGenerateSettins = new CustomEvent('saveFormTemplateSettigns', {
                detail: {
                    save: save
                }
            });
            window.dispatchEvent(saveGenerateSettins);
        }
        //module Preview
        function reloadGeneratePreview(reload) {
            let reloadGeneratePreview = new CustomEvent('reloadModulePreview', {
                detail: {
                    reload: reload
                }
            });
            window.dispatchEvent(reloadGeneratePreview);
        }
    </script>

    {{-- script para avanzar en el stepper mediante un boton  --}}
    <script>
        $(document).ready(function() {
            let template_id = "{{ $id }}"
            const save = true;
            $('#miBoton').on('click', function() {
                let getTotalPoints = $('.point').length,
                    getIndex = $('.point--active').index();
                getAdvance = getIndex + 1;
                switch (getIndex) {
                    case 1:
                        Livewire.emit('renderSaveDataGeneral');
                        Livewire.emit('renderSaveEscala');
                        Livewire.emit('renderSaveProbImp');
                        Livewire.emit('renderReloadEscala', template_id);
                        Livewire.emit('renderReloadProbImp', template_id);
                        break;
                    case 2:
                        saveGenerateFormTemplate(save);
                        break;
                    case 3:
                        saveGenerateFormulas(save);
                        break;
                    case 4:

                        saveGenerateSettigns(save);
                        break;
                    default:
                        console.log('default btn');
                }
            });

            $('#btnBack').on('click', function() {
                let getTotalPoints = $('.point').length,
                    getIndex = $('.point--active').index();
                getback = getIndex - 1;

                console.log(getIndex)
                if (getback !== 0) {
                    $('.select-option').hide();
                    $('.select-option:nth-child(' + (getback) + ')').show();
                    TweenMax.to($('.bar__fill'), 0.6, {
                        width: (getIndex - 2) / (getTotalPoints - 1) * 100 + '%'
                    });
                    $('.point--active').prev().removeClass('point--complete');
                    $('.point--active').prev().addClass('point--active');
                    $('.point--active').next().removeClass('point--active');

                    switch (getback) {
                        case 4:
                            reloadGenerateSettigns(true);
                            // reloadGenerateFormulas(true);
                            break;
                        case 3:
                            reloadGenerateFormulas(true);
                            // reloadGenerateSettigns(true);
                            break;
                        case 2:
                            reloadGenerateFormTemplate(true);
                            break;
                        default:
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            break;
                    }
                }
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            })
        });
    </script>

    {{-- script con logica para acciones al darle click al stepper de los livewire asociados --}}
    <script>
        $(document).ready(function() {
            let template_id = "{{ $id }}"
            const reload = true;
            $('.point').on('click', function(e) {
                let getIndex = $('.point--active').index();
                switch (getIndex) {
                    case 1:
                        Livewire.emit('renderReloadEscala', template_id);
                        Livewire.emit('renderReloadProbImp', template_id);
                        break;
                    case 2:
                        reloadGenerateFormTemplate(reload)
                        break;
                    case 3:
                        reloadGenerateFormulas(reload);
                        break;
                    case 4:
                        reloadGenerateSettigns(reload);
                        break;
                    case 5:
                        reloadGeneratePreview(reload);
                    default:
                        console.log('default');
                }
            });

        });
    </script>

    {{-- script para el heatmap --}}
    <script>
        // $(document).ready(function() {
        var chartDom = document.getElementById('head-map');
        var myChart = echarts.init(chartDom);
        var option;

        // prettier-ignore
        const hours = [
            '1a', '2a', '3a', '4a'
        ];
        // prettier-ignore
        const days = [
            '1', '2', '3', '4',
        ];
        // prettier-ignore
        const data = [
                [0, 0, 1],
                [0, 1, 1],
                [0, 2, 2],
                [0, 3, 3],
                [1, 0, 1],
                [1, 1, 2],
                [1, 2, 3],
                [1, 3, 4],
                [2, 0, 2],
                [2, 1, 3],
                [2, 2, 4],
                [2, 3, 4],
                [3, 0, 3],
                [3, 1, 4],
                [3, 2, 4],
                [3, 3, 4]
            ]
            .map(function(item) {
                return [item[1], item[0], item[2] || '-'];
            });
        option = {
            tooltip: {
                position: 'top'
            },
            grid: {
                height: '40%',
                // top: '10%'
            },
            xAxis: {
                type: 'category',
                data: hours,
                splitArea: {
                    show: true
                },
                name: "Probabilidad",
                nameLocation: "center",
                nameGap: 20,
                axisLabel: {
                    show: false,
                },
                axisTick: {
                    show: false,
                },
            },
            yAxis: {
                type: 'category',
                name: 'Valor Y',
                splitArea: {
                    show: true
                },
                name: "Impacto",
                nameLocation: "center",
                nameGap: 20,
                axisLabel: {
                    show: false,
                },
                axisTick: {
                    show: false,
                },
            },
            visualMap: {
                show: false,
                min: 1,
                max: 4,
                calculable: true,
                orient: 'horizontal',
                left: 'center',
                inRange: {
                    color: ['#4BCFA2', '#F2C322', '#FF8C34', '#FC5375']
                }
                // padding:5,
                // top: '5%'
            },
            series: [{
                // name: 'Punch Card',
                type: 'heatmap',
                data: data,
                label: {
                    show: false,
                },
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        option && myChart.setOption(option);
        // })
    </script>

    <script>
        document.addEventListener('livewire:init', function() {
            let validacion1, validacion2;

            Livewire.on('validateEscala', function(newValue) {
                validacion1 = newValue;
                compararVariables();
            });

            Livewire.on('validateProb_Imp', function(newValue) {
                validacion2 = newValue;
                compararVariables();
            });

            const compararVariables = () => {

                if (validacion1 !== 'undefined' && validacion2 !== 'undefined') {
                    if (validacion1 === validacion2) {
                        console.log('Las variables son iguales:');
                        resetValidate()
                        advanceStepper()

                    }
                }
            }

            const advanceStepper = () => {
                let getTotalPoints = $('.point').length,
                    getIndex = $('.point--active').index();
                getAdvance = getIndex + 1;
                if (getIndex === 1) {
                    $('.select-option').hide();
                    $('.select-option:nth-child(' + (getAdvance) + ')').show();

                    TweenMax.to($('.bar__fill'), 0.6, {
                        width: (getIndex) / (getTotalPoints - 1) * 100 + '%'
                    });

                    $('.point--active').addClass('point--complete');
                    $('.point--active').next().addClass('point--active')
                    $('.point--active').prev().removeClass('point--active')
                }
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                reloadGenerateFormTemplate(true)
            }

            const resetValidate = () => {
                validacion1 = undefined;
                validacion2 = undefined;
            }

        });
    </script>

    {{-- Script para avanzar y recargar el siguiente modulo desde reactjs  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const advanceStepper = () => {
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
                switch (getAdvance) {
                    case 3:
                        reloadGenerateFormulas(true);
                        break;
                    case 4:
                        reloadGenerateSettigns(true);
                        break;
                    case 5:
                        reloadGeneratePreview(true);
                        break;
                    default:
                        break;
                }
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            window.addEventListener('advanceModuleTemplate', function(event) {
                var message = event.detail.message;
                if (message === true) {
                    advanceStepper();
                }

            });
        });
    </script>
@endsection
