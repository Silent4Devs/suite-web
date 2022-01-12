@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Competencias-Create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Competencia</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form id="formCompetenciaCreate" method="POST" action="{{ route('admin.ev360-competencias.store') }}"
                class="mt-3" enctype="multipart/form-data">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.competencias._form')
                <div class="w-100">
                    <div class="d-flex justify-content-end w-100">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button type="submit" class="ml-2 btn btn-danger">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.form-control-file').on('change', function(e) {
            let inputFile = e.currentTarget;
            console.log('si')
            $("#texto-imagen").text(inputFile.files[0].name);
            // Imagen previa
            var reader = new FileReader();
            reader.readAsDataURL(inputFile.files[0]);
            reader.onload = function(e) {
                document.getElementById('uploadPreview').src = e.target.result;
            };
        });
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

        document.addEventListener('DOMContentLoaded', function() {
            var headers = {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json',
                'Access-Control-Allow-Origin': 'https://api.flaticon.com/v2'
            };


            // (async () => {
            //     const rawResponse = await fetch('https://api.flaticon.com/v2/app/authentication', {
            //         method: 'POST',
            //         headers: {
            //             'Accept': 'application/json',
            //             'Content-Type': 'multipart/form-data'
            //         },
            //         body: JSON.stringify({
            //             apikey: 'b4637afbcac328a8c4c535ccf8f67f636bad145e'
            //         })
            //     });
            //     const content = await rawResponse.json();

            //     console.log(content);
            // })();
        })
    </script>
@endsection
