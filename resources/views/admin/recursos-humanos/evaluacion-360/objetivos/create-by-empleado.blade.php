@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Objetivos-Create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Objetivo </h3>
        </div>
        <div class="card-body">
            <form id="formObjetivoCreate" method="POST" action="{{ route('admin.ev360-objetivos.index') }}"
                class="mt-3 row">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.objetivos._form_by_empleado')
                <div class="d-flex justify-content-end w-100">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            let dtButtons = [];

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: "{{ route('admin.ev360-objetivos-empleado.create', $empleado->id) }}",
                columns: [{
                    data: 'objetivo.nombre'
                }, {
                    data: 'objetivo.tipo.nombre',
                }, {
                    data: 'objetivo.KPI',
                }, {
                    data: 'objetivo.meta',
                }, {
                    data: 'objetivo.metrica.definicion',
                }, {
                    data: 'objetivo.descripcion_meta',
                }],
                order: [
                    [1, 'asc']
                ]
            };
            window.tblObjetivos = $('.tblObjetivos').DataTable(dtOverrideGlobals);
        });
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById('BtnAgregarObjetivo').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                // let formData = new FormData(document.getElementById('formObjetivoCreate'));
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.ev360-objetivos-empleado.store', $empleado->id) }}",
                    data: $('#formObjetivoCreate').serialize(),
                    beforeSend: function() {
                        toastr.info('Asignando el objetivo');
                    },
                    success: function(response) {
                        if (response.success) {
                            tblObjetivos.ajax.reload();
                            toastr.success('Objetivo asignado');
                            document.getElementById('formObjetivoCreate').reset();
                        }
                    },
                    error: function(request, status, error) {
                        $.each(request.responseJSON.errors, function(indexInArray,
                            valueOfElement) {
                            console.log(valueOfElement, indexInArray);
                            $(`span.${indexInArray}_error`).text(valueOfElement[0]);

                        });
                    }
                });
            });
        })

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errors');
            errores.forEach(element => {
                element.innerHTML = "";
            });
        }

        Livewire.on('tipoObjetivoStore', () => {
            $('#tipoObjetivoModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Tipo de objetivo creado con éxito');
        });
        Livewire.on('metricaObjetivoStore', () => {
            $('#metricaObjetivoModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Métrica del objetivo creada con éxito');
        });
        window.initSelect2 = () => {
            $('.select2').select2({
                'theme': 'bootstrap4'
            });
        }

        initSelect2();

        Livewire.on('select2', () => {
            initSelect2();
        });
    </script>
@endsection
