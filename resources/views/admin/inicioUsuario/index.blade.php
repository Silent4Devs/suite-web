@extends('layouts.admin')
@section('content')

    <style type="text/css">
        body{
            background-color: #fff;
        }
        .info-personal .caja_img_perfil{
            border-radius: 100px;
            height: 100px;
            width: 100px;
            box-shadow: 0px 1px 4px 1px rgba(0,0,0,0.4);
            margin: auto;
            margin-top: -50px;
            margin-bottom: 20px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .info-personal img{
            height: 100px;
            clip-path: circle(50px at 50% 50%);
        }
        .info-personal .cards{
            border:1px solid #ccc; 
            border-radius:5px;
            padding: 10px;
            margin-top: 8px;
        }
        #inicio_usuario .caja_botones{
            height: 40px;
        }
        #inicio_usuario .caja_botones a{
            width: 135px;
            text-decoration: none;
            display: inline-block;
            color: #008186;
            padding: 5px 0px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f3f3f3;
            margin: 0;
            text-align: center;
        }
        #inicio_usuario .caja_botones a:first-child{
            border-left: 1px solid #ccc;
        }
        #inicio_usuario .caja_botones a:not(#inicio_usuario .caja_botones a.btn_activo){
            border-bottom: 1px solid #ccc;
        }
        #inicio_usuario .caja_botones a i{
            margin-right: 7px;
            font-size: 15pt;
        }
        #inicio_usuario .caja_botones a.btn_activo{
            border-top: 2px solid #00abb2 !important;
            background-color: #fff;
        }
        #inicio_usuario .caja_botones a:hover{
            border-top: 2px solid #00abb2 !important;
        }

        #inicio_usuario .caja_caja_secciones{
            width: 100%;
            overflow: hidden;
            scroll-behavior: smooth;
        }
        #inicio_usuario .caja_secciones{
            width: 500%;
            display: flex;
        }
        #inicio_usuario section{
            width: 20% !important;
        }
        #inicio_usuario section:target{
            padding-top: 200px;
            margin-top: -200px;
        }
        #inicio_usuario section:not(#inicio_usuario section:target){
            height: 100px;
        }



        .caja{
            margin-top: -30px;
        }




        table td i{
        font-size: 17pt;
        cursor: pointer;
        margin: 3px;
        color: #00abb2;
    }
        table td i:hover{
            opacity: 0.8;
        }
        td.opciones_iconos{
            text-align: center;
            vertical-align: middle;
        }


        .dataTables_filter{
            overflow: hidden;
        }
    </style>



    
    <div id="inicio_usuario" class="row" style="">
        <div class="col-lg-3 info-personal">
            <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                <div style="width: 100%; height: 85px; background-color: #00abb2;"></div>
                <div class="caja_img_perfil">
                    <img src="{{  asset('storage/empleados/imagenes') }}/{{ $usuario->empleado ? $usuario->empleado->foto : 'user.png'}}">
                </div>
                <h5>{{ $usuario->empleado ? $usuario->empleado->name : $usuario->name}}</h5>
                <p>{{ $usuario->empleado ? $usuario->empleado->puesto != null ? $usuario->puesto : 'Puesto no asignado' : ''}}</p>
               
            </div>
            <h4 class="mt-3">Avisos de publicaiones </h4>
            <div class="cards">
                Publicaciones
            </div>
            <div class="cards">
                Publicaciones
            </div>
        </div>
        
        
        <div class="col-lg-9 row caja_botones_secciones">
        @if($usuario->empleado)
            <div class="col-12 caja_botones">
                <a href="#calendario" class="btn_activo"><i class="fas fa-calendar-alt"></i> Calendario</a>
                <a href="#actividades"><i class="fas fa-stopwatch"></i>Actividades</a>
                <a href="#aprobaciones"><i class="fas fa-check"></i>Aprobaciones</a>
                <a href="#capacitaciones"><i class="fas fa-chalkboard-teacher"></i>Capacitaciones</a>
                <a href="#reportes"><i class="fas fa-clipboard-list"></i>Reportes</a>
            </div>
        @endif

            <div class="caja_caja_secciones">
            @if($usuario->empleado)
                <div class="caja_secciones">
                    <section id="calendario">
                        @include('admin.inicioUsuario.calendario')
                    </section>
                    <section id="actividades">
                       @include('admin.inicioUsuario.actividades')
                    </section>
                    <section id="aprobaciones">
                        @include('admin.inicioUsuario.aprobaciones')
                    </section>
                    <section id="capacitaciones">
                        @include('admin.inicioUsuario.capacitaciones')
                    </section>
                    <section id="reportes"> 
                        @include('admin.inicioUsuario.reportes')
                    </section>
                </div>
            @else
                @include('admin.inicioUsuario.agenda')
            @endif
            </div>
            
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(".caja_botones a").click(function(){
            $(".caja_botones a").removeClass("btn_activo");
            $(".caja_botones a:hover").addClass("btn_activo");
        });
    </script>
@endsection
