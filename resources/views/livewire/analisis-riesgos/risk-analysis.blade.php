<div>
    <style>
        .content-limit {
            display: block;
            width: 100%;
            max-width: 1200px;
            margin: 0px;
        }

        .caja-carrusel {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carrusel-infinito {
            width: 100%;
            display: flex;
            align-items: start;
            gap: 20px;
            overflow: hidden;
            padding: 5px 0px;
        }

        .arrow-carrusel-izq,
        .arrow-carrusel-der {
            width: 70px;
            height: 50px;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            cursor: pointer;
            transition: 0.1s;
        }

        .item-carrusel {
            min-width: 239px;
            width: 239px;
            height: auto;
            background-color: #fff;
            cursor: pointer;
        }

        .card-carrusel {
            width: 100%;
            height: 77px;
            margin-bottom: 0px;
            background-color: #2496AE;
            color: #FFFFFF;
            border: 1px solid #CFCFCF;
            border-radius: 8px;
            box-shadow: 0px 1px 4px #0000000F;
        }

        .datatable-rds td {
            border-bottom: none !important;
        }

        .rounded-card {
            border-radius: 16px;
        }
    </style>
    <div class="mt-4 card card-body shadow-sm" style="border-radius:16px;" wire:ignore>
        <h5>Template de Analisis de riesgos</h5>
        <h6>Seleciona el template que utilizarás para evaluar el nivel de cumplimiento de tu organización</h6>
        <div class="content-limit caja-carrusel">
            <div class="arrow-carrusel-izq" style="margin-right: 10px;">
                <i class="material-icons-outlined">arrow_back_ios</i>
            </div>
            <div class="carrusel-infinito" style="margin: 0px 10px 0px 10px;">
                @foreach ($templates as $index => $analisis)
                    <div class="item-carrusel" style="{{ $index == 0 ? 'margin-left:25px;' : '' }}"
                        wire:click="SelectCard({{ $analisis->id }})">
                        <span title="{{ $analisis->nombre }}">
                            <div class="card card-carrusel"
                                style="{{ $selectedCard === $analisis->id ? 'background-color:red;' : 'background-color:pink;' }}">
                                <div class="card-body" style="padding: 18px 32px 10px 29px;">
                                    <div class="row">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="col-2">
                                                <i class="material-icons-outlined" style="font-size:32px;">
                                                    bookmark_border
                                                </i>
                                            </div>
                                            <div class="col-10" style="padding-right:0;">
                                                <h6 style="margin-bottom: 0px;">
                                                    {{ \Illuminate\Support\Str::limit($analisis->nombre, 20, $end = '...') }}
                                                </h6>
                                                <p>Selecciona tu template</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="arrow-carrusel-der" style="margin-left: 25px;">
                <i class="material-icons-outlined">arrow_forward_ios</i>
            </div>
        </div>
        @can('admin_template_analisis_brechas_iso')
            <div class="d-flex justify-content-start" style="padding-left: 160px;">
                <a href="{{ route('admin.top-template-analisis-riesgos') }}">Ver todos</a>
            </div>
        @endcan

        <div class="d-flex justify-content-end" style="padding-right: 110px;">
            <a class="btn btn-light text-primary border border-primary" href="{{ route('admin.templates.create') }}">
                Crear template +
            </a>
        </div>
    </div>
</div>
