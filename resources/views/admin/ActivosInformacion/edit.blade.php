@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Activo de Información</h5>
<div class="mt-4 card">
    <form method="POST" action="{{ route("admin.activosInformacion.update",$activos)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
                <div class="col-12">
                        <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                            Información General
                        </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="identificador"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                            <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="identificador" id="identificador" value="{{ old('identificador', $activos->identificador) }}">
                            <small id="identificador" class="text-danger"></small>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="nombreVP"><i class="fas fa-street-view iconos-crear"></i>Nombre VP</label>
                            <select class="custom-select my-1 mr-sm-2" id="nombreVP" name="vicepresidencia_id">
                                <option value="" selected disabled>Seleccione una opción</option>
                                @foreach ($grupos as $grupo)
                                    <option {{ old('vicepresidencia_id') == $grupo->id ? ' selected="selected"' : '' }}
                                        value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>





                        {{--  <div class="row">
                            <div class="form-group col-md-4">
                            <label for="dueno_id"><i class="fas fa-user-tie iconos-crear"></i>Nombre VP</label>
                            <select class="form-control select2 {{ $errors->has('dueno_id') ? 'is-invalid' : '' }}"
                                name="dueno_id" id="dueno_id">
                                @foreach ($empleados as $empleado)
                                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                        data-area="{{ $empleado->area->area }}">

                                        {{ $empleado->name }}
                                    </option>

                                @endforeach
                            </select>
                            @if ($errors->has('dueno_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dueno_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                            <label for="id_puesto_dueno"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_dueno"></div>

                        </div>
                        <div class="form-group col-sm-12 col-md-4 col-lg-4">
                            <label for="id_area_dueno"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_dueno"></div>

                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="duenoVP"><i class="fas fa-user-tie iconos-crear"></i>Dueño AI Nombre del VP</label>
                            <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                name="duenoVP" id="duenoVP">
                                @foreach ($empleados as $empleado)
                                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                        data-area="{{ $empleado->area->area }}"  {{ old('duenoVP', $activos->duenoVP) == $empleado->id ? 'selected' : '' }}>

                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('empleados'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_puesto_responsable"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_responsable"></div>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_area_responsable"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_responsable"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="nombre_direccion"><i class="fas fa-list-ol iconos-crear"></i>Nombre Dirección</label>
                            <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="nombre_direccion" id="nombre_direccion" value="{{ old('nombre_direccion', $activos->nombre_direccion)}}">
                            <small id="error_banco" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="custodioALDirector"><i class="fas fa-user-tie iconos-crear"></i>Custodio AI Nombre Director</label>
                            <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                name="custodioALDirector" id="custodioALDirector">
                                @foreach ($empleados as $empleado)
                                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                        data-area="{{ $empleado->area->area }}"
                                        {{ old('custodioALDirector', $activos->custodioALDirector) == $empleado->id ? 'selected' : '' }}>

                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('empleados'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="puesto_custodio"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_custodio"></div>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="area_custodio"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_custodio"></div>
                        </div>
                    </div>



                    {{-- <div class="form-group col-sm-12">
                        <label for="cuenta_bancaria"><i class="fa-solid fa-user iconos-crear"></i>Dueño AI</label>
                        <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
                            name="cuenta_bancaria" id="cuenta_bancaria">
                    </div> --}}
                    {{-- <div class="form-group col-sm-12">
                        <label for="cuenta_bancaria"><i class="fa-solid fa-user iconos-crear"></i>Custodio AI Nombre Director</label>
                        <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
                            name="cuenta_bancaria" id="cuenta_bancaria">
                    </div> --}}
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="activo_informacion"><i class="fas fa-folder-plus iconos-crear"></i>Activo de información</label>
                        <input class="form-control {{ $errors->has('activo_informacion') ? 'is-invalid' : '' }}" type="text"
                            name="activo_informacion" id="activo_informacion" value="{{ old('activo_informacion', $activos->activo_informacion)}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="formato"><i class="fas fa-file-contract iconos-crear"></i>Formato</label>
                        <input class="form-control {{ $errors->has('formato') ? 'is-invalid' : '' }}" type="text"
                            name="formato" id="formato" value="{{ old('formato', $activos->formato)}}">
                    </div>

                    <div class="form-group col-md-4">
                                <label for="proceso_id"><i class="bi bi-file-earmark-post iconos-crear"></i>Proceso</label>
                                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                        name="proceso_id" id="proceso_id">
                                        @foreach ($procesos as $proceso)
                                            <option data-codigo="{{ $proceso->codigo }}" value="{{ $proceso->id }}"
                                                data-macroproceso="{{ $proceso->macroproceso->nombre }}"
                                                {{ old('proceso_id', $activos->proceso_id) == $proceso->id ? 'selected' : '' }}>
                                                {{ $proceso->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                @if ($errors->has('empleados'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('area') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="codigo_proceso"><i class="fas fa-barcode iconos-crear" style="margin-top: 8px"></i>Codigo</label>
                                <div class="form-control" id="codigo_proceso"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="macroproceso"><i class="bi bi-file-earmark-post-fill iconos-crear"></i>Macroproceso</label>
                                <div class="form-control" id="macroproceso"></div>
                            </div>
                </div>
            </div>


                <div class="col-12">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                        1. ¿ A través de que medio CREAS al interno o RECIBES de un tercero el activo de información?
                    </div>
                    <p style="text-align: center">
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        ¿Creas?
                        </a>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        ¿Recibes?
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                Creación digital
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="1"
                                {{old('creacion',$activos->creacion) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion1">
                                    Aplicación de negocio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="2"
                                {{old('creacion',$activos->creacion) == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Google Workspace
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="3"
                                {{old('creacion',$activos->creacion) == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Paquetería multimedia
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="4"
                                {{old('creacion',$activos->creacion) == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Escaneo
                                </label>
                            </div><br>
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                Creación física
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="5"
                                {{old('creacion',$activos->creacion) == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Manualmente
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapseExample1">
                        <div class="card card-body">
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                    Recepción digital
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="1"
                                {{old('recepcion',$activos->recepcion) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Aplicación de negocio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="2"
                                {{old('recepcion',$activos->recepcion) == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion2">
                                    Mail corporativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion3" value="3"
                                {{old('recepcion',$activos->recepcion) == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Mail personal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="4"
                                {{old('recepcion',$activos->recepcion) == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Carpeta compartida
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="5"
                                {{old('recepcion',$activos->recepcion) == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Medio extraíble
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="6"
                                {{old('recepcion',$activos->recepcion) == '6' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Página web
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="7"
                                {{old('recepcion',$activos->recepcion) == '7' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Vía telefónica
                                </label>
                            </div>
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                Recepción física
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="8"
                                {{old('recepcion',$activos->recepcion) == '8' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                Entrega personal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="9"
                                {{old('recepcion',$activos->recepcion) == '9' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                Mensajería externa
                                </label>
                            </div>

                            <div class="form-check">
                                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="10"
                                    {{old('recepcion',$activos->recepcion) == '10' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="recepcion">Otro
                            </div>
                            {{-- <input type="text" class="form-control"  placeholder="Ingresa el medio de recepción"> --}}
                            <br>
                        </div>
                    </div>


                </div>

                <div class="col-12">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    2. ¿A través de que medio USAS / TRATAS el activo de información?
                    </div>

                    <div class="form-group">
                    <label for="uso_digital">Uso digital</label>
                        <select class="custom-select my-1 mr-sm-2" id="uso_digital" name="uso_digital">
                        <option value='1' {{old('uso_digital',$activos->uso_digital) == '1' ? 'selected' : '' }}>Aplicación de negocio</option>
                        <option value="2" {{old('uso_digital',$activos->uso_digital) == '2' ? 'selected' : '' }}>Google Workspace</option>
                        <option value="3" {{old('uso_digital',$activos->uso_digital) == '3' ? 'selected' : '' }}>Paquetería multimedia</option>
                        <option value="4" {{old('uso_digital',$activos->uso_digital) == '4' ? 'selected' : '' }}>Carpeta compartida</option>
                        </select>
                    </div>

                    {{-- <label for="form-group">"Nombre aplicación(si aplica)"</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                    </div>
                    <label for="formGroupExampleInput">"Nombre carpeta compartida (si aplica)"</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                    </div>
                    <form> --}}
                    <div class="form-group">
                        <label for="nombre_aplicacion">Nombre aplicación (si aplica)</label>
                        <input type="text" class="form-control" id="nombre_aplicacion" name="nombre_aplicacion" placeholder="..." value="{{ old('nombre_aplicacion', $activos->nombre_aplicacion)}}">
                    </div>
                    <div class="form-group">
                        <label for="carpeta_compartida">Nombre carpeta compartida (si aplica)</label>
                        <input type="text" class="form-control" id="carpeta_compartida" name="carpeta_compartida" placeholder="..." value="{{ old('carpeta_compartida', $activos->carpeta_compartida)}}">
                    </div>
                    <div class="form-group">
                        <label for="otra_AppCarpeta">Otra Aplicación/carpeta</label>
                        <input type="text" class="form-control" id="otra_AppCarpeta" name="otra_AppCarpeta" placeholder="..." value="{{ old('otra_AppCarpeta', $activos->otra_AppCarpeta)}}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="uso_fisico">Uso físico</label>
                        <input type="text" class="form-control" id="uso_fisico" name="uso_fisico" placeholder="..." value="{{ old('uso_fisico', $activos->uso_fisico)}}">
                    </div>
                    <div class="form-group">
                        <label for="otro">Otro</label>
                        <input type="text" class="form-control" id="otro" name="otro" placeholder="..." value="{{ old('otro', $activos->otro)}}">
                    </div> --}}


                    <div class="form-group">
                        <label for="imprime">¿Se imprime?</label>
                        <select class="custom-select my-1 mr-sm-2" id="name" name="imprime">
                            <option value="no" {{old('imprime',$activos->imprime) == 'no' ? 'selected' : '' }}>No</option>
                            <option value="si" {{old('imprime',$activos->imprime) == 'si' ? 'selected' : '' }}>Si</option>
                        </select>
                    </div>
                    <div class="form-group col-12 text-right" style="margin-left:15px;" >
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
    </form>
    </div>
</div>




@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function(e) {

        let responsable = document.querySelector('#duenoVP');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_responsable').innerHTML = puesto_init
        document.getElementById('area_responsable').innerHTML = area_init
        let proceso = document.getElementById('proceso_id');

        let custodio = document.querySelector('#custodioALDirector');
        let area_custodio_init = custodio.options[custodio.selectedIndex].getAttribute('data-area');
        let puesto_custodio_init = custodio.options[custodio.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_custodio').innerHTML = puesto_custodio_init
        document.getElementById('area_custodio').innerHTML = area_custodio_init
        document.getElementById('codigo_proceso').innerHTML=proceso.options[proceso.selectedIndex].getAttribute('data-codigo')
        document.getElementById('macroproceso').innerHTML=proceso.options[proceso.selectedIndex].getAttribute('data-macroproceso')




        // let dueno = document.querySelector('#dueno_id');
        // let area = dueno.options[dueno.selectedIndex].getAttribute('data-area');
        // let puesto = dueno.options[dueno.selectedIndex].getAttribute('data-puesto');
        // document.getElementById('puesto_dueno').innerHTML = puesto
        // document.getElementById('area_dueno').innerHTML = area
        proceso.addEventListener('change', function(e) {
            e.preventDefault();
            console.log()
            document.getElementById('codigo_proceso').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-codigo')
            document.getElementById('macroproceso').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-macroproceso')
        })

        responsable.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_responsable').innerHTML = puesto
            document.getElementById('area_responsable').innerHTML = area
        })
        custodio.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_custodio').innerHTML = puesto
            document.getElementById('area_custodio').innerHTML = area
        })

        // dueno.addEventListener('change', function(e) {
        //     e.preventDefault();
        //     let area = this.options[this.selectedIndex].getAttribute('data-area');
        //     let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
        //     document.getElementById('puesto_dueno').innerHTML = puesto
        //     document.getElementById('area_dueno').innerHTML = area
        // })



         document.getElementById('guardar_subcategoria').addEventListener('click', function(e) {
            e.preventDefault();
            let subcategoria = document.querySelector('#subtipo-name').value;
            let categoria_id = document.querySelector('#categoria_id').value;

            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                url: "{{ route('admin.subtipoactivos.store') }}",
                data: {
                    categoria_id,subcategoria, ajax:true
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        document.querySelector('#recipient-name').value = '';
                        $('.selecSubcategoria').select2('destroy');
                        $('.selecSubcategoria').select2({
                            ajax: {
                                url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                                data: {
                                    categoria:1
                                },
                                dataType: "json",
                            },
                            theme: "bootstrap4"
                        });
                        $('#subcategorialec').modal('hide')
                        $('.modal-backdrop').hide();
                        Swal.fire(
                            'Guardada con exito!',
                            '',
                            'success'
                        )
                        const subtipo=response.subtipo
                        // const tipo=response.tipo
                        console.log(subtipo);
                        var option = new Option(subtipo.subcategoria,subtipo.id, true, true);
                        $('.selecSubcategoria').append(option).trigger('change');
                        // var option = new Option(subtipo.categoria_id,subtipo.id, true, true);
                        // $('.selecCategoria').append(option).trigger('change');

                    }
                },
                error: function(request, status, error) {
                    console.log(error)
                    $.each(request.responseJSON.errors, function(indexInArray,

                        valueOfElement) {
                        console.log(valueOfElement, indexInArray);
                        $(`span#${indexInArray}_error`).text(valueOfElement[0]);

                    });
                }
            });
            console.log('Guardando')
        });


         // Script Modelo activos
        document.getElementById('guardar_modelo').addEventListener('click', function(e) {
            e.preventDefault();
            let nombre = document.querySelector('#modelo-name').value;

            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                },
                url: "{{ route('admin.modelos.store') }}",
                data: {
                    nombre
                },
                dataType: "json",
                success: function(response) {
                    $('#modelolec').modal('hide')
                    $('.modal-backdrop').hide();
                    if (response.success) {
                        document.querySelector('#modelo-name').value = '';
                        $('.selecmodelo').select2('destroy');
                        $('.selecmodelo').select2({
                            ajax: {
                                url: "{{ route('admin.modelos.getModelos') }}",
                                dataType: "json",
                            },
                            theme: "bootstrap4"
                        });

                        Swal.fire(
                            'Guardada con exito!',
                            '',
                            'success'
                        )
                        const modelo=response.modelo
                        console.log(modelo);
                        var option = new Option(modelo.nombre,modelo.id, true, true);
                        $('.selecmodelo').append(option).trigger('change');

                    }


                },
                error: function(request, status, error) {
                    console.log(error)
                    $.each(request.responseJSON.errors, function(indexInArray,

                        valueOfElement) {
                        console.log(valueOfElement, indexInArray);
                        $(`span#${indexInArray}_error`).text(valueOfElement[0]);

                    });
                }
            });
            console.log('Guardando')
        });

    })

    $(document).ready(function() {
        $('.selecmarca').select2({
            ajax: {
                url: "{{ route('admin.marcas.getMarcas') }}",
                dataType: "json",
            },
            theme: "bootstrap4"
        });


        $('.selecmodelo').select2({
            ajax: {
                url: "{{ route('admin.modelos.getModelos') }}",
                dataType: "json",
            },
            theme: "bootstrap4"
        });


        $('.selecCategoria').select2({
            ajax: {
                url: "{{ route('admin.tipoactivos.getTipos') }}",
                dataType: "json",
            },
            theme: "bootstrap4"
        });
        $('.selecSubcategoria').select2({
            ajax: {
                url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                data:{categoria:1},
                dataType: "json",
            },
            theme: "bootstrap4"
        });
        $('.selecCategoria').on('select2:select', function (e) {
            var data = e.params.data; console.log(data);
            $('.selecSubcategoria').select2({
            ajax: {
                url: "{{ route('admin.subtipoactivos.getSubtipos') }}",
                data:{categoria:data.id},
                dataType: "json",
            },
            theme: "bootstrap4"
        });
          });

    });

    // $('.selecCategoria').val('1');
    // $('.selecCategoria').trigger('changue');



</script>



@endsection

