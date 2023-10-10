

   <style>


    .timeline {
        list-style-type: none;
        margin: 0;
        padding: 0;
        position: relative
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 5px;
        bottom: 5px;
        width: 5px;
        background: #2d353c;
        left: 20%;
        margin-left: -2.5px
    }

    .timeline>li {
        position: relative;
        min-height: 50px;
        padding: 20px 0
    }

    .timeline .timeline-time {
        position: absolute;
        left: 0;
        width: 18%;
        text-align: right;
        top: 30px
    }

    .timeline .timeline-time .date,
    .timeline .timeline-time .time {
        display: block;
        font-weight: 600
    }

    .timeline .timeline-time .date {
        line-height: 16px;
        font-size: 12px
    }

    .timeline .timeline-time .time {
        line-height: 24px;
        font-size: 20px;
        color: #242a30
    }

    .timeline .timeline-icon {
        left: 15%;
        position: absolute;
        width: 10%;
        text-align: center;
        top: 40px
    }

    .timeline .timeline-icon a {
        text-decoration: none;
        width: 20px;
        height: 20px;
        display: inline-block;
        border-radius: 20px;
        background: #d9e0e7;
        line-height: 10px;
        color: #fff;
        font-size: 14px;
        border: 5px solid #2d353c;
        transition: border-color .2s linear
    }

    .timeline .timeline-body {
        margin-left: 23%;
        margin-right: 17%;
        background: #fff;
        position: relative;
        padding: 20px 25px;
        border-radius: 6px
    }

    .timeline .timeline-body:before {
        content: '';
        display: block;
        position: absolute;
        border: 10px solid transparent;
        border-right-color: #fff;
        left: -20px;
        top: 20px
    }

    .timeline .timeline-body>div+div {
        margin-top: 15px
    }

    .timeline .timeline-body>div+div:last-child {
        margin-bottom: -20px;
        padding-bottom: 20px;
        border-radius: 0 0 6px 6px
    }

    .timeline-header {
        padding-bottom: 10px;
        border-bottom: 1px solid #e2e7eb;
        line-height: 30px
    }

    .timeline-header .userimage {
        float: inherit;
        /* width: 34px; */
        height: 34px;
        border-radius: 40px;
        overflow: hidden;
        margin: -2px 10px -2px 0
    }

    .timeline-header .username {
        font-size: 16px;
        font-weight: 600
    }

    .timeline-header .username,
    .timeline-header .username a {
        color: #2d353c
    }

    .timeline img {
        max-width: 100%;
        display: block
    }

    .timeline-content {
        letter-spacing: .25px;
        line-height: 18px;
        font-size: 13px
    }

    .timeline-content:after,
    .timeline-content:before {
        content: '';
        display: table;
        clear: both
    }

    .timeline-title {
        margin-top: 0
    }

    .timeline-footer {
        background: #fff;
        border-top: 1px solid #e2e7ec;
        padding-top: 15px
    }

    .timeline-footer a:not(.btn) {
        color: #575d63
    }

    .timeline-footer a:not(.btn):focus,
    .timeline-footer a:not(.btn):hover {
        color: #2d353c
    }

    .timeline-likes {
        color: #6d767f;
        font-weight: 600;
        font-size: 12px
    }

    .timeline-likes .stats-right {
        float: right
    }

    .timeline-likes .stats-total {
        display: inline-block;
        line-height: 20px
    }

    .timeline-likes .stats-icon {
        float: left;
        margin-right: 5px;
        font-size: 9px
    }

    .timeline-likes .stats-icon+.stats-icon {
        margin-left: -2px
    }

    .timeline-likes .stats-text {
        line-height: 20px
    }

    .timeline-likes .stats-text+.stats-text {
        margin-left: 15px
    }

    .timeline-comment-box {
        background: #f2f3f4;
        margin-left: -25px;
        margin-right: -25px;
        padding: 20px 25px
    }

    .timeline-comment-box .user {
        float: left;
        width: 34px;
        height: 34px;
        overflow: hidden;
        border-radius: 30px
    }

    .timeline-comment-box .user img {
        max-width: 100%;
        max-height: 100%
    }

    .timeline-comment-box .user+.input {
        margin-left: 44px
    }

    .lead {
        margin-bottom: 20px;
        font-size: 21px;
        font-weight: 300;
        line-height: 1.4;
    }

    .text-danger,
    .text-red {
        color: #ff5b57 !important;
    }

</style>
<div class="mt-5 card">
    <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2 text-center text-white"><strong>Historial de versiones del documento:
                {{ $documento->nombre }}</strong></h3>
    </div>
    <div class="container">
        <ul class="timeline">
            @foreach ($versiones as $version)
                <li>
                    <!-- begin timeline-time -->
                    <div class="timeline-time">
                        <span class="time">Versión {{ $version->version }}</span>
                        <span class="date">{{ $version->day_localized }}</span>
                    </div>
                    <!-- end timeline-time -->
                    <!-- begin timeline-icon -->
                    <div class="timeline-icon">
                        <a href="javascript:;">&nbsp;</a>
                    </div>
                    <!-- end timeline-icon -->
                    <!-- begin timeline-body -->
                    <div class="timeline-body">
                        <div class="timeline-header">
                            <p>
                                <strong><i class="fas fa-file-pdf"></i> {{ $version->codigo }} -
                                    {{ $version->nombre }}
                                </strong>
                            </p>
                            <div class="row">
                                <div class="text-center col-sm-3 col-lg-3 d-flex flex-column">
                                    <span class="userimage d-flex justify-content-center"><img class="rounded-circle"
                                            src="{{ asset('storage/empleados/imagenes/')}}/{{$version->elaborador ? $version->elaborador->avatar : 'user.png' }}"
                                            title="{{ $version->revisor ? $version->revisor->name : 'Sin registro' }}" alt=""></span>
                                    <span class="username">
                                        <small></small>Elaborador</span>
                                </div>
                                <div class="text-center col-sm-3 col-lg-3 d-flex flex-column justify-content-center">
                                    <span class="userimage d-flex justify-content-center"><img class="rounded-circle"
                                            src="{{ asset('storage/empleados/imagenes/')}}/{{$version->revisor ? $version->revisor->avatar: 'user.png' }}"
                                            title="{{ $version->revisor ? $version->revisor->name : 'Sin registro' }}" alt=""></span>
                                    <span class="username">
                                        <small></small>Revisor</span>
                                </div>
                                <div class="text-center col-sm-3 col-lg-3 d-flex flex-column justify-content-center">
                                    <span class="userimage d-flex justify-content-center"><img class="rounded-circle"
                                            src="{{ asset('storage/empleados/imagenes/')}}{{ $version->aprobador ? $version->aprobador->avatar: 'user.png' }}"
                                            title="{{ $version->revisor ? $version->revisor->name : 'Sin registro' }}" alt=""></span>
                                    <span class="username">
                                        <small></small>Aprobador</span>
                                </div>
                                <div class="text-center col-sm-3 col-lg-3 d-flex flex-column justify-content-center">
                                    <span class="userimage d-flex justify-content-center"><img class="rounded-circle"
                                            src="{{ asset('storage/empleados/imagenes/')}} {{$version->responsable ? $version->responsable->avatar: 'user.png' }}"
                                            title="{{ $version->revisor ? $version->revisor->name : 'Sin registro' }}" alt=""></span>
                                    <span class="username">
                                        <small></small>Responsable</span>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-content">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chat-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    <path
                                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                </svg>
                                Descripción del cambio
                                @foreach ($version->cambios as $idx => $cambio)
                                    <blockquote>
                                        {{ $cambio->descripcion }}
                                        <p><i class="fas fa-calendar-day"></i> {{ $cambio->fecha_dmy }}</p>
                                    </blockquote>
                                @endforeach
                            </p>
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chat-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    <path
                                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                </svg>
                                Comentarios adicionales
                                @foreach ($version->cambios as $comentario)
                                    @if ($comentario->comentarios)
                                        <blockquote>
                                            {{ $comentario->comentarios }}
                                            <p><i class="fas fa-calendar-day"></i> {{ $comentario->fecha_dmy }}</p>
                                        </blockquote>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <iframe src="{{ asset($version->path_document) }}" frameborder="0"
                            style="height: 251px; width: 100%"></iframe>
                    </div>
                    <!-- end timeline-body -->
                </li>
            @endforeach
        </ul>
    </div>
</div>
