<div class="row">
    @forelse($documentos_relacionados as $documento_relacionado)

        <div class="col-4 justify-content-center" style="border">
            <div class="card justify-content-center">
                <div class="text-center card-header">
                    <i class="fas fa-file-pdf" style="font-size:50pt; color:red"></i>

                </div>

                <div class="card-body">

                    <a href="{{ route('admin.documentos.renderViewDocument', $documento_relacionado) }}" target="_blank">
                        <p><strong class="text-center" style="font-size:13pt;"> {{ $documento_relacionado->codigo }} -
                                {{ $documento_relacionado->nombre }} </strong></p>
                    </a>

                    <p><strong>Tipo:</strong><span style="text-transform:capitalize"> {{ $documento_relacionado->tipo }}
                        </span></p>

                    <p><strong>Versión:</strong> {{ $documento_relacionado->version }}</p>

                    <p><strong>Estatus:</strong> {{ $documento_relacionado->estatus_formateado }}</p>

                    <div class="text-center row">
                        <div class="col-sm-6 col-lg-6">
                            <img class="rounded-circle" title="{{ $documento_relacionado->elaborador ? $documento_relacionado->elaborador->name : 'Sin registro' }}"
                                src="{{ asset('storage/empleados/imagenes')}}/{{ $documento_relacionado->elaborador ?  $documento_relacionado->elaborador->avatar : 'user.png' }}"
                                style="width:35px;">
                            <p style="font-size:12px">Elaboró</p>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <img class="rounded-circle" title="{{ $documento_relacionado->revisor ?  $documento_relacionado->revisor->name : 'Sin registro'}}"
                                src="{{ asset('storage/empleados/imagenes')}} {{$documento_relacionado->revisor ? $documento_relacionado->revisor->avatar : 'user.png' }}"
                                style="width:35px;">
                            <p style="font-size:12px">Revisó</p>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <img class="rounded-circle" title="{{ $documento_relacionado->aprobador ? $documento_relacionado->aprobador->name : 'Sin registro' }}"
                                src="{{ asset('storage/empleados/imagenes')}}/{{$documento_relacionado->aprobador ? $documento_relacionado->aprobador->avatar : 'user.png'}}"
                                style="width:35px;">
                            <p style="font-size:12px">Aprobó</p>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <img class="rounded-circle" title="{{ $documento_relacionado->responsable ? $documento_relacionado->responsable->name : 'Sin registro'}}"
                                src="{{ asset('storage/empleados/imagenes')}} {{$documento_relacionado->responsable ? $documento_relacionado->responsable->avatar : 'user.png' }}"
                                style="width:35px;">
                            <p style="font-size:12px">Responsable</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    @empty
        {{-- <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">

                            <div class="row w-100">
                                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                    <div class="w-100">
                                        <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                    </div>
                                </div>
                                <div class="col-11">
                                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado Sedes a la
                                        organización
                                        <a href="{{ route('admin.sedes.create') }}" class="item-right col-2 btn text-light" style="background-color:rgb(85, 217, 226); float:right">Agregar</a>

                                    </p>
                                </div>
                            </div>

                        </div> --}}

            <div style="width:100%; display:flex; justify-content:center !important; align-item:center">

                    <img src="{{ asset('img/add-document.png') }}" alt="No se pudo cargar el documentos relacionados"
                     class="mt-3" style="height: 390px;">

            </div>





    @endforelse
</div>
