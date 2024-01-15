@section('styles')
    <style>
        .menu-slider {
            width: 900px;
            color: #306BA9;
            margin: 30px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-menu-ar {
            border: none;
            outline: none;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90px;
            color: #698eb3;
            background-color: rgba(0, 0, 0, 0);
        }

        .caja-items-menu-slider {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 50px;
            padding: 20px 0px;

            overflow: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .item-ms {
            scroll-snap-align: center;
            min-width: 68px;
            height: 68px;
        }

        .item-ms a {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 10px;
            color: #306BA9;
            text-decoration: none !important;
            padding-top: 6px;
        }

        /* .item-ms:first-child {
                                                        margin-left: 160px;
                                                    }

                                                    .item-ms:last-child {
                                                        margin-right: 160px;
                                                    } */

        .item-ms span {
            font-size: 10px;
        }

        .item-ms i {
            font-size: 55px;
            margin-top: 7px;
        }

        .item-ms.active {
            transform: scale(1.25);
            border-radius: 16px;
            background-color: #b3d3f3;
        }

        .caja-items-menu-slider::-webkit-scrollbar {
            width: 0px;
            height: 0px;
        }
    </style>
@endsection
<div class="menu-slider">
    <button class="btn-menu-ar" onclick="menuSileder('retreat');">
        <i class="material-symbols-outlined">arrow_back_ios</i>
    </button>
    <div class="caja-items-menu-slider">
        <div class="item-ms
            ">

            <a href="{{ route('admin.documentos.index') }}">
                <i class="material-symbols-outlined">description</i>
                <span>Documentos</span>
            </a>
        </div>
        <div class="item-ms">
            <a href="{{ asset('/admin/mis-cursos') }}">
                <i class="material-symbols-outlined">school</i>
                <span>Capacitaciones</span>
            </a>
        </div>
        <div class="item-ms">
            <a href="{{ route('admin.solicitud') }}">
                <i class="material-symbols-outlined">assignment_turned_in</i>
                <span>Solicitudes</span>
            </a>
        </div>
        <div class="item-ms active">
            <a href="{{ route('admin.portal-comunicacion.index') }}">
                <i class="material-symbols-outlined">home</i>
                <span>Inicio</span>
            </a>
        </div>
        <div class="item-ms">
            <a href="{{ route('admin.inicio-Usuario.index') }}">
                <i class="material-symbols-outlined">account_circle</i>
                <span>Perfil</span>
            </a>
        </div>
        <div class="item-ms">
            <a href="{{ route('admin.timesheet-inicio') }}">
                <i class="material-symbols-outlined">date_range</i>
                <span>Timesheet</span>
            </a>
        </div>
        <div class="item-ms">
            <a href="{{ route('admin.systemCalendar') }}">
                <i class="material-symbols-outlined">calendar_today</i>
                <span>Calendario</span>
            </a>
        </div>

        <div class="item-ms">
            <a href="{{ asset('contract_manager/requisiciones') }}">
                <i class="material-symbols-outlined">contract</i>
                <span>Requisiciones </span>
            </a>
        </div>
    </div>
    <button class="btn-menu-ar" onclick="menuSileder('advance');">
        <i class="material-symbols-outlined">arrow_forward_ios</i>
    </button>
</div>
<script>
    function menuSileder(tipo) {
        if (tipo == 'advance') {
            document.querySelector('.menu-slider .caja-items-menu-slider').scrollLeft += 100;
        }
        if (tipo == 'retreat') {
            document.querySelector('.menu-slider .caja-items-menu-slider').scrollLeft -= 100;
        }
    }
</script>
