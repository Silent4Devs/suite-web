@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/global/TbColorsGlobal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    @include('admin.pasarelaPago.components.menu')

    <div class="content-pasarela">

        @include('admin.pasarelaPago.components.portada')


        <div class="instaladas">
            <h4>Instaladas</h4>
            <div class="row mt-4">
                @foreach ($db_subscribed_plans as $subscribed_plan)
                    <div class="col-md-6">
                        <div class="card card-body" data-toggle="modal" data-target="#{{ $subscribed_plan->slug }}">
                            <div class="d-flex align-items-center">
                                <i class="material-symbols-outlined icon-background color-{{ $subscribed_plan->img }}">{{ $subscribed_plan->img }}</i>
                                <h5>{{ $subscribed_plan->name }}</h5>
                            </div>
                            <button class="btn">Abrir</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- modales --}}
        <div class="modal fade modal-apps" id="capacitaciones" tabindex="-1" aria-labelledby="capacitaciones"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #9CEBFF;">school</i>

                            <div>
                                <h2>Capacitaciónes</h2>
                                <p>Capacitaciones</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            ¡Convierte tus conocimientos en cursos impactantes con nuestra aplicación líder en creación de
                            capacitaciones! Desde la planificación hasta la entrega, nuestra plataforma te proporciona las
                            herramientas
                            necesarias para diseñar cursos dinámicos y atractivos en cualquier tema imaginable. Con
                            características
                            intuitivas de diseño, multimedia y evaluación, crear contenido educativo nunca ha sido tan
                            fácil. ¡Empieza a
                            compartir tu experiencia con el mundo y capacita a otros para alcanzar su máximo potencial!
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            una aplicación de creación de cursos y capacitaciones ideal ofrecería un completo conjunto de
                            herramientas
                            que permiten a los usuarios diseñar contenido interactivo y multimedia, incluyendo opciones de
                            evaluación y
                            seguimiento del progreso del estudiante.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="gestor-riegos" tabindex="-1" aria-labelledby="gestor-riegos"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #FCB4BC;">gpp_maybe</i>

                            <div>
                                <h2>Gestor de Riesgos</h2>
                                <p>Seguridad</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            La gestión de riesgos es una parte fundamental de cualquier empresa exitosa. En Silent4Business,
                            entendemos la importancia de la gestión de riesgos y ofrecemos soluciones personalizadas para
                            ayudarte a identificar, evaluar y mitigar los riesgos en tu empresa.
                        </p>
                        <p>
                            Nuestro equipo de expertos en gestión de riesgos está capacitado para evaluar los riesgos
                            potenciales en cada área de tu empresa, desde la seguridad de los empleados hasta los riesgos
                            financieros. A partir de esta evaluación, podemos desarrollar estrategias y planes de mitigación
                            personalizados para minimizar el impacto de los riesgos en tu empresa.
                        </p>
                        <p>
                            Además, nuestra plataforma de gestión de riesgos te permite monitorear y actualizar
                            continuamente
                            tus estrategias de mitigación de riesgos. De esta manera, puedes estar seguro de que siempre
                            estás
                            protegiendo a tu empresa de los riesgos potenciales.
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Nuestra aplicación destaca por ofrecer características como evaluación de riesgos detallada,
                            análisis de seguridad exhaustivo, generación de informes automatizados, seguimiento continuo de
                            riesgos, y cumplimiento con los estándares de seguridad más rigurosos, proporcionando a las
                            empresas
                            las herramientas necesarias para proteger sus activos digitales y garantizar la seguridad de la
                            información de manera efectiva.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="planes-trabajo" tabindex="-1" aria-labelledby="planes-trabajo"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #B1C6FF;">overview</i>

                            <div>
                                <h2>Planes de trabajo</h2>
                                <p>Gestión</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            Optimiza la productividad de tu equipo y alcanza tus objetivos con nuestra aplicación de planes
                            de
                            trabajo. Desde la creación y asignación de tareas hasta el seguimiento del progreso y la
                            colaboración en tiempo real, nuestra plataforma te proporciona las herramientas necesarias para
                            planificar y ejecutar proyectos de manera eficiente. Con características como programación
                            flexible,
                            asignación de recursos y generación de informes detallados, estamos aquí para ayudarte a
                            alcanzar
                            tus metas de manera efectiva y sin complicaciones. ¡Descarga ahora y transforma la forma en que
                            trabajas!
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Nuestra aplicación destacara por ofrecer características como la creación y asignación de
                            tareas,
                            programación flexible, seguimiento del progreso, colaboración en tiempo real, asignación de
                            recursos, generación de informes detallados y una interfaz intuitiva, proporcionando a los
                            usuarios
                            las herramientas necesarias para planificar, coordinar y ejecutar proyectos de manera eficiente
                            y
                            sin complicaciones.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="visitantes" tabindex="-1" aria-labelledby="visitantes"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #FFD9ED;">groups</i>

                            <div>
                                <h2>Visitantes</h2>
                                <p>Gestión</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            Optimiza la seguridad y la experiencia de tus visitantes con nuestra aplicación de gestión de
                            visitantes. Desde el registro y la programación de visitas hasta el seguimiento y la gestión de
                            credenciales, nuestra plataforma te proporciona las herramientas necesarias para gestionar de
                            manera
                            eficiente y segura el flujo de personas en tus instalaciones. Con características como
                            notificaciones de llegada, identificación digital y generación de informes de actividad, estamos
                            aquí para garantizar una experiencia fluida y segura para tus visitantes. ¡Descarga ahora y haz
                            que
                            cada visita sea memorable!
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Nuestra aplicación destaca por ofrecer características como registro y programación de visitas,
                            notificaciones de llegada, identificación digital, seguimiento de visitantes en tiempo real,
                            gestión
                            de credenciales, generación de informes de actividad y una interfaz intuitiva, proporcionando a
                            los
                            usuarios las herramientas necesarias para garantizar la seguridad y la eficiencia en el manejo
                            de
                            visitantes en sus instalaciones.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="gestion-normativa" tabindex="-1" aria-labelledby="gestion-normativa"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #F1F1F1;">emoji_people</i>

                            <div>
                                <h2>Gestión Normativa</h2>
                                <p>Gestión</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            ¿Te preocupa cumplir con las regulaciones y estándares normativos de tu industria? La gestión
                            normativa es un aspecto crucial de cualquier negocio exitoso y responsable. Si bien cumplir con
                            las
                            regulaciones puede parecer abrumador, una buena gestión normativa puede ayudarte a reducir el
                            riesgo
                            de multas, sanciones y otros problemas legales.
                        </p>
                        <p>
                            En Tabantaj Business, entendemos la importancia de
                            una gestión normativa eficaz. Ofrecemos soluciones personalizadas que se adaptan a las
                            necesidades
                            específicas de tu empresa y te ayudan a cumplir con las regulaciones aplicables a tu industria.
                            Desde la gestión de la privacidad y la protección de datos hasta la gestión de la seguridad
                            alimentaria y ambiental, nuestros servicios de gestión normativa pueden ayudarte a mantener el
                            cumplimiento y minimizar el riesgo de problemas legales.
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Incluye características como centralización de información sobre regulaciones y políticas
                            internas,
                            seguimiento de requisitos normativos, evaluación de cumplimiento, gestión de riesgos,
                            actualizaciones automáticas sobre cambios regulatorios, generación de informes personalizados y
                            funciones de auditoría interna, proporcionando a los usuarios las herramientas necesarias para
                            garantizar el cumplimiento normativo en su empresa de manera efectiva y eficiente.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="gestion-contractual" tabindex="-1" aria-labelledby="gestion-contractual"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #E0C5FF;">clinical_notes</i>

                            <div>
                                <h2>Gestión Contractual</h2>
                                <p>Gestión</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            Optimiza la gestión de tus contratos con nuestra completa aplicación de gestión contractual.
                            Desde
                            la creación y seguimiento de contratos hasta la gestión de plazos y renovaciones, nuestra
                            plataforma
                            te proporciona las herramientas necesarias para mantener un control total sobre tus acuerdos.
                            Con
                            características como alertas de vencimiento, seguimiento de cambios y almacenamiento seguro de
                            documentos, estamos aquí para simplificar y fortalecer tu proceso de gestión de contratos.
                            ¡Descarga
                            ahora y lleva la eficiencia y la transparencia a tu gestión contractual!
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Nuestra aplicación ofrece características como creación y seguimiento de contratos, alertas de
                            vencimiento, gestión de plazos y renovaciones, seguimiento de cambios, almacenamiento seguro de
                            documentos, generación de informes y una interfaz intuitiva, proporcionando a los usuarios las
                            herramientas necesarias para administrar eficientemente sus contratos, garantizar el
                            cumplimiento de
                            los términos y optimizar los procesos relacionados con la gestión contractual.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="gestion-documental" tabindex="-1" aria-labelledby="gestion-documental"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #FFFDC4;">folder_managed</i>

                            <div>
                                <h2>Gestión Documental</h2>
                                <p>Gestión</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            Organiza, encuentra y comparte tus documentos de manera eficiente con nuestra avanzada
                            aplicación de
                            gestión documental. Desde la carga y categorización de archivos hasta la colaboración en tiempo
                            real
                            y el acceso desde cualquier lugar, nuestra plataforma te ofrece las herramientas necesarias para
                            mantener tus documentos ordenados y accesibles en todo momento.
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Con características como búsqueda avanzada, control de versiones y seguridad de nivel
                            empresarial,
                            estamos aquí para simplificar y fortalecer tu flujo de trabajo documental. ¡Descarga ahora y
                            lleva
                            el control de tus documentos al siguiente nivel!"
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-apps" id="gestion-talento" tabindex="-1" aria-labelledby="gestion-talento"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <div class="d-flex align-items-center">
                            <i class="material-symbols-outlined icon-background icon-lg"
                                style="background-color: #FFD3BF;">id_card</i>

                            <div>
                                <h2>Gestión de Talento</h2>
                                <p>Gestión</p>
                                <a href="" class="btn btn-primary">Abrir</a>
                            </div>
                            <div class="box-apps-stars ml-5">
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>
                                <i class="material-symbols-outlined">kid_star</i>

                                <span class="ml-2">
                                    5
                                    (055)
                                    Califica tu aplicación
                                </span>
                            </div>
                        </div>

                        <div class="mt-5">
                            <span class="link">Descricpión</span>
                        </div>

                        <h5 class="mt-5">Introducción</h5>
                        <p>
                            Descubre, desarrolla y retiene el talento de tu equipo con nuestra completa aplicación de
                            gestión de
                            talento. Desde la identificación y reclutamiento de talentos hasta la planificación de carreras
                            y la
                            evaluación del desempeño, nuestra plataforma te proporciona las herramientas necesarias para
                            impulsar el crecimiento de tu empresa. Con características como análisis de competencias,
                            evaluaciones 360 grados y planes de desarrollo personalizados, estamos aquí para ayudarte a
                            construir un equipo excepcional. ¡Descarga ahora y desbloquea el potencial de tu talento humano!
                        </p>
                        <hr>

                        <h5 class="mt-4">Características</h5>
                        <p>
                            Nuestra aplicación destaca por ofrecer características como reclutamiento y selección de
                            talento,
                            evaluación del desempeño, gestión del desarrollo y capacitación, planificación de sucesiones,
                            análisis de competencias, herramientas de retroalimentación y seguimiento del progreso,
                            proporcionando a los usuarios las herramientas necesarias para identificar, desarrollar y
                            retener el
                            talento dentro de la organización, promoviendo el crecimiento y el éxito a largo plazo.
                        </p>
                        <hr>

                        <h5 class="mt-5">Reseñas</h5>
                        <div class="blue-box-estadisticas d-flex align-items-center justify-content-center gap-5"
                            style="padding: 100px 0px;">
                            <div style="font-size: 20px">
                                <strong style="font-size: 28px">5</strong>/5
                                (055 calificaiones)
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>5 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>4 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>3 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>2 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <span>1 estrellas</span>
                                    <div class="progress" style="height: 20px; width: 200px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span>80%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    @endsection
