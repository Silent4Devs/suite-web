@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Competencias-Create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Competencia </h3>
        </div>
        <div class="card-body">
            <form id="formCompetenciaCreate" method="POST" action="{{ route('admin.ev360-competencias.store') }}"
                class="mt-3 row">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.competencias._form')
                <div class="d-flex justify-content-end w-100">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Guardar</button>
                    <button type="submit"
                        onclick="event.preventDefault();Conductas('{{ route('admin.ev360-competencias.conductas') }}')"
                        class="btn btn-danger">Conductas<i class="ml-1 fas fa-arrow-right"></i></button>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        window.Conductas = function(url) {
            Swal.fire({
                title: '¿Quieres Agregar Conductas?',
                text: "¡Serás redireccionado!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si!',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: url,
                        data: $("#formCompetenciaCreate").serialize(),
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {

                            }
                        }
                    });

                }
            })

        }

        Livewire.on('tipoCompetenciaStore', () => {
            $('#tipoCompetenciaModal').modal('hide');
            $('.modal-backdrop').hide();
            toastr.success('Tipo de competencia creado con éxito');
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
