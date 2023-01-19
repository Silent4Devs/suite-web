<div class="caja_botones_menu">
    <a href="#" id="contexto" data-tabs="s1" class="btn_activo tabs ventana_cerrar"><i
            class="fa-fw fas fa-archive"></i><br> Contexto </a>
    <a href="#" id="liderazgo" data-tabs="s2" class="tabs ventana_cerrar"><i class="fa-fw fas fa-gavel"></i><br>
        Liderazgo </a>
    <a href="#" id="planificacion" data-tabs="s3" class="tabs ventana_cerrar"><i class="fa-fw fas fa-tasks"></i><br>
        Planificación </a>
    <a href="#" id="soporte" data-tabs="s4" class="tabs ventana_cerrar"><i class="fa-fw fas fa-headset"></i><br>
        Soporte</a>
    <a href="#" id="operacion" data-tabs="s5" class="tabs ventana_cerrar"><i class="fa-fw fas fa-briefcase"></i><br>
        Operación </a>
    <a href="#" id="evaluacion" data-tabs="s6" class="tabs ventana_cerrar"><i
            class="fa-fw fas fa-file-signature"></i><br> Evaluación</a>
    <a href="#" id="mejora" data-tabs="s7" class="tabs ventana_cerrar"><i class="fa-fw fas fa-infinity"></i><br>
        Mejora</a>
    {{-- <a href="#" id="controles" data-tabs="s8" class="tabs ventana_cerrar"><i class="fas fa-tasks"></i><br>Controles </a> --}}
</div>

<div class="caja_caja_secciones">
    <div class="caja_secciones">

        <section data-id="contexto" id="s1" class="caja_tab_reveldada caja">
            <div class="mt-5">
            </div>
        </section>


        <section id="s2" data-id="liderazgo" class="caja">
            <div class="mt-5">

            </div>
        </section>


        <section id="s3" data-id="planificacion" class="caja">
            <div class="mt-5">

            </div>
        </section>


        <section id="s4" data-id="soporte" class="caja">
            <div class="mt-5">

            </div>
        </section>


        <section id="s5" data-id="operacion" class="caja">
            <div class="mt-5">

            </div>
        </section>


        <section id="s6" data-id="evaluacion" class="caja">
            <div class="mt-5">

            </div>
        </section>


        <section id="s7" data-id="mejora" class="caja">
            <div class="mt-5">

            </div>
        </section>

        {{-- <section id="s8" data-id="controles" class="caja">
                        <div class="mt-5">
                            <ul>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-balance-scale"></i>
                                            A5 Política de SI
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-mobile-alt"></i>
                                            A6 Organización de la SI
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-user"></i>
                                            A7 Seguridad de los Recursos
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-laptop"></i>
                                            A8 Gestion de Activos
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-door-open"></i>
                                            A9 Control de Acceso
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-key"></i>
                                            A10 Criptografia
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-hard-hat"></i>
                                            A11 Seguridad Fisica y del Entorno
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-file-signature"></i></i>
                                            A12 Seguridad de las Operaciones
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-wifi"></i>
                                            A13 Seguridad en las Comunicaciones
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-file-code"></i>
                                            A14 Sistemas de Información
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-handshake"></i>
                                            A15 Relacion con Proveedores
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-exclamation-triangle"></i>
                                            A16 Gestion de Incidentes de SI
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-life-ring"></i>
                                            A17 Continuidad del Negocio
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div>
                                            <i class="fas fa-check-square"></i>
                                            A18 Cumplimiento
                                        </div>
                                    </a></li>
                            </ul>
                        </div>
                    </section> --}}
    </div>
</div>
<script type="text/javascript">
    $(".caja_botones_menu a").click(function() {
        $(".caja_botones_menu a").removeClass("btn_activo");
        $(".caja_botones_menu a:hover").addClass("btn_activo");
    });
</script>


<script type="text/javascript">
    $(".caja_botones_menu a").click(function() {
        $("section").removeClass("caja_tab_reveldada");
        var id_seccion = $(".caja_botones_menu a:hover").attr('data-tabs');
        $(document.getElementById(id_seccion)).addClass("caja_tab_reveldada");
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tabs = document.querySelectorAll('.tabs');
        tabs.forEach(tab => {
            if (tab.classList.contains('btn_activo')) {
                tab.classList.remove('btn_activo')
            }
        });
        let cajas = document.querySelectorAll('.caja');
        cajas.forEach(caja => {
            if (caja.classList.contains('caja_tab_reveldada')) {
                caja.classList.remove('caja_tab_reveldada')
            }
        });

        let idActual = window.location.hash.replace('#', '');
        document.getElementById(idActual).classList.add('btn_activo');
        document.querySelector(`[data-id="${idActual}"]`).classList.add('caja_tab_reveldada');
        setTimeout(() => {
            window.scrollTo(0, 0);
            console.log('scroll')
        }, 1);
    })
</script>
