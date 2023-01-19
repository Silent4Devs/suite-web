@extends('layouts.admin')
@section('content')

<h5 class="col-12 titulo_general_funcion">Tabla de Impactos</h5>
<div class="mt-5 card">
    <div class="card-body datatable-fix">
        <div class="col-sm-11 col-md-11">

            {{-- @livewire('puesto-select',['puestos_seleccionado'=>$puestos_seleccionado]) --}}
        </div>

        @livewire('tabla-impacto')



    </div>

</div>

@endsection


@section('scripts')
    <script>
        document.getElementById('guardar_nivel').addEventListener('click', function(e) {
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
                $('#niveleslec').modal('hide')
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
    </script>
@endsection
