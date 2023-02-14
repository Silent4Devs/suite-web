<div class="form-group col-sm-12 col-md-12 col-lg-12">
    <label class="required" for="analisis required"><i class="fas fa-file-invoice iconos-crear"></i>Nombre del Análisis</label>
    <input required class="form-control" type="text" name="analisis" id="analisis"
        value="{{ old('analisis', $entendimientoOrganizacion->analisis) }}">
    @if ($errors->has('analisis'))
        <div class="invalid-feedback  d-block">
            {{ $errors->first('analisis') }}
        </div>
    @endif
</div>

<div class="form-group col-sm-12 col-md-6 col-lg-6">
    <label class="required" for="fecha"> <i class="fas fa-calendar-alt iconos-crear"></i> Fecha de Creación</label>
    <input required class="form-control" type="date" id="fecha" name="fecha"
        value="{{ old('fecha', $entendimientoOrganizacion->fecha) }}">
    @if ($errors->has('fecha'))
        <div class="invalid-feedback  d-block">
            {{ $errors->first('fecha') }}
        </div>
    @endif
</div>



<div class="form-group col-sm-12 col-md-6 col-lg-6">
    <label class="required" for="id_elabora"><i class="fas fa-user-tie iconos-crear"></i>Realizó</label>
    <select required class="form-control  {{ $errors->has(' id_elabora') ? 'is-invalid' : '' }}" name="id_elabora"
        id="id_elabora">
        <option value="">Seleccione una opción</option>
        @foreach ($empleados as $empleado)
            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                data-area="{{ $empleado->area->area }}"
                {{ old('id_elabora', $entendimientoOrganizacion->id_elabora) == $empleado->id ? 'selected' : '' }}>
                {{ $empleado->name }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('id_elabora'))
        <div class="invalid-feedback">
            {{ $errors->first('id_elabora') }}
        </div>
    @endif
</div>


<div class="form-group col-md-6">
    <label for="id_puesto_asignada"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
    <div class="form-control" id="puesto_asignada" readonly></div>

</div>


<div class="form-group col-sm-12 col-md-6 col-lg-6">
    <label for="id_area_asignada"><i class="fas fa-street-view iconos-crear"></i>Área</label>
    <div class="form-control" id="area_asignada" readonly></div>

</div>


<div class="mb-4 ml-4 w-100" style="border-bottom: solid 2px #345183;">
    <span class="ml-1" style="font-size: 17px; font-weight: bold;">
        Participantes</span>
</div>

<div class="pl-3 row w-100">
    <div class="form-group col-sm-12 col-md-12 col-lg-6">
        <label for="participantes"><i class="fas fa-search iconos-crear"></i>Buscar
            participante<span class="text-danger">*</span></label>
        <input type="hidden" id="id_empleado">
        <input class="form-control" type="text" id="participantes_search" placeholder="Busca un empleado"
            style="position: relative" autocomplete="off" />
        <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
            style="position: absolute; top: 43px; right: 25px;"></i>
        <div id="participantes_sugeridos"></div>
        @if ($errors->has('participantes'))
            <span class="text-danger">
                {{ $errors->first('participantes') }}
            </span>
        @endif
        <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
    </div>
    <div class="form-group col-sm-12 col-md-12 col-lg-6">
        <label for="email"><i class="fas fa-at iconos-crear"></i>Email</label>
        <input class="form-control" type="text" id="email" placeholder="Correo del participante" readonly
            style="cursor: not-allowed" />
    </div>
    <div class="form-group col-sm-12 col-md-12 col-lg-6">
        <label for="email"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
        <input class="form-control" type="text" id="puesto" placeholder="Puesto del participante" readonly
            style="cursor: not-allowed" />
    </div>
    <div class="form-group col-sm-12 col-md-12 col-lg-6">
        <label for="area"><i class="fas fa-user-tag iconos-crear"></i></i>Área</label>
        <input class="form-control" type="text" id="area" placeholder="Área del participante" readonly
            style="cursor: not-allowed" />
    </div>
</div>
<div class="col-12">
    <button id="btn-suscribir-participante" type="submit" class="mr-3 btn btn-sm btn-outline-success"
        style="float: right; position: relative;">
        <i class="mr-1 fas fa-plus-circle"></i>
        Agregar Participante
    </button>
</div>
<div class="mt-3 col-12 w-100 datatable-fix">
    <table class="table w-100" id="tbl-participantes">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Puesto</th>
                {{-- <th scope="col">Área</th> --}}
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @if ($isEdit)
                @foreach ($entendimientoOrganizacion->participantes as $participante)
                    <tr>
                        <td>{{ $participante->id }}</td>
                        <td>{{ $participante->name }}</td>
                        <td>{{ $participante->puesto }}</td>
                        <td>{{ $participante->email }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<input type="hidden" name="participantes" value="" id="participantes">

@if ($isEdit)
    @livewire('fortalezas-component', ['foda_id' => $entendimientoOrganizacion->id])

    @livewire('oportunidades-component', ['foda_id' => $entendimientoOrganizacion->id])

    @livewire('debilidades-component', ['foda_id' => $entendimientoOrganizacion->id])

    @livewire('amenazas-component', ['foda_id' => $entendimientoOrganizacion->id])
@endif

<div class="text-right form-group col-12"><br>
    <a href="{{ route('admin.entendimiento-organizacions.index') }}" class="btn_cancelar">Cancelar</a>
    <button id="btnGuardar" class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {

            let asignado = document.querySelector('#id_elabora');
            let area_init = asignado.options[asignado.selectedIndex].getAttribute('data-area');
            let puesto_init = asignado.options[asignado.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_asignada').innerHTML = recortarTexto(puesto_init);
            document.getElementById('area_asignada').innerHTML = recortarTexto(area_init);
            asignado.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_asignada').innerHTML = recortarTexto(puesto);
                document.getElementById('area_asignada').innerHTML = recortarTexto(area);
            })

            function recortarTexto(texto, length = 40)
            {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }

        });
    </script>

    <script>
        $(document).ready(function() {

            window.tblParticipantes = $('#tbl-participantes').DataTable({
                buttons: []
            })
            $("#cargando_participantes").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = "{{ route('admin.empleados.get') }}";
            $("#participantes_search").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'nombre=' + $(this).val(),
                    beforeSend: function() {
                        $("#cargando_participantes").show();
                    },
                    success: function(data) {
                        let lista = "<ul class='list-group id=empleados-lista' >";
                        $.each(data.usuarios, function(ind, usuario) {
                            var result = `{"id":"${usuario.id}",
                            "name":"${usuario.name}",
                            "email":"${usuario.email}",
                            "puesto":"${usuario.puesto}",
                            "area":"${usuario.area.area}"
                            }`;
                            lista +=
                                "<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action' onClick='seleccionarUsuario(" +
                                result + ")' ><i class='mr-2 fas fa-user-circle'></i>" +
                                usuario.name + "</button>";
                        });
                        lista += "</ul>";

                        $("#cargando_participantes").hide();
                        $("#participantes_sugeridos").show();
                        let sugeridos = document.querySelector("#participantes_sugeridos");
                        sugeridos.innerHTML = lista;
                        $("#participantes_search").css("background", "#FFF");
                    }
                });

            });

            document.getElementById('btn-suscribir-participante').addEventListener('click', function(e) {
                e.preventDefault();
                suscribirParticipante()
            })

            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                // e.preventDefault();
                enviarParticipantes();
            })

        });

        function seleccionarUsuario(user) {
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#puesto").val(user.puesto);
            $("#area").val(user.area);
            $("#participantes_sugeridos").hide();
        }


        function suscribirParticipante() {
            //form-participantes

            let participantes = tblParticipantes.rows().data().toArray();
            // console.log(tblParticipantes.rows().data().toArray());
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])
            });

            let id_empleado = $("#id_empleado").val();
            if (id_empleado == '') {
                Swal.fire('Debes de buscar un empleado', '', 'info')
            } else {
                if (!arrParticipantes.includes(id_empleado)) {
                    let nombre = $("#participantes_search").val();
                    let puesto = $("#puesto").val();
                    let email = $("#email").val();
                    let area = $("#area").val();
                    tblParticipantes.row.add([
                        id_empleado,
                        nombre,
                        puesto,
                        email,
                        area,
                    ]).draw();

                } else {
                    Swal.fire('Este participante ya ha sido agregado', '', 'error')
                }

                $("#participantes_search").val('');
                $("#id_empleado").val('');
                $("#email").val('');
                $("#puesto").val('');
                $("#area").val('');
            }
        }

        function enviarParticipantes() {
            let participantes = tblParticipantes.rows().data().toArray();
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])

            });
            console.log(arrParticipantes);
            document.getElementById('participantes').value = arrParticipantes;
        }
    </script>


@endsection
