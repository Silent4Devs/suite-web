<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!--DOMPDF Funciona con Bootstrap 3.3.6-->
    <style>
        .thead-dark {
            background-color: #343A40;
            color: white;
        }

        .bg-info {
            background: #3490DC;
            color: white;
        }

        .titulo_1 {
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .titulo_2 {
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .titulo_3 {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .parrafo {
            font-size: 12px;
            font-family: 'Times New Roman', Times, serif;
            text-align: justify;
        }

        .sombreado {
            background-color: #D9D9D9;
        }

        /** Define the margins of your page **/
        @page {
            margin: 115px 80px 40px 80px;
        }

        header {
            position: fixed;
            top: -95px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px; */
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px; */
        }

    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <table class="table table-bordered" style="font-size: 12px;">
            <tr>
                <td class="text-center" style="vertical-align: middle">
                    <img src="{{ asset($logotipo) }}" alt="" width="64">
                    {{-- <p class="m-0">
                        <strong>
                            {{ $organizacion->empresa }}
                        </strong>
                    </p> --}}
                </td>
                <td class="text-center font-weight-bold"
                    style="vertical-align: middle;font-size: 1.2rem; font-weight: normal">
                    <span style="font-weight: bold">Estudio de contexto</span>
                </td>
                <td class="text-center font-weight-bold" style="vertical-align: middle;font-size: 1.2rem;">
                    <span><strong>{{ $control_documento->clave }}</strong></span><br>
                    <span>Versión: <strong>{{ $control_documento->version }}</strong></span><br>
                    <span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
                </td>
            </tr>
        </table>
    </header>

    {{-- <footer>
        
    </footer> --}}

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        {{-- <p style="page-break-after: never;"></p> --}}
        {{-- <p class="text-primary">CONTENIDO</p> --}}
        <h1 style="font-size: 16px" class="text-primary titulo_1">Introducción</h1>
        <p class="parrafo">{{ $organizacion->empresa }} determinará a través de este documento las cuestiones externas
            e
            internas que
            son pertinentes para su
            propósito y que afectan su capacidad para lograr los resultados previstos de su Sistema de Gestión de
            Seguridad de la Información (SGSI) para entender su contexto en las dos perspectivas mencionadas.</p>

        {{-- OBJETIVO --}}
        <h1 style="font-size: 16px" class="text-primary titulo_1">Objetivo</h1>
        <p class="parrafo">Establecer en {{ $organizacion->empresa }} el contexto del SGSI en cumplimiento de los
            requisitos de
            la
            norma ISO 27001 recogidos en la cláusula 4 de la Norma.</p>

        {{-- DEFINICIONES --}}
        <h1 style="font-size: 16px" class="text-primary titulo_1">Definiciones</h1>
        <table class="table table-bordered parrafo" style="font-size: 12px;">
            <thead class="thead-dark">
                <tr>
                    <th>Concepto</th>
                    <th>Definición</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="sombreado">Alcance</td>
                    <td>Ámbito de la organización que queda sometido al SGSI.</td>
                </tr>
                <tr>
                    <td class="sombreado">Contexto interno</td>
                    <td>Entorno interno en el que la organización busca alcanzar sus objetivos.</td>
                </tr>
                <tr>
                    <td class="sombreado">Contexto Externo</td>
                    <td>Entorno externo en el que la organización busca alcanzar sus objetivos.
                        El contexto externo puede incluir:
                        <ul>
                            <li>
                                El entorno cultural, social, político, jurídico, reglamentario, financiero,
                                tecnológico, económico, natural y competitivo, ya sea internacional, nacional, regional
                                o local;
                            </li>
                            <li>
                                Influencias y tendencias clave que tienen impacto en los objetivos de la organización.
                            </li>
                            <li>
                                Los valores de actores externos y como es percibida la organización (sus relaciones con
                                el entorno externo).
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="sombreado">FODA</td>
                    <td>Metodología donde se conforma un cuadro de la situación actual de la
                        organización permitiendo de
                        esta manera obtener un diagnóstico preciso para tomar decisiones (estrategias) que favorezcan el
                        posicionamiento de este. El análisis FODA está compuesto por una evaluación de las competencias
                        internas como fortalezas (F), debilidades (D), y las competencias externas como las
                        oportunidades (O) y amenazas (A), dónde nos proporciona un esquema para la toma de decisiones
                        estratégicas.</td>
                </tr>
                <tr>
                    <td class="sombreado">ISO 27001</td>
                    <td>ISO 27001 es una norma desarrollada por ISO (organización internacional de
                        Normalización) con el
                        propósito de ayudar a gestionar la Seguridad de la Información en una empresa. La nomenclatura
                        exacta de la Norma actual es ISO/IEC 27001 que es la revisión de la norma en su primera versión
                        que fue publicada en el año 2005 como una adaptación de ISO de la norma británica BS 7799-2</td>
                </tr>
                <tr>
                    <td class="sombreado">Misión</td>
                    <td>Es una declaración escrita en la que se describe la razón de ser de la empresa
                        y su objetivo
                        principal. Es una declaración de los principios corporativos y debe redactarse expresamente para
                        cada empresa u organización.</td>
                </tr>
                <tr>
                    <td class="sombreado">Organización</td>
                    <td>Persona o grupo de personas que tiene sus propias funciones con
                        responsabilidades, autoridades y
                        relaciones para lograr sus objetivos.</td>
                </tr>
                <tr>
                    <td class="sombreado">Parte interesada</td>
                    <td>Persona u organización que puede afectar, verse afectada o percibirse como
                        afectada por una
                        decisión o actividad.</td>
                </tr>
                <tr>
                    <td class="sombreado">Requisitos</td>
                    <td>Necesidad o expectativa que se declara, generalmente implícita u obligatoria.
                        "Generalmente
                        implícito" significa que es una práctica habitual o común para la organización y las partes
                        interesadas que la necesidad o expectativa en cuestión esté implícita. Un requisito especificado
                        es uno que se establece, por ejemplo, en la necesidad de contar con información documentada.
                    </td>
                </tr>
                <tr>
                    <td class="sombreado">Seguridad de la Información</td>
                    <td>Preservación de la confidencialidad, integridad y disponibilidad de la
                        información. Además, hay
                        que considerar otras propiedades, como la autenticidad, la responsabilidad, el no repudio y la
                        confiabilidad también pueden estar involucrados.</td>
                </tr>
                <tr>
                    <td class="sombreado">Sistema de Gestión de Seguridad de la Información</td>
                    <td>Un sistema de gestión para la Seguridad de la información se compone de una
                        serie de procesos
                        para implementar, mantener y mejorar de forma continua la seguridad de la información tomando
                        como base los riesgos que afectan a la seguridad de la información en una empresa u organización
                    </td>
                </tr>
                <tr>
                    <td class="sombreado">Visión</td>
                    <td>Describe el objetivo que espera lograr una empresa en un futuro.</td>
                </tr>
            </tbody>
        </table>
        {{-- SOBRE LA EMPRESA --}}
        <h1 class="text-primary titulo_1">Sobre la empresa</h1>
        <h2 class="text-primary titulo_2">Generales</h2>
        <table class="table table-bordered parrafo" style="font-size: 12px;">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2">DATOS GENERALES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre de la empresa: </td>
                    <td>{{ $organizacion->empresa }}</td>
                </tr>
                <tr>
                    <td>Dirección: </td>
                    <td>{{ $organizacion->direccion }}</td>
                </tr>
                <tr>
                    <td>Teléfono(s): </td>
                    <td>{{ $organizacion->telefono }}</td>
                </tr>
                <tr>
                    <td>Página Web: </td>
                    <td>{{ $organizacion->pagina_web }}</td>
                </tr>
                <tr>
                    <td>Giro: </td>
                    <td>{{ $organizacion->giro }}</td>
                </tr>
                <tr>
                    <td>Productos o Servicios: </td>
                    <td>{{ $organizacion->servicios }}</td>
                </tr>
            </tbody>
        </table>
        <h2 class="text-primary titulo_2">Antecedentes</h2>
        <p class="parrafo">
            {{ $organizacion->antecedentes }}
        </p>
        <h2 class="text-primary titulo_2">Misión</h2>
        <p class="parrafo">
            {{ $organizacion->mision }}
        </p>
        <h2 class="text-primary titulo_2">Visión</h2>
        <p class="parrafo">
            {{ $organizacion->vision }}
        </p>

        {{-- MARCO LEGAL --}}
        <h1 class="text-primary titulo_1">Marco Legal y Regulatorio</h1>
        <p class="parrafo">
            A continuación, se enlistan los requisitos legales, regulatorios y de otros tipos aplicables para
            establecer, implantar y mantener el SGSI en {{ $organizacion->empresa }}.
        </p>
        <table class="table table-bordered parrafo">
            <thead>
                <tr>
                    <th colspan="9" class="text-center thead-dark">MATRÍZ DE REQUISITOS LEGALES Y REGULATORIOS</th>
                </tr>
                <tr>
                    <th class="sombreado">No.</th>
                    <th class="sombreado">Nombre</th>
                    <th class="sombreado">Fecha de expedición</th>
                    <th class="sombreado">Fecha de entrada en vigor</th>
                    <th class="sombreado">Determinación del requisito a cumplir</th>
                    <th class="sombreado">¿Se cumple con el requisito?</th>
                    <th class="sombreado">¿De qué forma se cumple?</th>
                    <th class="sombreado">Periodicidad de Cumplimiento</th>
                    <th class="sombreado">Fecha de Verificación</th>
                </tr>
            </thead>
            <tbody>
                @if ($matriz_requisitos_legales)
                    @foreach ($matriz_requisitos_legales as $index => $requisito_legal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $requisito_legal->nombrerequisito }}</td>
                            <td>{{ $requisito_legal->fechaexpedicion }}</td>
                            <td>{{ $requisito_legal->fechavigor }}</td>
                            <td>{{ $requisito_legal->requisitoacumplir }}</td>
                            <td>{{ $requisito_legal->cumplerequisito }}</td>
                            <td>{{ $requisito_legal->formacumple }}</td>
                            <td>{{ $requisito_legal->periodicidad_cumplimiento }}</td>
                            <td>{{ $requisito_legal->fechaverificacion }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- Factores Internos y Externos --}}
        <h1 class="text-primary titulo_1">Factores Internos y Externos</h1>
        <p class="parrafo">
            {{ $organizacion->empresa }} determina las cuestiones externas e internas que son pertinentes para su
            propósito y que afectan su capacidad para lograr los resultados previstos en su Sistema de Gestión de
            Seguridad de la Información (SGSI). Para este fin se emplea la metodología FODA.
        </p>
        <table class="table table-bordered parrafo">
            <thead>
                <tr>
                    <th></th>
                    <th class="sombreado">FORTALEZAS</th>
                    <th class="sombreado">DEBILIDADES</th>
                </tr>
            </thead>
            <tbody>
                @if ($foda)
                    <tr>
                        <td class="sombreado">ORIGEN INTERNO</td>
                        <td>{!! $foda->fortalezas !!}</td>
                        <td>{!! $foda->debilidades !!}</td>
                    </tr>
                    <tr>
                        <td style="border: none !important">&nbsp;</td>
                        <th class="sombreado">OPORTUNIDADES</th>
                        <th class="sombreado">AMENAZAS</th>
                    </tr>
                    <tr>
                        <td class="sombreado">ORIGEN EXTERNO</td>
                        <td>{!! $foda->oportunidades !!}</td>
                        <td>{!! $foda->amenazas !!}</td>
                    </tr>
                @else
                    <tr>
                        <td class="sombreado">ORIGEN INTERNO</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border: none !important">&nbsp;</td>
                        <th class="sombreado">OPORTUNIDADES</th>
                        <th class="sombreado">AMENAZAS</th>
                    </tr>
                    <tr>
                        <td class="sombreado">ORIGEN EXTERNO</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Determinación de las partes interesadas --}}
        <h1 class="text-primary titulo_1">Determinación de las partes interesadas</h1>
        <p class="parrafo">
            {{ $organizacion->empresa }} determina las partes interesadas que son relevantes para el SGSI, tomando en
            cuenta los requisitos de cumplimiento legal y regulatorio, así como obligaciones contractuales.
        </p>
        <table class="table table-bordered parrafo">
            <thead>
                <tr class="text-center text-white thead-dark">
                    <th colspan="3" class="text-center ">PARTES INTERESADAS</th>
                </tr>
                <tr>
                    <th class="sombreado">Nombre</th>
                    <th class="sombreado">Requisito</th>
                    <th class="sombreado">Cláusula que satisface el requisito de la parte interesada</th>
                </tr>
            </thead>
            <tbody>
                @if ($partes_interesadas)
                    @foreach ($partes_interesadas as $parte_interesada)
                        <tr>
                            <td>{{ $parte_interesada->parteinteresada }}</td>
                            <td>{{ $parte_interesada->requisitos }}</td>
                            <td>{{ $parte_interesada->clausala }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- Determinación del alcance del Sistema de Gestión de la Seguridad de la Información --}}
        <h1 class="text-primary titulo_1">Determinación del alcance del Sistema de Gestión de la Seguridad de la
            Información</h1>
        <p class="parrafo">
            {{ $organizacion->empresa }} Nombre Empresa determina los límites y la aplicabilidad del Sistema de
            Gestión de la Seguridad de la Información
            para establecer su alcance:
            #Alcance Empresa
        </p>

        <table class="table text-center table-bordered parrafo">
            <thead>
                <tr>
                    <th class="text-center sombreado" style="width: 40%">Elaboró</th>
                    <th class="text-center sombreado" style="width: 60%">Firma</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" style="width: 40%">José Luis García Muciño <br>
                        Coordinador Ejecutivo en Procesos Administrativos
                    </td>
                    <td class="text-center" style="width: 60%">&nbsp;</td>
                </tr>
                <tr>
                    <th style="width: 40%" class="text-center sombreado">Revisó</th>
                    <th style="width: 60%" class="text-center sombreado">Firma</th>
                </tr>
                <tr>
                    <td class="text-center" style="width: 40%">Salvador Mariano González Font <br>
                        Jefe de Departamento de Informática, Base de Datos y Seguridad
                    </td>
                    <td class="text-center" style="width: 60%">&nbsp;</td>
                </tr>
            </tbody>
        </table>

        {{-- <p style="page-break-after: always;">
            Content Page 2
        </p> --}}
    </main>
</body>

</html>
