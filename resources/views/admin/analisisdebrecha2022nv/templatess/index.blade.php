@extends('layouts.admin')
@section('content')
    <style>
        .card-main {
            top: 135px;
            left: 286px;
            width: 1000px;
            height: 138px;
            /* UI Properties */
            background: #3B7EB2;
            border-radius: 8px;
            opacity: 1;
            display: flex;
            align-items: center;
            /* Centra verticalmente los elementos en el contenedor */
        }

        .titulo-card {
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal 600 var(--unnamed-font-size-20)/27px Segoe UI;
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: left;
            font: normal normal 600 20px/27px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            margin-bottom: 55px;
        }

        .texto-card {
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) 12px/16px Segoe UI;
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: left;
            font: normal normal normal 12px/16px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            margin-right: 60px;
            margin-left: 20px:
        }

        .container {
            display: flex;
            align-items: center;
            /* Centra verticalmente los elementos en el contenedor */
        }

        .left-image {
            flex: 0.25;
            /* El 50% del ancho disponible para la imagen */
        }

        .right-content {
            flex: 3;
            /* El 50% del ancho disponible para el contenido */
        }

        .titulo {
            text-align: left;
            font: normal normal 600 24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            margin-left: 5px;
            margin-bottom: 12px;
        }

        .display-analisis {
            /* Layout Properties */
            width: 410px;
            height: 402px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #00000024;
            border-radius: 14px;
            opacity: 1;
            margin-top: 30px;
            margin-bottom: 100px;
        }

        .titulo-display-analisis {
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal medium 13px/16px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-606060);
            text-align: center;
            font: normal normal medium 13px/16px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .boton-display {
            /* Layout Properties */
            top: 595px;
            left: 541px;
            width: 100px;
            height: 35px;
            /* UI Properties */
            background: #0489FE 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #00000029;
            opacity: 1;
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/17px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: center;
            font: normal normal normal 17px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
            border-radius: 4px;
            margin: 15px 155px 0px 155px;
            padding-top: 6px;
        }

        .letra-boton-display {
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) var(--unnamed-font-size-14)/17px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: center;
            font: normal normal normal 17px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
        }

        .card-datos {
            /* Layout Properties */
            top: 309px;
            left: 286px;
            width: 1000px;
            height: 296px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
            opacity: 1;
            margin: 30px 0px 30px 0px;
        }

        .card-middle-datos {
            /* Layout Properties */
            top: 625px;
            left: 286px;
            width: 1000px;
            height: 240px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
            opacity: 1;
            margin: 30px 0px 30px 0px;
        }

        .card-small-datos {
            /* Layout Properties */
            top: 884px;
            left: 286px;
            width: 1000px;
            height: 62px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
            opacity: 1;
            margin: 30px 0px 30px 0px;
        }

        .seccion {
            /* Layout Properties */
            top: 966px;
            left: 286px;
            width: 121px;
            height: 29px;
            /* UI Properties */
            background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
            background: #306BA9 0% 0% no-repeat padding-box;
            border-radius: 10px 10px 0px 0px;
            opacity: 1;
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) 18px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-ffffff);
            text-align: left;
            font: normal normal normal 18px/20px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
            padding-left: 20px;
            padding-top: 5px;
        }

        .linea-seccion {
            top: 986px;
            left: 286px;
            width: 1000px;
            height: 11px;
            background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
            background: #306BA9 0% 0% no-repeat padding-box;
            border-radius: 0px 10px 0px 0px;
            opacity: 1;
        }

        .card-seccion {
            top: 987px;
            left: 286px;
            width: 1000px;
            height: 186px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 0px 8px 0px 8px;
            opacity: 1;
            margin-bottom: 30px;
        }

        .card-formulario-seccion {
            /* Layout Properties */
            top: 1193px;
            left: 286px;
            width: 1000px;
            height: 244px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
            opacity: 1;
            margin-bottom: 30px;
        }

        .titulo-card-template {
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal var(--unnamed-font-weight-normal) 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-306ba9);
            text-align: left;
            font: normal normal normal 16px/20px Roboto;
            letter-spacing: 0px;
            color: #306BA9;
            opacity: 1;
        }

        .data-descripcion-card {
            top: 1058px;
            left: 316px;
            width: 936px;
            height: 86px;
            /* UI Properties */
            border: 1px solid var(--unnamed-color-d5d5d5);
            background: #F8FAFC 0% 0% no-repeat padding-box;
            border: 1px solid #D5D5D5;
            border-radius: 4px;
            opacity: 1;
            margin: 0px 20px 20px 20px;
        }
    </style>
    <h5 class="titulo">Construir Evaluación para medir el cumplimiento del Análisis de Brechas</h5>

    <div class="card-main">
        <div class="left-image">
            <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}"
                style="margin: 9px 10px 10px 10px; width: 128px; height: 119px;">
        </div>
        <div class="right-content">
            <div class="">
                <div class="titulo-card" style="margin-left:15px;">Crea tu template
                    <div class="texto-card" style="margin-top:10px;">Genera tus preguntas y personaliza tus campos según lo
                        requieras
                    </div>
                    <div class="texto-card" style="margin-top:5px;">Elaboraremos nuestro cuestionario que nos permitirá
                        evaluar el
                        cumplimiento de nuestra norma selaccionada.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-datos">
        <div class="titulo-card-template">Datos Generales</div>
    </div>
    <div class="card-middle-datos">

    </div>
    <div class="card-small-datos">

    </div>
    <div>
        <div class="seccion">Sección 1</div>
        <div class="linea-seccion"></div>
        <div class="card-seccion">
            <div>
                <div class="data-descripcion-card">Descripcion*
                </div>

            </div>
        </div>
        <div class="card-formulario-seccion"></div>
    </div>
@endsection
