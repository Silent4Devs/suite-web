<style>
    .caja_img_perfil{
        overflow: hidden !important;
        position: relative;
    }
    .caja_img_perfil img{
        position: absolute;
        height: 100%;
    }
</style>


    <div class="row">

        <div class="form-group col-sm-3">
            <label>
                Código:</label>
            <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
            {{$documento->codigo}}
            </div>

        </div>

        <div class="form-group col-sm-6">
            <label>
                Nombre del Documento:</label>
                <div class="pt-2 pl-2 card vista-scroll" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                    {{$documento->nombre}}
                </div>

        </div>


        <div class="form-group col-sm-3">
            <label >
                Tipo:</label>
                <div class="pt-2 pl-2 text-center card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                    Proceso
                </div>

        </div>

    </div>

    <div class="row">

        <div class="form-group col-sm-3">
            <label class="required" for="codigo">
                Estatus:</label>

                <div class="pt-2 pl-2 text-center card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                    {{$documento->estatus_formateado}}
                </div>

        </div>


        <div class="form-group col-sm-4">

            <label>
                Macroproceso:</label>
                <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                    {{$documento->macroproceso->nombre}}
                </div>

        </div>

        <div class="form-group col-sm-2">

            <label>
                Versión:</label>
                <div class="pt-2 pl-2 card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                    {{$documento->version}}
                </div>

        </div>


        <div class="form-group col-sm-3">
            <label>
                Fecha:</label>

                    <div class="card" style="height:35px; box-shadow: 0px 0px 0px 1px rgba(77, 72, 77, 0.133)">
                        <div class="row">
                            <div class="pt-2 pl-4 col-sm-8">
                                {{\Carbon\Carbon::parse($documento->fecha)->format("d-m-Y")}}
                            </div>
                            <div class="ml-1 col-sm-3" style="width:30px; height:35px; background:#345183" >
                                <i class="pt-2 pl-2 fas fa-calendar-alt" style="font-size:18px; color:#fff;"></i>
                            </div>

                        </div>



                     </div>


        </div>



    </div>

    <div class="row">

        <div class="form-group col sm-3">
           <label>Elaboró</label>
        </div>

        <div class="form-group col sm-3">
            <label>Revisó</label>
        </div>
        <div class="form-group col sm-3">
            <label>Aprobó</label>
        </div>
        <div class="form-group col sm-3">
            <label>Responsable</label>
        </div>
    </div>

    <div class="mb-3 row">

        <div class="col-lg-3 info-personal">
            <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                <div style="width: 100%; height: 85px; background-color: #345183;"></div>
                <div class="caja_img_perfil">
                    <img src="{{  asset('storage/empleados/imagenes') }}/{{ $documento->elaborador ? $documento->elaborador->avatar : 'user.png'}}">
                </div>
                <h6><strong style="color:#345183; font-size:12pt;">{{$documento->elaborador ? $documento->elaborador->name:'Sin registro'}}</strong></h6>
                <p >{{$documento->elaborador ? $documento->elaborador->puesto:'Sin registro'}}</p>

            </div>

        </div>


        <div class="col-lg-3 info-personal">
            <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                <div style="width: 100%; height: 85px; background-color: #345183;"></div>
                <div class="caja_img_perfil">
                    <img src="{{  asset('storage/empleados/imagenes') }}/{{ $documento->revisor ? $documento->revisor->avatar : 'user.png'}}">
                </div>
                <h6><strong style="color:#345183; font-size:12pt;">{{$documento->revisor ? $documento->revisor->name: 'Sin registro'}}</strong></h6>
                <p>{{$documento->revisor ? $documento->revisor->puesto : 'Sin registro'}}</p>

            </div>

        </div>


        <div class="col-lg-3 info-personal">
            <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                <div style="width: 100%; height: 85px; background-color: #345183;"></div>
                <div class="caja_img_perfil">
                    <img src="{{  asset('storage/empleados/imagenes') }}/{{ $documento->aprobador ? $documento->aprobador->avatar : 'user.png'}}">
                </div>
                <h6><strong style="color:#345183;font-size:12pt;"  >{{$documento->aprobador ? $documento->aprobador->name : 'Sin registro'}}</strong></h6>
                <p>{{$documento->aprobador ? $documento->aprobador->puesto : 'Sin registro'}}</p>

            </div>

        </div>


        <div class="col-lg-3 info-personal">
            <div class="text-center" style="border:1px solid #ccc; border-radius:5px;">
                <div style="width: 100%; height: 85px; background-color: #345183;"></div>
                <div class="caja_img_perfil">
                    <img src="{{  asset('storage/empleados/imagenes') }}/{{ $documento->responsable ? $documento->responsable->avatar : 'user.png'}}">
                </div>
                <h6><strong style="color:#345183; font-size:12pt;"  >{{$documento->responsable ? $documento->responsable->name : 'Sin registro'}}</strong></h6>
                <p>{{$documento->responsable ? $documento->responsable->puesto : 'Sin registro'}}</p>

            </div>

        </div>




    </div>




