<div class="menu-pasarela scroll_estilo">
    <ul>
        <li> <strong> Aplicaciones </strong> </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.inicio') }}">
                <i class="material-symbols-outlined">apps</i>
                Todas las aplicaciones
            </a>
        </li>
        {{-- <li>
            <i class="material-symbols-outlined">install_desktop</i>
            Actualizaciones
        </li> --}}
    </ul>

    <ul class="mt-5">
        <li> <strong> Planes </strong> </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.planes-precios') }}">
                <i class="material-symbols-outlined">credit_card</i>
                Planes y Precios
            </a>
        </li>
    </ul>

    <ul class="mt-5">
        <li> <strong> Aplicaciones </strong> </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.capacitaciones') }}">
                <i class="material-symbols-outlined">school</i>
                Capacitación
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.gestion-normativa') }}">
                <i class="material-symbols-outlined">language</i>
                Gestión Normativa
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.planes-trabajo') }}">
                <i class="material-symbols-outlined">quick_reference</i>
                Planes de trabajo
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.gestion-documental') }}">
                <i class="material-symbols-outlined">folder_managed</i>
                Gestor Documental
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.gestion-talento') }}">
                <i class="material-symbols-outlined">install_desktop</i>
                Gestión de Talento
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.gestion-contractual') }}">
                <i class="material-symbols-outlined">quick_reference</i>
                Gestión Contractual
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.gestion-riesgos') }}">
                <i class="material-symbols-outlined">gpp_maybe</i>
                Gestión de Riesgos
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pasarela-pago.apps.visitantes') }}">
                <i class="material-symbols-outlined">groups</i>
                Visitantes
            </a>
        </li>
    </ul>
</div>
