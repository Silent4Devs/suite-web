<div class="create-requisicion">
    <div class="card card-body caja-blue">

        <div>
            <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width:150px; position: relative; top: 100px; right: 430px;">
        </div>

        <div style="position: relative; top:-5rem; left: 80px;">
            <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido </h3>
            <h5 style="font-size: 17px; margin-top:10px;">En esta sección puedes generar tu requisición</h5>
            <p style="margin-top:10px;">
                Aquí podrás crear, revisar y procesar solicitudes de compra de manera rápida y sencilla, <br> optimizando el
                flujo de trabajo y asegurando un seguimiento transparente de todas las transacciones.
            </p>
        </div>
    </div>



    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item"  role="presentation">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="number-icon active-number">1</i> Servicios y Productos</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link"  id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="number-icon">2</i> Proveedores</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="number-icon">3</i> Firma</a>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab" >
            <div id="home" class="tab-content" >
                <form method="POST" wire:submit.prevent="servicioStore(Object.fromEntries(new FormData($event.target)))" enctype="multipart/form-data">
                    <div class="card card-body">
                        <h3 class="titulo-form">Solicitud de requisición</h3>
                        <hr style="margin: 30px 0px;">

                        <div class="row">
                            <div class="col s12 l3">
                                <label for="" class="txt-tamaño">

                                    Fecha solicitud <font class="asterisco">*</font>
                                </label>
                                <input id="fecha-solicitud-input" class="browser-default" type="date" name="fecha"
                                    required>
                            </div>
                            <div class="col s12 l3">
                                <label for="" class="txt-tamaño">

                                    Razón Social <font class="asterisco">*</font>
                                </label>
                                <select required class="browser-default" name="sucursal_id">
                                    <option value="" selected disabled></option>
                                    @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id }}">{{ $sucursal->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col s12 l3">
                                <label for="" class="txt-tamaño">

                                    Solicita <font class="asterisco">*</font>
                                </label>
                                <input id="user_print" name="user" value="{{ Auth::user()->name }}" readonly
                                    style="background: #eaf0f1" class="browser-default" type="text">
                            </div>
                            <div class="col s12 l3">
                                <label for="" class="txt-tamaño">

                                    Área que solicita <font class="asterisco">*</font>
                                </label>
                                <input id="area_print" name="area"
                                    value="@isset($this->user_actual->empleado->area->area) {{ $this->user_actual->empleado->area->area }} @endisset"
                                    readonly style="background: #eaf0f1" class="browser-default" type="text">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 l6">
                                <label for="" class="txt-tamaño">

                                    Referencia (Título de la requisición) <font class="asterisco">*</font>
                                </label>
                                <input class="browser-default" type="text" value="" name="descripcion" required>
                            </div>

                            <div class="col s12 l3">
                                <label for="" class="txt-tamaño">

                                    Comprador <font class="asterisco">*</font>
                                </label>
                                <select required class="browser-default" name="comprador_id">
                                    <option value="" selected disabled></option>
                                    @foreach ($compradores as $comprador)
                                        <option value="{{ $comprador->id }}">
                                            @isset($comprador->user->name)
                                                {{ $comprador->user->name }}
                                            @endisset
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col s12 l3">
                                <label for="tipo_contrato" class="txt-tamaño">Proyecto<font class="asterisco">*</font></label>
                                 <select  required class="browser-default  select_contratos" name="contrato_id">
                                    <option value="" selected disabled data-no=""   data-servicio=""   data-proveedor=""></option>
                                    @foreach ($contratos as $contrato)
                                        <option value="{{$contrato->id}}"  data-no="{{ $contrato->no_proyecto}}"   data-servicio="{{  $contrato->no_contrato  }}"  data-proveedor="{{$contrato->nombre_servicio}}" >
                                            {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} - {{ $contrato->nombre_servicio }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('contrato_id'))
                                <div class="invalid-feedback red-text">
                                    {{ $errors->first('contrato_id') }}
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>

                    <div class="caja-card-product caja-cards-inner" >
                        <div id="product-serv-1" class="card card-body card-inner card-product" data-count="1">
                            <div class="col s12">
                                <div class="flex" style="justify-content: space-between">
                                    <h3 class="sub-titulo-form">Captura del producto o servicio</h3>
                                    <i class="fa-regular fa-trash-can btn-deleted-card btn-deletd-product" title="Eliminar producto" onclick="deleteProduct()"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l4">
                                    <label for="" class="txt-tamaño">
                                        Cantidad <font class="asterisco">*</font>
                                    </label>
                                    <input type="number" name="cantidad_1" min="1"
                                        class="model-cantidad browser-default" required>
                                </div>
                                <div class="col s12 l8">
                                    <label for="" class="txt-tamaño">

                                        Producto o servicio <font class="asterisco">*</font>
                                    </label>
                                    <select class="model-producto browser-default not-select2"  name="producto_1" required>
                                        <option value="" selected disabled></option>
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l12">
                                    <label for="" class="txt-tamaño">

                                        Especificaciones del producto o servicio <font class="asterisco">*</font>
                                    </label>
                                    <textarea class="model-especificaciones browser-default" name="especificaciones_1" required></textarea>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div>
                        <div class="btn btn-add-card" onclick="addCard('servicio')"><i class="fa-regular fa-square-plus"></i>
                            AGREGAR SERVICIOS Y PRODUCTOS</div>
                    </div>

                    <div style="position: relative; top: -2rem; left: 70rem;">
                        <button class="btn btn-primary" type="submit">
                            Siguiente <i class="fa-solid fa-chevron-right icon-next"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div id="profile" class="tab-content" {{ !$habilitar_proveedores ? ' style=display:none; ' : '' }}>
                <form id="form-proveedores" wire:submit.prevent="proveedoresStore(Object.fromEntries(new FormData($event.target)))" action="POST" enctype="multipart/form-data">
                    <div class="card card-body">
                        <h3 class="titulo-form">Solicitud de requisición</h3>
                        <hr style="margin: 20px 0px;">
                        <p>
                            Provea contexto detallado de su necesidad de Adquisición, es importante mencionar si es que la
                            solicitud está ligada a algún proyecto en particular.
                            <br>
                            En caso de que no se brinde detalle suficiente que sustente la compra, es no procedera.
                        </p>
                    </div>
                    <div class="caja-card-proveedor caja-cards-inner">
                        @for($i = 0; $i <= $proveedores_count; $i++)
                            <div id="proveedor-card-{{$i}}" class="card card-body card-inner card-proveedor" data-count="{{$i}}">
                                <div class="row">
                                    <div class="col s12 ">
                                        <div class="flex" style="justify-content: space-between">
                                            <h3 class="sub-titulo-form">Captura del Proveedor</h3>
                                             {{-- <i class="fa-regular fa-trash-can btn-deleted-card btn-deletd-proveedor" title="Eliminar proveedor" onclick="deleteProveedor()"></i> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l12">
                                        <label for="" class="txt-tamaño">

                                            Proveedor <font class="asterisco">*</font>
                                        </label>
                                        <select class="model-producto browser-default not-select2" wire:model.defer='selectedInput.{{$i}}'  name="proveedor_{{$i}}" required>
                                            <option value="" >Seleccione una opción</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option  value="{{ $proveedor->id }}">{{ $proveedor->nombre }} - {{ $proveedor->rfc }}</option>
                                            @endforeach
                                            <option selected  value="otro">Otro</option>
                                        </select>
                                        <div class="row">
                                            <div class="col s12 l6">
                                                <label for="" class="txt-tamaño">

                                                    Fecha inicio*
                                                </label>
                                                <input type="date" class="browser-default modal-start" name="contacto_fecha_inicio_{{$i}}"
                                                    required>
                                            </div>
                                            <div class="col s12 l6">
                                                <label for="" class="txt-tamaño">

                                                    Fecha fin*
                                                </label>
                                                <input type="date" class="browser-default modal-end" name="contacto_fecha_fin_{{$i}}"
                                                    required>
                                            </div>
                                            </div>
                                        <div>
                                           <div>
                                            <div class="preloader-wrapper big active">
                                                <div class="spinner-layer spinner-red">
                                                    <div class="circle-clipper left">
                                                      <div class="circle"></div>
                                                    </div><div class="gap-patch">
                                                      <div class="circle"></div>
                                                    </div><div class="circle-clipper right">
                                                      <div class="circle"></div>
                                                    </div>
                                                  </div>
                                              </div></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @isset($this->selectedInput[$i])
                                    @if ($this->selectedInput[$i] == "otro")
                                    <div class="row">
                                        <div class="col s12 l12">
                                            <select class="model-producto browser-default not-select2" wire:model.defer='selectOption.{{$i}}'
                                                name="proveedor_otro{{$i}}" required>
                                                <option selected value="indistinto">Indistinto</option>
                                                <option value="sugerido">Sugerido</option>
                                            </select>
                                        </div>
                                    </div>
                                    @isset($this->selectOption[$i])
                                    @if ($this->selectOption[$i] === "sugerido")
                                    <div class="row">
                                        <div class="col s12 l6">
                                            <label for="" class="txt-tamaño">

                                                Detalles del producto <font class="asterisco">*</font>
                                            </label>
                                            <input type="text" class="browser-default modal-detalles" name="detalles_{{$i}}" required>
                                        </div>
                                        <div class="col s12 l3">
                                            <input type="radio" class="modal-tipo" name="tipo_{{$i}}" value="fisico" required>
                                            <label for="tipo_{{$i}}" class="txt-tamaño">
                                                Proveedor Físico
                                            </label>
                                        </div>
                                        <div class="col s12 l3">
                                            <input type="radio" class="modal-tipo-2" name="tipo_{{$i}}" value="online" required>
                                            <label for="" class="txt-tamaño">
                                                Proveedor Online
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l12">
                                            <label for="" class="txt-tamaño">

                                                Comentarios <font class="asterisco">*</font>
                                            </label>
                                            <textarea class="browser-default modal-comentario" name="comentarios_{{$i}}" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l12">
                                            <h3 class="sub-titulo-form">Datos de contacto</h3>
                                        </div>
                                        <div class="col s12 l6">
                                            <label for="" class="txt-tamaño">

                                                Nombre del contacto*
                                            </label>
                                            <input type="text" class="browser-default modal-nombre" name="contacto_{{$i}}" required>
                                        </div>
                                        <div class="col s12 l3">
                                            <label for="" class="txt-tamaño">

                                                Teléfono*
                                            </label>

                                            <input id="phone" type="text" name="contacto_telefono_{{$i}}" class="browser-default modal-telefono"
                                                pattern="\x2b[0-9]+" size="20" placeholder="+54976284353" required>
                                        </div>
                                        <div class="col s12 l3">
                                            <label for="" class="txt-tamaño">

                                                Correo Electrónico*
                                            </label>
                                            <input type="email" id="foo" class="browser-default modal-correo" placeholder="example@example.com"
                                                name="contacto_correo_{{$i}}" required>

                                            <h1 id="emailV"></h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l12">
                                            <label for="" class="txt-tamaño">

                                                URL*
                                            </label>
                                            <input type="url" class="browser-default modal-url" name="contacto_url_{{$i}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l12">
                                            <label for="" class="txt-tamaño">
                                                Carga de cotizaciones <font class="asterisco">*</font>
                                            </label>
                                            <input type="file" required class="modal-cotizacion form-control-file" name="cotizacion_{{$i}}"
                                                wire:model="cotizaciones.{{$i}}" data-count="{{$i}}"
                                                accept=".pdf, .docx, .pptx .point, .xml, .jpeg, .jpg, .png, .xlsx, .xlsm, .csv">
                                        </div>
                                    </div>
                                    @else
                                    @endif
                                    @endisset
                                    @endif
                                    @endisset

                            </div>
                                    @endfor
                                    </div>

                                    <div>
                                        <div class="btn btn-add-card" wire:model.defer onclick="addCard('proveedor')"><i class="fa-regular fa-square-plus icon-prior"></i>
                                            AGREGAR PROVEEDOR</div>
                                    </div>

                                    <div style="position: relative; top: -2rem; left: 70rem;">
                                        <button class="btn btn-primary"  type="submit">
                                            Siguiente <i class="fa-solid fa-chevron-right icon-next"></i>
                                        </button>
                                    </div>
                                    </form>
                                    </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        @if ($habilitar_firma)
            <div id="contact" class="tab-content">
                <div class="card card-item doc-requisicion">
                    <div class="flex header-doc">
                        <div class="flex-item item-doc-img">
                            @if ($requisicion->sucursal->mylogo)
                            <td><img src="{{ url('razon_social/'.$requisicion->sucursal->mylogo) }}"  style="width:100%; max-width:150px;" alt=""></td>
                            @else
                            <td><img src="{{ asset('sinLogo.png') }}"  style="width:100%; max-width:150px;" alt=""></td>
                            @endif
                        </div>
                        <div class="flex-item info-med-doc-header">
                            {{ $requisicion->sucursal->empresa }} <br>
                            {{ $requisicion->sucursal->rfc }} <br>
                            {{ $requisicion->sucursal->direccion }} <br>
                        </div>
                        <div class="flex-item item-header-doc-info" style="">
                            <h4 style="font-size: 18px; color:#49598A;">REQUISICIÓN DE ADQUISICIONES</h4>
                            <p>Folio: 00-00{{ $requisicion->id }}</p>
                            <p>Fecha de solicitud:{{ date('d-m-Y', strtotime($requisicion->fecha)) }} </p>
                        </div>
                    </div>
                    <div class="flex doc-blue">
                        <div class="flex-item">
                            <strong>Referencia:</strong><br>
                            {{ $requisicion->referencia }}<br><br>
                            <strong>Proyecto:</strong><br>
                            {{ $requisicion->contrato->no_proyecto }} / {{ $requisicion->contrato->no_contrato }} - {{ $requisicion->contrato->nombre_servicio }}
                        </div>
                        <div class="flex-item">
                            <strong>Área que solicita:</strong><br>
                            {{ $requisicion->area }}<br><br>
                            <strong>Comprador:</strong><br>
                            @isset($requisicion->comprador->user->name)
                                {{ $requisicion->comprador->user->name }}
                            @endisset
                        </div>
                        <div class="flex-item">
                            <strong>Solicita:</strong><br>
                            {{ $requisicion->user }}<br><br>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-item">
                            <strong> Producto o servicio:</strong>
                        </div>
                    </div>
                    @foreach ($productos_view as $producto)
                        <div class="row">
                            <div class="col s12 l4">
                                <strong> Cantidad:</strong><br><br>
                                <p>
                                    {{ $producto->cantidad }}
                                </p>
                            </div>
                            <div class="col s12 l4">
                                <strong> Producto o servicio:</strong><br><br>
                                <p>
                                    {{ $producto->producto->descripcion }}
                                </p>
                            </div>

                            <div class="col s12 l4">
                                <strong> Especificaciones del producto o servicio:</strong><br><br>
                                <p>
                                    {{ $producto->espesificaciones }}
                                </p>
                            </div>
                        </div>

                        <hr>
                    @endforeach
                    <hr style="width: 80%; margin:auto;">
                    @foreach ($proveedores_view as $proveedor)
                        <div class="proveedores-doc" style="">
                            <div class="flex header-proveedor-doc">
                                <div class="flex-item">
                                    <strong>Proveedor: </strong> {{ $proveedor->proveedor }}
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex-item">
                                    <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                                        mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                                        caso de que no se brinde detalle suficiente que sustente la compra, esto no
                                        procedera </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l4">
                                    <strong>Proveedor:</strong><br><br>
                                    {{ $proveedor->proveedor }}
                                </div>
                                <div class="col s12  l4">
                                    <strong>Detalle del producto:</strong><br><br>
                                    {{ $proveedor->detalles }}
                                </div>
                                <div class="col s12 l4">
                                    <strong>Comentarios:</strong><br><br>
                                    {{ $proveedor->comentarios }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l4">
                                    <strong>Nombre del contacto:</strong><br><br>
                                    {{ $proveedor->contacto }}
                                </div>
                                <div class="col s12 l4">
                                    <strong>Fecha Inicio:</strong><br><br>
                                    {{ date('d-m-Y', strtotime($proveedor->fecha_inicio)) }}
                                </div>
                                <div class="col s12 l4">
                                    <strong>Teléfono:</strong><br><br>
                                    {{ $proveedor->cel }}
                                </div>
                                <div class="col s12 l4">
                                    <br><br>
                                    <strong>Correo Electrónico:</strong><br><br>
                                    {{ $proveedor->contacto_correo }}
                                </div>
                                <div class="col s12 l4">
                                    <br><br>
                                    <strong>Fecha Fin:</strong><br><br>
                                    {{ date('d-m-Y', strtotime($proveedor->fecha_fin)) }}
                                </div>
                                <div class="col s12 l4">
                                    <br><br>
                                    <strong>URL:</strong><br><br>
                                    {{ $proveedor->url }}
                                </div>
                            </div>
                        </div>
                    @endforeach


                    @if ($proveedores_show)
                    @foreach ($proveedores_show as $prov)
                    <div class="proveedores-doc" style="">
                        <div class="flex header-proveedor-doc">
                            <div class="flex-item">
                                <strong>Proveedor: </strong> @isset($prov->nombre)
                                {{ $prov->nombre }}
                                @endisset
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-item">
                                <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                                    mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                                    caso de que no se brinde detalle suficiente que sustente la compra, esto no
                                    procedera </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l4">
                                <strong>Razón social:</strong><br><br>
                                @isset($prov->razon_social)
                                {{ $prov->razon_social }}
                                @endisset
                            </div>
                            <div class="col s12 l4">
                                <strong>RFC:</strong><br><br>
                                @isset($prov->rfc)
                                {{ $prov->rfc }}
                                @endisset
                            </div>
                            <div class="col s12 l4">
                                <strong>Contacto:</strong><br><br>
                                @isset($prov->contacto)
                                {{ $prov->contacto }}
                                @endisset
                            </div>

                        </div>
                        <div class="row">
                            <div class="col s12 l4">
                                <br>
                                <strong>Fecha Inicio:</strong><br><br>
                                {{ date('d-m-Y', strtotime($prov->fecha_inicio)) }}
                            </div>
                            <div class="col s12 l4">
                                <br>
                                <strong>Fecha Fin:</strong><br><br>
                                {{ date('d-m-Y', strtotime($prov->fecha_fin)) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                    @if ($this->provedores_indistinto_catalogo)
                    <div class="proveedores-doc" style="">
                        <div class="flex header-proveedor-doc">
                            <div class="flex-item">
                                <strong>Proveedor: </strong>  Indistinto
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-item">
                                <small> -Provea contexto detallado de su necesidad de adquisición, es importante
                                    mencionar si es que la solicitud está ligada a algún proyecto en particular. -En
                                    caso de que no se brinde detalle suficiente que sustente la compra, esto no
                                    procedera </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 l4">
                                <strong>Fecha Inicio:</strong><br><br>
                                {{ date('d-m-Y', strtotime($this->provedores_indistinto_catalogo->fecha_inicio))  }}
                            </div>
                            <div class="col s12 l4">
                                <strong>Fecha Fin:</strong><br><br>
                                {{ date('d-m-Y', strtotime($this->provedores_indistinto_catalogo->fecha_fin))  }}
                            </div>

                        </div>
                    </div>
                    @endif

                    <div class="caja-firmas-doc">
                        <div class="flex" style="margin-top: 70px;">
                            <div class="flex-item">
                                <hr>
                                <small> FECHA, FIRMA Y NOMBRE DEL SOLICITANTE </small>
                            </div>
                            <div class="flex-item">
                                <hr>
                                <small> FECHA, FIRMA Y NOMBRE DEL JEFE INMEDIATO</small>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-item">
                                <hr>
                                <small>FECHA, FIRMA Y NOMBRE DEL FINANZAS</small>
                            </div>
                            <div class="flex-item">
                                <hr>
                                <small>FECHA, FIRMA Y NOMBRE DEL COMPRADORES</small>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-item">
                            <small><i style="color: #2395AA;">-NOTA : En caso de ser capacitación se necesita el visto
                                    bueno de Gestión de talento.</i></small>
                        </div>
                    </div>
                </div>
                <form method="POST" wire:submit.prevent="Firmar(Object.fromEntries(new FormData($event.target)))"
                    enctype="multipart/form-data">
                    <div class="card card-body">
                        <div class="">
                            <h5><strong>Firma*</strong></h5>
                            <p>
                                Indispensable firmar la requisición antes de guardar y enviarla a aprobación de lo contrario
                                podrá ser rechazada por alguno de los colaboradores
                            </p>
                        </div>
                        <div class="flex caja-firmar" wire:ignore>
                            <div class="flex-item" style="display:flex; justify-content: center;">
                                <div id="firma_content" class="caja-space-firma">
                                    <input type="hidden" name="firma" id="firma">
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-item" style="display: flex; justify-content:center;">
                                <div class="btn" style="background: #959595 !important" id="clear">Limpiar</div>
                            </div>
                        </div>
                        <div class="flex" style="position: relative; top: -1rem; justify-content: end; ">
                            <button onclick="validar()" class="btn btn-primary" type="submit">Firmar</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        </div>
      </div>

    {{-- <div class="card card-content  hide" wire:ignore>
        <ul class="tabs" id="tabs-swipe-demo">
            <li class="tab">
                <a href="#paso-servicio" class="active">
                    <i class="number-icon active-number">1</i> Servicios y Productos
                </a>
            </li>
            <li class="tab">
                <a href="#paso-proveedores">
                    <i class="number-icon">2</i> Proveedores
                </a>
            </li>
            <li class="tab">
                <a href="#paso-firma">
                    <i class="number-icon">3</i> Firma
                </a>
            </li>
        </ul>
    </div> --}}

    {{-- <div class="card card-content caja-proceso-requi" wire:ignore>
        <div class="flex" style="gap: 20px;">
            <div class="paso-tab active" data-id="paso-servicio">
                <i class="number-icon">1</i> Servicios y Productos
            </div>
            <hr>
            <div class="paso-tab" data-id="paso-proveedores">
                <i class="number-icon">2</i> Proveedores
            </div>
            <hr>
            <div class="paso-tab" data-id="paso-firma">
                <i class="number-icon">3</i> Firma
            </div>
        </div>
    </div> --}}




    @if ($habilitar_alerta)
      <b>  <H1>LA EXTENCIÓN DE ARCHIVO NO ES VALIDA</H1> </b>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var emailV = document.getElementById('emailV');
        $(function(){
        $(document).on('keyup','#foo',function(){
            var val = $(this).val().trim(),
                reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if( reg.test(val) == false ){
                emailV.innerHTML =  "email incorrecto";
            }

            else{
                emailV.innerHTML =  "";
            }
        });
        });
        function validar(params) {
            var x = $("#firma").val();
            if (x) {
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Registro guardado con éxito.',
                showConfirmButton: false,
                timer: 1500
                })
            }else{
                Swal.fire(
                 'Aun no ha firmado',
                 'Porfavor Intentelo nuevamente',
                 'error')
            }
        }
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.signature.min.js') }}"></script>

    @section('scripts')
    <script>
         $(".not-select2").select2('destroy');
    </script>
        <script>
            Livewire.on('render_firma', (id_tab) => {
                var signaturePad = $('#firma_content').signature({
                    syncField: '#firma',
                    syncFormat: 'PNG',
                    change: function(event, ui) {
                        if (signaturePad.signature().length > 0) {
                            // La firma está presente, lo que indica que se ha terminado de firmar
                            console.log("Firma completada");
                            // Ejecutar código adicional aquí
                            // ...
                            console.log('ferras');
                        } else {
                            // La firma está vacía, lo que indica que aún no se ha firmado
                            console.log("No se ha firmado");
                        }
                    }
                });

                $('#clear').click(function(e) {
                    e.preventDefault();
                    signaturePad.signature('clear');
                    $("#firma").val('');
                });
            });
        </script>

<script>
            document.addEventListener("DOMContentLoaded", () => {
                @this.set('products_servs_count', 1);

                Livewire.on('cambiarTab', (id_tab) => {
                    // Activa la pestaña con ID 'profile'
                    $('#myTab a[href="#' + id_tab + '"]').tab('show');
                });

                var fecha = new Date();
                document.getElementById("fecha-solicitud-input").value = fecha.toJSON().slice(0, 10);
            });

            function printArea() {
                let area = $('#select_solicitante option:selected').attr("data-area");
                document.querySelector('#area_print').value = area;
            }

            function addCard(tipo_card) {
                if (tipo_card === 'servicio') {
                    let card = document.querySelector('.card-product');
                    let nueva_card = document.createElement("div");
                    nueva_card.classList.add("card");
                    nueva_card.classList.add("card-content");
                    nueva_card.classList.add("card-product");
                    let cards_count = document.querySelectorAll('.card-product').length + 1;
                    nueva_card.setAttribute("data-count", cards_count);
                    let id_nueva_card = 'product-serv-' + cards_count;
                    nueva_card.setAttribute('id', id_nueva_card);

                    let caja_cards = document.querySelector('.caja-card-product');
                    caja_cards.appendChild(nueva_card);
                    document.querySelector('.card-product:last-child').innerHTML += card.innerHTML;

                    document.querySelector('#' + id_nueva_card + ' .model-cantidad').setAttribute('name', 'cantidad_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .model-producto').setAttribute('name', 'producto_' + cards_count);
                    document.querySelector('#' + id_nueva_card + ' .model-especificaciones').setAttribute('name', 'especificaciones_' + cards_count);
                    @this.set('products_servs_count', cards_count);
                }

                if (tipo_card === 'proveedor') {

                    //@this.set('proveedores_count', {{$proveedores_count + 1}});

                    Livewire.emit('actualizarCountProveedores');
                }
            }

            function deleteProduct(){
                document.querySelector('.card-product:hover').remove();
            }

            function deleteProveedor(){
                document.querySelector('.card-proveedor:hover').remove();
            }
        </script>

        <script>
            $('.select_contratos').select2({
             templateResult: productTemplate,
             escapeMarkup: function(m) { return m; }

             });

             function productTemplate(state) {
             var original = state.element;

             result =  ' <strong> '+  $(original).data('no') + ' </strong> '+ $(original).data('servicio') + ' <strong> '+ $(original).data('proveedor')+' </strong> ';

             return result;
           }
        </script>

        <script>
            // Livewire.on('select2', () => {
            //     setTimeout(() => {
            //         $('.select2').select2();
            //     }, 1000);
            // });
        </script>

    @endsection
</div>
