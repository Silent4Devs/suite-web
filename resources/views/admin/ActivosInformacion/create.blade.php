@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Activo de Información</h5>
<div class="mt-4 card">


    <div class="col-12">

            <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                Información General
            </div>
        <div class="row">
            <div class="form-group col-sm-3">
                <label for="banco"><i class="fas fa-list-ol iconos-crear"></i>ID</label>
                <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="banco" id="banco">
                <small id="error_banco" class="text-danger"></small>
            </div>
        </div>

        <div class="row">
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
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Dueño AI</label>
                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                    name="id_responsable" id="id_responsable">
                    @foreach ($empleados as $empleado)
                        <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                            data-area="{{ $empleado->area->area }}">

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
            <div class="form-group col-md-4">
                <label for="id_custodio"><i class="fas fa-user-tie iconos-crear"></i>Custodio AI Nombre Director</label>
                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                    name="id_custodio" id="id_custodio">
                    @foreach ($empleados as $empleado)
                        <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                            data-area="{{ $empleado->area->area }}">

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
            <label for="cuenta_bancaria"><i class="fas fa-folder-plus iconos-crear"></i>Activo de información</label>
            <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
                name="cuenta_bancaria" id="cuenta_bancaria">
        </div>
        <div class="form-group col-sm-12">
            <label for="cuenta_bancaria"><i class="fas fa-file-contract iconos-crear"></i>Formato</label>
            <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
                name="cuenta_bancaria" id="cuenta_bancaria">
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
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Aplicación de negocio
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                    <label class="form-check-label" for="exampleRadios2">
                        Google Workspace
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                    <label class="form-check-label" for="exampleRadios3">
                        Paquetería multimedia
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
                    <label class="form-check-label" for="exampleRadios4">
                        Escaneo
                    </label>
                  </div><br>
                  <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                    Creación física
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="option5">
                    <label class="form-check-label" for="exampleRadios5">
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
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion1" value="option1" checked>
                    <label class="form-check-label" for="recepcion1">
                        Aplicación de negocio
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion2" value="option2">
                    <label class="form-check-label" for="recepcion2">
                        Mail corporativo
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion3" value="option3">
                    <label class="form-check-label" for="recepcion3">
                        Mail personal
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion4" value="option4">
                    <label class="form-check-label" for="recepcion4">
                        Carpeta compartida
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion5" value="option5">
                    <label class="form-check-label" for="recepcion5">
                        Medio extraíble
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion6" value="option6">
                    <label class="form-check-label" for="recepcion6">
                        Página web
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion7" value="option7">
                    <label class="form-check-label" for="recepcion7">
                        Vía telefónica
                    </label>
                  </div>
                  <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                    Recepción física
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion8" value="option8">
                    <label class="form-check-label" for="recepcion8">
                    Entrega personal
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion9" value="option9">
                    <label class="form-check-label" for="recepcion9">
                    Mensajería externa
                    </label>
                  </div>

                  <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion9" value="option9">
                        <label class="form-check-label" for="recepcion9">Otro
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
          <label for="exampleFormControlSelect2">Uso digital</label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
              <option selected>Aplicación de negocio</option>
              <option value="1">Google Workspace</option>
              <option value="2">Paquetería multimedia</option>
              <option value="3">Carpeta compartida</option>
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
            <label for="formGroupExampleInput">Nombre aplicación (si aplica)</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="...">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Nombre carpeta compartida (si aplica)</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="...">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput">Otra Aplicación/carpeta</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="...">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Uso físico</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="...">
          </div>
          <div class="form-group">
            <label for="formGroupExampleInput2">Otro</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="...">
          </div>
        </form>

        <div class="form-group">
            <label for="exampleFormControlSelect2">¿Se imprime?</label>
              <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option selected>No</option>
                <option value="1">Si</option>
              </select>
          </div>
      </form>




    </div>



</div>




@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function(e) {

        let responsable = document.querySelector('#id_responsable');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_responsable').innerHTML = puesto_init
        document.getElementById('area_responsable').innerHTML = area_init

        let custodio = document.querySelector('#id_custodio');
        let area_custodio_init = custodio.options[custodio.selectedIndex].getAttribute('data-area');
        let puesto_custodio_init = custodio.options[custodio.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_custodio').innerHTML = puesto_custodio_init
        document.getElementById('area_custodio').innerHTML = area_custodio_init



        let dueno = document.querySelector('#dueno_id');
        let area = dueno.options[dueno.selectedIndex].getAttribute('data-area');
        let puesto = dueno.options[dueno.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_dueno').innerHTML = puesto
        document.getElementById('area_dueno').innerHTML = area



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

        dueno.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_dueno').innerHTML = puesto
            document.getElementById('area_dueno').innerHTML = area
        })

         // Script Marca activos

        // Script categoria activos

         // Script subcategoria activos

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

