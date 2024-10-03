<div>
    <div class="create-requisicion">
        <div class="card card-body caja-blue">

            <div>
                <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="width:150px;">
            </div>

            <div>
                <h3 style="font-size: 22px; font-weight: bolder;">Bienvenido </h3>
                <h5 style="font-size: 17px;">En esta sección puedes generar tu requisición</h5>
                <p>
                    Aquí podrás crear, revisar y procesar solicitudes de compra de manera rápida y sencilla, <br>
                    optimizando el flujo de trabajo y asegurando un seguimiento transparente de todas las
                    transacciones.&nbsp;
                </p>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active disable" id="home-tab" data-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true" style="pointer-events: none"><i
                        class="number-icon active-number">1</i> Servicios y
                    Productos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link disable" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false" style="pointer-events: none"><i
                        class="number-icon">2</i>
                    Proveedores</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link disable" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false" style="pointer-events: none"><i
                        class="number-icon">3</i>
                    Firma</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div id="home" class="tab-content" {{ $paso == 1 ? '' : 'style=display:none;' }}>
                    <form method="POST"
                        wire:submit.prevent="servicioStore(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="card card-body">
                            <h3 class="titulo-form">Solicitud de requisición</h3>
                            <hr style="margin: 30px 0px;">

                            <div class="row mb-3">
                                <div class="col s12 l3">
                                    <div class="anima-focus">
                                        <input id="fecha_solicitud" name="fecha_solicitud" wire:model="fecha_solicitud"
                                            class="form-control" type="date">
                                        <label for="fecha_solicitud">
                                            Fecha solicitud <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    <div>
                                        @error('fecha_solicitud')
                                            <span style="color: red;" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col s12 l3">
                                    <div class="anima-focus">
                                        <select class="form-control" name="sucursal_id" id="sucursal_id"
                                            wire:model="sucursal_id">
                                            <option value="" selected disabled>Seleccione Razón Social
                                            </option>
                                            @foreach ($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}">{{ $sucursal->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="sucursal_id">
                                            Razón Social <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    <div>
                                        @error('sucursal_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col s12 l3">
                                    <div class="anima-focus">
                                        <input class="form-control" id="user_name" name="user_name"
                                            wire:model="user_name" readonly style="background: #eaf0f1" type="text">
                                        <label for="user_name">
                                            Solicita <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    <div>
                                        @error('user_name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col s12 l3">
                                    <div class="anima-focus">
                                        <input id="user_area" name="user_area" wire:model="user_area" readonly
                                            style="background: #eaf0f1" class="form-control" type="text">
                                        <label for="area">
                                            Área que solicita <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    <div>
                                        @error('user_area')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col s12 l6">
                                    <div class="anima-focus">
                                        <input class="form-control" type="text" value="" maxlength="255"
                                            name="descripcion" id="descripcion" wire:model="descripcion">
                                        <label for="descripcion">
                                            Referencia (Título de la requisición) <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    <div>
                                        @error('descripcion')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col s12 l3">
                                    <div class="anima-focus">
                                        <select class="form-control" name="comprador_id" id="comprador_id"
                                            wire:model="comprador_id">
                                            <option value="" selected disabled>Seleccione Comprador</option>
                                            @foreach ($compradores as $comprador)
                                                <option value="{{ $comprador->id }}">
                                                    @isset($comprador->user->name)
                                                        {{ $comprador->user->name }}
                                                    @endisset
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="comprador_id">
                                            Comprador <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    <div>
                                        @error('comprador_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col s12 l3">
                                    <div class="anima-focus">
                                        <select class="form-control" name="contrato_id" id="contrato_id"
                                            wire:model="contrato_id">
                                            <option value="" selected disabled data-no="" data-servicio=""
                                                data-proveedor="">Seleccione Contrato</option>
                                            @foreach ($contratos as $contrato)
                                                <option value="{{ $contrato->id }}"
                                                    data-no="{{ $contrato->no_proyecto }}"
                                                    data-servicio="{{ $contrato->no_contrato }}"
                                                    data-proveedor="{{ $contrato->nombre_servicio }}">
                                                    {{ $contrato->no_proyecto }} / {{ $contrato->no_contrato }} -
                                                    {{ $contrato->nombre_servicio }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="contrato_id">Proyecto<font class="asterisco">*
                                            </font></label>
                                    </div>
                                    @error('comprador_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card card-body card-inner card-product">
                            <div class="col s12">
                                <div class="flex" style="justify-content: space-between">
                                    <h3 class="sub-titulo-form">Captura del producto o servicio</h3>
                                </div>
                            </div>
                            <div class="row mt-4 mb-3">
                                <div class="col s12 l4">
                                    <div class="anima-focus">
                                        <input type="number" id="cantidad_oblig" name="cantidad_oblig"
                                            wire:model="cantidad_oblig" pattern="[0-9]+"
                                            title="Por favor, ingrese solo números enteros."
                                            class="model-cantidad form-control">
                                        <label for="cantidad_oblig">
                                            Cantidad <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    @error('cantidad_oblig')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col s12 l8">
                                    <div class="anima-focus">
                                        <select class="model-producto form-control not-select2" id="producto_oblig"
                                            name="producto_oblig" wire:model="producto_oblig">
                                            <option value="" selected disabled>Seleccione un Producto o
                                                Servicio
                                            </option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}">{{ $producto->descripcion }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="producto_oblig">
                                            Producto o servicio <font class="asterisco">*</font>
                                        </label>
                                    </div>
                                    @error('producto_oblig')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 l12">
                                    <div class="anima-focus">
                                        <textarea class="model-especificaciones form-control" maxlength="500" id="especificaciones_oblig"
                                            name="especificaciones_oblig" wire:model="especificaciones_oblig"></textarea>
                                        <label for="especificaciones_oblig">
                                            Especificaciones del producto o servicio <font class="asterisco">*
                                            </font>
                                        </label>
                                    </div>
                                    @error('especificaciones_oblig')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @foreach ($array_productos as $key => $producto)
                            <div class="card card-body card-inner card-product">
                                <div class="col s12">
                                    <div class="flex" style="justify-content: space-between">
                                        <h3 class="sub-titulo-form">Captura del producto o servicio</h3>
                                        <i class="fa-regular fa-trash-can btn-deleted-card btn-deletd-product"
                                            title="Eliminar producto"
                                            wire:click="removeProductos({{ $key }})"></i>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-3">
                                    <div class="col s12 l4">
                                        <div class="anima-focus">
                                            <input type="number" id="cantidad_oblig" name="cantidad_oblig"
                                                wire:model="array_productos.{{ $key }}.cantidad"
                                                pattern="[0-9]+" title="Por favor, ingrese solo números enteros."
                                                class="model-cantidad form-control">
                                            <label for="cantidad_oblig">
                                                Cantidad <font class="asterisco">*</font>
                                            </label>
                                        </div>
                                        @error('cantidad_oblig')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col s12 l8">
                                        <div class="anima-focus">
                                            <select class="model-producto form-control not-select2"
                                                id="producto_oblig" name="producto_oblig"
                                                wire:model="array_productos.{{ $key }}.producto">
                                                <option value="" selected disabled>Seleccione un Producto o
                                                    Servicio
                                                </option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}">
                                                        {{ $producto->descripcion }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="producto_oblig">
                                                Producto o servicio <font class="asterisco">*</font>
                                            </label>
                                        </div>
                                        @error('producto_oblig')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 l12">
                                        <div class="anima-focus">
                                            <textarea class="model-especificaciones form-control" maxlength="500" id="especificaciones_oblig" name=""
                                                wire:model="array_productos.{{ $key }}.especificaciones"></textarea>
                                            <label for="especificaciones_oblig">
                                                Especificaciones del producto o servicio <font class="asterisco">*
                                                </font>
                                            </label>
                                        </div>
                                        @error('especificaciones_oblig')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="my-4" style="display:flex; justify-content: space-between;">
                            <div class="btn btn-add-card" wire:click="addProductos()">
                                <i class="fa-regular fa-square-plus"></i>
                                AGREGAR SERVICIOS Y PRODUCTOS
                            </div>

                            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">
                                <!-- Button content when not loading -->
                                <span wire:loading.remove>
                                    Siguiente <i class="fa-solid fa-chevron-right icon-next"></i>
                                </span>

                                <!-- Loading spinner when loading -->
                                <span wire:loading>
                                    <i class="fa-solid fa-spinner fa-spin"></i> Procesando...
                                </span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade  show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div id="profile" class="tab-content" {{ $paso == 2 ? '' : 'style=display:none;' }}>
                    <form id="form-proveedores"
                        wire:submit.prevent="proveedoresStore(Object.fromEntries(new FormData($event.target)))"
                        action="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-body">
                            <h3 class="titulo-form">Solicitud de requisición</h3>
                            <hr style="margin: 20px 0px;">
                            <p>
                                Provea contexto detallado de su necesidad de Adquisición, es importante mencionar si
                                es
                                que
                                la
                                solicitud está ligada a algún proyecto en particular.
                                <br>
                                En caso de que no se brinde detalle suficiente que sustente la compra, es no
                                procedera.
                            </p>
                        </div>
                        <div class="caja-card-proveedor caja-cards-inner">
                            @foreach ($array_proveedores as $keyP => $proveedor)
                                <div id="proveedor-card-{{ $keyP }}"
                                    class="card card-body card-inner card-proveedor"
                                    data-count="{{ $keyP }}">
                                    <div class="row">
                                        <div class="col s12 ">
                                            <div class="flex" style="justify-content: space-between">
                                                <h3 class="sub-titulo-form">Captura del Proveedor</h3>
                                                @if ($keyP > 0)
                                                    <i class="fa-regular fa-trash-can btn-deleted-card btn-deletd-proveedor"
                                                        title="Eliminar proveedor"
                                                        wire:click.prevent="removeProveedor({{ $keyP }})"
                                                        wire:confirm="¿Desea eliminar este registro proveedor?"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col s12 l12 mt-3 mb-3">
                                            <label for="proveedor_{{ $keyP }}">
                                                Proveedor <font class="asterisco">*</font>
                                            </label>
                                            <select class="form-control not-select2"
                                                wire:model.lazy='array_proveedores.{{ $keyP }}.proveedor_id'
                                                name="proveedor_{{ $keyP }}" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="otro">Otro</option>
                                                @foreach ($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}
                                                        -
                                                        {{ $proveedor->rfc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-3">
                                        <div class="col s12 l6 anima-focus mt-3 mb-3">
                                            <input type="date" id="fechaInicio"
                                                wire:model= "array_proveedores.{{ $keyP }}.fechaInicio"
                                                class="form-control modal-start"
                                                name="contacto_fecha_inicio_{{ $keyP }}" required>
                                            <label for="contacto_fecha_inicio_{{ $keyP }}">
                                                Fecha inicio*
                                            </label>
                                        </div>
                                        <div class="col s12 l6 anima-focus mt-3 mb-3">
                                            <input type="date" id="fechaFin"
                                                wire:model= "array_proveedores.{{ $keyP }}.fechaFin"
                                                class="form-control modal-end"
                                                name="contacto_fecha_fin_{{ $keyP }}" required>
                                            <label for="contacto_fecha_fin_{{ $keyP }}">
                                                Fecha fin*
                                            </label>
                                        </div>
                                    </div>
                                    <div wire:loading>
                                        <i class="fas fa-spinner fa-spin"></i> Cargando...
                                    </div>

                                    <br>
                                    @if ($array_proveedores[$keyP]['proveedor_id'] == 'otro')
                                        <div class="row mb-1">
                                            <div class="col s12 l12 anima-focus mt-3 mb-3">
                                                <select class="form-control"
                                                    wire:model.lazy='array_proveedores.{{ $keyP }}.select_otro'
                                                    name="proveedor_otro{{ $keyP }}" required>
                                                    <option value="" disabled>Seleccione una Opción</option>
                                                    <option value="indistinto">Indistinto</option>
                                                    <option value="sugerido">Sugerido</option>
                                                </select>
                                                <label for="proveedor_otro{{ $keyP }}">Tipo de
                                                    Proveedor</label>
                                            </div>
                                        </div>
                                        @if ($array_proveedores[$keyP]['select_otro'] === 'sugerido')
                                            <div class="row mt-3 mb-3">
                                                <div class="col s12 l6 anima-focus">
                                                    <input type="text" required class="form-control modal-detalles"
                                                        wire:model.lazy='array_proveedores.{{ $keyP }}.detalles'
                                                        placeholder="" id="detalles_{{ $keyP }}"
                                                        name="detalles_{{ $keyP }}">
                                                    <label for="detalles_{{ $keyP }}">
                                                        Detalles del producto <font class="asterisco">*</font>
                                                    </label>
                                                </div>
                                                <div class="col s12 l3">
                                                    <input type="radio" class="modal-tipo"
                                                        name="tipo_{{ $keyP }}"
                                                        wire:model='array_proveedores.{{ $keyP }}.tipo'
                                                        value="fisico" required>
                                                    <label for="tipo_{{ $keyP }}">
                                                        Proveedor Físico
                                                    </label>
                                                </div>
                                                <div class="col s12 l3">
                                                    <input type="radio" class="modal-tipo-2"
                                                        id="tipo_{{ $keyP }}"
                                                        wire:model='array_proveedores.{{ $keyP }}.tipo'
                                                        name="tipo_{{ $keyP }}" value="online" required>
                                                    <label for="tipo_{{ $keyP }}">
                                                        Proveedor Online
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col s12 l12 anima-focus">
                                                    <textarea wire:model='array_proveedores.{{ $keyP }}.comentarios' class="form-control modal-comentario"
                                                        id="comentarios_{{ $keyP }}" name="comentarios_{{ $keyP }}" required></textarea>
                                                    <label for="comentarios_{{ $keyP }}">
                                                        Comentarios <font class="asterisco">*</font>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col s12 l12 anima-focus">
                                                    <h3 class="sub-titulo-form">Datos de contacto</h3>
                                                </div>
                                                <div class="col s12 l6 anima-focus">
                                                    <input type="text"
                                                        wire:model='array_proveedores.{{ $keyP }}.nombre_contacto'
                                                        class="form-control modal-nombre"
                                                        id="contacto_{{ $keyP }}" placeholder=""
                                                        name="contacto_{{ $keyP }}" required>
                                                    <label for="contacto_{{ $keyP }}">
                                                        Nombre del contacto*
                                                    </label>
                                                </div>
                                                <div class="col s12 l3 anima-focus">
                                                    <input id="phone" type="text"
                                                        wire:model='array_proveedores.{{ $keyP }}.telefono_contacto'
                                                        id="contacto_telefono_{{ $keyP }}"
                                                        name="contacto_telefono_{{ $keyP }}"
                                                        class="form-control modal-telefono" pattern="\x2b[0-9]+"
                                                        size="20" placeholder="" required>
                                                    <label for="contacto_telefono_{{ $keyP }}">
                                                        Teléfono*
                                                    </label>
                                                </div>
                                                <div class="col s12 l3 anima-focus">
                                                    <input type="email" id="foo"
                                                        class="form-control modal-correo" placeholder=""
                                                        wire:model='array_proveedores.{{ $keyP }}.correo_contacto'
                                                        id="contacto_correo_{{ $keyP }}"
                                                        name="contacto_correo_{{ $keyP }}" required>
                                                    <label for="contacto_correo_{{ $keyP }}">
                                                        Correo Electrónico*
                                                    </label>

                                                    <h1 id="emailV"></h1>
                                                </div>
                                            </div>
                                            <div class="row mt-1 mb-1">
                                                <div class="col s12 l12 anima-focus">
                                                    <input type="url" class="form-control modal-url"
                                                        placeholder=""
                                                        wire:model='array_proveedores.{{ $keyP }}.url_contacto'
                                                        id="contacto_url_{{ $keyP }}"
                                                        name="contacto_url_{{ $keyP }}">
                                                    <label for="contacto_url_{{ $keyP }}">
                                                        URL*
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 l12 anima-focus">
                                                    <input type="file" required
                                                        class="modal-cotizacion form-control-file"
                                                        wire:model='array_proveedores.{{ $keyP }}.archivo'
                                                        id="cotizacion_{{ $keyP }}"
                                                        name="cotizacion_{{ $keyP }}"
                                                        accept=".pdf, .docx, .pptx, .point, .xml, .jpeg, .jpg, .png, .xlsx, .xlsm, .csv">
                                                    <label for="cotizacion_{{ $keyP }}">
                                                        Carga de cotizaciones <font class="asterisco">*</font>
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                            <button class="btn btn-primary" wire:click.prevent="openChat">
                                                Robot
                                                <i class="fa-solid fa-robot"></i>
                                                <span wire:loading wire:target="openChat">
                                                    <i class="fas fa-spinner fa-spin"></i> Cargando...
                                                </span>
                                            </button>

                                            <div>
                                                @if ($chatOpen)
                                                    <div class="chat-wrapper">
                                                        <div class="chat-box">
                                                            <div class="chat-frame">
                                                                <div class="chat-header">
                                                                    <h3>Chat Bot</h3>
                                                                    <button class="close-btn"
                                                                        wire:click="closeChat">&times;</button>
                                                                </div>
                                                                <div class="chat-content">
                                                                    <!-- Mensajes del chat -->
                                                                    @if ($saludo)
                                                                        <p>Hola, ¿cómo puedo ayudarte hoy?</p>
                                                                    @endif

                                                                    @if ($respuesta = $this->respuesta['response'] ?? null)
                                                                        <div class="response">
                                                                            <p>{{ $respuesta }}</p>
                                                                        </div>
                                                                    @endif
                                                                    <span wire:loading wire:target="askQuestion">
                                                                        <i class="fas fa-spinner fa-spin"></i>
                                                                        Cargando...
                                                                    </span>
                                                                </div>
                                                                <div class="chat-input">
                                                                    <input type="text" id="question"
                                                                        wire:model.lazy="question">
                                                                    <button type="submit"
                                                                        wire:click.prevent="askQuestion">Enviar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="my-4" style="display:flex; justify-content: space-between;">
                            <button type="button" class="btn btn-add-card" wire:click.prevent="agregarProveedor()">
                                <i class="fa-regular fa-square-plus icon-prior"></i>
                                AGREGAR PROVEEDOR
                            </button>
                            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">
                                <!-- Button content when not loading -->
                                <span wire:loading.remove>
                                    Siguiente <i class="fa-solid fa-chevron-right icon-next"></i>
                                </span>

                                <!-- Loading spinner when loading -->
                                <span wire:loading>
                                    <i class="fa-solid fa-spinner fa-spin"></i> Procesando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade  show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div id="contact" class="tab-content" {{ $paso == 3 ? '' : 'style=display:none;' }}>
                    @if ($paso == 3)
                        <div class="card card-item doc-requisicion">
                            <div class="flex header-doc">
                                <div class="flex-item item-doc-img">
                                    @if ($requisicion->sucursal->mylogo)
                                        <td><img src="{{ url('razon_social/' . $requisicion->sucursal->mylogo) }}"
                                                style="width:100%; max-width:150px;" alt=""></td>
                                    @else
                                        <td><img src="{{ asset('sinLogo.png') }}"
                                                style="width:100%; max-width:150px;" alt=""></td>
                                    @endif
                                </div>
                                <div class="flex-item info-med-doc-header">
                                    {{ $requisicion->sucursal->empresa }} <br>
                                    {{ $requisicion->sucursal->rfc }} <br>
                                    {{ $requisicion->sucursal->direccion }} <br>
                                </div>
                                <div class="flex-item item-header-doc-info" style="">
                                    <h4 style="font-size: 18px; color:var(--color-tbj);">REQUISICIÓN DE ADQUISICIONES
                                    </h4>
                                    <p>Folio: RQ-00-00{{ $requisicion->id }}</p>
                                    <p>Fecha de solicitud:{{ date('d-m-Y', strtotime($requisicion->fecha)) }} </p>
                                </div>
                            </div>
                            <div class="flex doc-blue">
                                <div class="flex-item">
                                    <strong>Referencia:</strong><br>
                                    {{ $requisicion->referencia }}<br><br>
                                    <strong>Proyecto:</strong><br>
                                    {{ $requisicion->contrato->no_proyecto }} /
                                    {{ $requisicion->contrato->no_contrato }}
                                    - {{ $requisicion->contrato->nombre_servicio }}
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
                                            <small> -Provea contexto detallado de su necesidad de adquisición, es
                                                importante
                                                mencionar si es que la solicitud está ligada a algún proyecto en
                                                particular.
                                                -En
                                                caso de que no se brinde detalle suficiente que sustente la compra,
                                                esto
                                                no
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
                                                <small> -Provea contexto detallado de su necesidad de adquisición,
                                                    es
                                                    importante
                                                    mencionar si es que la solicitud está ligada a algún proyecto en
                                                    particular. -En
                                                    caso de que no se brinde detalle suficiente que sustente la
                                                    compra,
                                                    esto
                                                    no
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
                                            <strong>Proveedor: </strong> Indistinto
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex-item">
                                            <small> -Provea contexto detallado de su necesidad de adquisición, es
                                                importante
                                                mencionar si es que la solicitud está ligada a algún proyecto en
                                                particular.
                                                -En
                                                caso de que no se brinde detalle suficiente que sustente la compra,
                                                esto
                                                no
                                                procedera </small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 l4">
                                            <strong>Fecha Inicio:</strong><br><br>
                                            {{ date('d-m-Y', strtotime($this->provedores_indistinto_catalogo->fecha_inicio)) }}
                                        </div>
                                        <div class="col s12 l4">
                                            <strong>Fecha Fin:</strong><br><br>
                                            {{ date('d-m-Y', strtotime($this->provedores_indistinto_catalogo->fecha_fin)) }}
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
                                    <small><i style="color: #2395AA;">-NOTA : En caso de ser capacitación se
                                            necesita
                                            el
                                            visto
                                            bueno de Gestión de talento.</i></small>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>

        <div id="formulario-firma" style="{{ $test }}">
            <form method="POST" wire:submit.prevent="Firmar(Object.fromEntries(new FormData($event.target)))"
                enctype="multipart/form-data">
                <div class="card card-body">
                    <div class="">
                        <h5><strong>Firma*</strong></h5>
                        <p>
                            Indispensable firmar la requisición antes de guardar y enviarla a aprobación de lo
                            contrario
                            podrá ser rechazada por alguno de los colaboradores
                        </p>
                    </div>
                    <div class="flex caja-firmar" wire:ignore>
                        <div class="flex-item" style="display:flex; justify-content: center;">
                            <div id="firma_content" class="caja-space-firma"
                                style="display: flex; justify-content: center; align-items: center;">
                                <canvas id="firma_requi" width="500px" height="300px">
                                    Navegador no compatible
                                </canvas>
                                <input type="hidden" name="firma" id="firma">
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-item" style="display: flex; justify-content:center;">
                            <div class="btn" style="background: #959595 !important" id="clear">Limpiar
                            </div>
                        </div>
                    </div>
                    <div class="flex my-4" style="justify-content: end;">
                        <button onclick="validar()" class="btn btn-primary" type="submit">Firmar</button>
                    </div>
                </div>
            </form>
        </div>

        @if ($habilitar_alerta_cotizacion)
            <b>
                <H1>Ocurrio algo Inesperado Intentelo Nuevamente</H1>
            </b>
        @endif

        @if ($habilitar_alerta)
            <b>
                <H1>LA EXTENCIÓN DE ARCHIVO NO ES VALIDA</H1>
            </b>
        @endif
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        console.log('DOMContentLoaded profile');

        // Correctly set the Livewire property using Livewire.find()
        @this.set('products_servs_count', 1);

        // Listen for the Livewire 'cambiarTab' event and activate the correct tab
        Livewire.on('cambiarTab', (id_tab) => {
            console.log('cambiarTab');
            document.querySelector(`#myTab a[href="#${id_tab}"]`).click(); // Activates the tab
            console.log('cambiarTab paso id');
        });
    });


    document.addEventListener('livewire:initialized', () => {
        @this.on('probando', (event) => {
            document.getElementById('formulario-firma').style.display = 'block';
            console.log('Formulario visible');

            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
            })();

            if (document.getElementById('firma_requi')) {
                console.log('if de firma_requi')
                renderCanvas("firma_requi", "clear");
            }

            $('#firma_requi').mouseleave(function() {
                var canvas = document.getElementById('firma_requi');
                var dataUrl = canvas.toDataURL();
                $('#firma').val(dataUrl);
            });

            function renderCanvas(contenedor, clearBtnCanvas) {
                console.log('rendercanvas')
                var canvas = document.getElementById(contenedor);
                console.log(canvas);
                var ctx = canvas.getContext("2d");
                ctx.strokeStyle = "#222222";
                ctx.lineWidth = 1;

                var drawing = false;
                var mousePos = {
                    x: 0,
                    y: 0
                };
                var lastPos = mousePos;

                canvas.addEventListener("mousedown", function(e) {
                    drawing = true;
                    lastPos = getMousePos(canvas, e);
                }, false);

                canvas.addEventListener("mouseup", function(e) {
                    drawing = false;
                }, false);

                canvas.addEventListener("mousemove", function(e) {
                    mousePos = getMousePos(canvas, e);
                }, false);

                // Add touch event support for mobile
                canvas.addEventListener("touchstart", function(e) {

                }, false);

                canvas.addEventListener("touchmove", function(e) {
                    var touch = e.touches[0];
                    var me = new MouseEvent("mousemove", {
                        clientX: touch.clientX,
                        clientY: touch.clientY
                    });
                    canvas.dispatchEvent(me);
                }, false);

                canvas.addEventListener("touchstart", function(e) {
                    mousePos = getTouchPos(canvas, e);
                    var touch = e.touches[0];
                    var me = new MouseEvent("mousedown", {
                        clientX: touch.clientX,
                        clientY: touch.clientY
                    });
                    canvas.dispatchEvent(me);
                }, false);

                canvas.addEventListener("touchend", function(e) {
                    var me = new MouseEvent("mouseup", {});
                    canvas.dispatchEvent(me);
                }, false);

                function getMousePos(canvasDom, mouseEvent) {
                    var rect = canvasDom.getBoundingClientRect();
                    return {
                        x: mouseEvent.clientX - rect.left,
                        y: mouseEvent.clientY - rect.top
                    }
                }

                function getTouchPos(canvasDom, touchEvent) {
                    var rect = canvasDom.getBoundingClientRect();
                    return {
                        x: touchEvent.touches[0].clientX - rect.left,
                        y: touchEvent.touches[0].clientY - rect.top
                    }
                }

                function renderCanvas() {
                    if (drawing) {
                        ctx.moveTo(lastPos.x, lastPos.y);
                        ctx.lineTo(mousePos.x, mousePos.y);
                        ctx.stroke();
                        lastPos = mousePos;
                    }
                }

                // Prevent scrolling when touching the canvas
                document.body.addEventListener("touchstart", function(e) {
                    if (e.target == canvas) {
                        e.preventDefault();
                    }
                }, false);
                document.body.addEventListener("touchend", function(e) {
                    if (e.target == canvas) {
                        e.preventDefault();
                    }
                }, false);
                document.body.addEventListener("touchmove", function(e) {
                    if (e.target == canvas) {
                        e.preventDefault();
                    }
                }, false);

                (function drawLoop() {
                    requestAnimFrame(drawLoop);
                    renderCanvas();
                })();

                function clearCanvas() {
                    canvas.width = canvas.width;
                }

                function isCanvasBlank() {
                    const context = canvas.getContext('2d');

                    const pixelBuffer = new Uint32Array(
                        context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                    );

                    return !pixelBuffer.some(color => color !== 0);
                }

                // Set up the UI
                // var sigText = document.getElementById(dataBaseCanvas);
                // var sigImage = document.getElementById(imageCanvas);
                var clearBtn = document.getElementById(clearBtnCanvas);
                // var submitBtn = document.getElementById(submitBtnCanvas);
                clearBtn.addEventListener("click", function(e) {
                    clearCanvas();
                    // sigText.innerHTML = "Data URL for your signature will go here!";
                    // sigImage.setAttribute("src", "");
                }, false);
                // submitBtn.addEventListener("click", function(e) {
                //     const blank = isCanvasBlank();
                //     if (!blank) {
                //         // var dataUrl = canvas.toDataURL();
                //         // sigText.innerHTML = dataUrl;
                //         // sigImage.setAttribute("src", dataUrl);
                //     } else {
                //         if (toastr) {
                //             toastr.info('No has firmado en el canvas');
                //         } else {
                //             alert('No has firmado en el canvas');
                //         }
                //     }
                // }, false);

            }

            function isCanvasEmpty(canvas) {
                const context = canvas.getContext('2d');

                const pixelBuffer = new Uint32Array(
                    context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                );

                return !pixelBuffer.some(color => color !== 0);
            }
        });
    });
</script>
