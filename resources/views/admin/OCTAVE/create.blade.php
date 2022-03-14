@extends('layouts.admin')
@section('content')

<style>
    .select2-results__option {
        position: relative;
        padding-left: 30px !important;

    }

    .select2-results__option:nth-child(2)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(61, 114, 77);
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="1"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(61, 114, 77);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(3)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63);
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="2"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(4)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: yellow;
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="3"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: yellow;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(5)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(255, 136, 0);
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="4"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(255, 136, 0);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-results__option:nth-child(6)::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: red;
        margin-left: -20px;
        border-radius: 100px;
        margin-top: 6px;
    }

    .select2-selection__rendered[title="5"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: red;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered {
        padding-left: 30px !important;


    }

    .select2-selection__rendered[title="Bajo"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(50, 205, 63);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Medio"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: yellow;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Alto"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(255, 136, 0);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Crítico"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: red;
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

    .select2-selection__rendered[title="Muy Bajo"]::before {
        position: absolute;
        content: '';
        width: 10px;
        height: 10px;
        background-color: rgb(61, 114, 77);
        margin-left: -18px;
        border-radius: 100px;
        margin-top: 11px;
    }

</style>

<div class="mt-5 card">
    <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Matriz Octave</h3>
    </div>
    <div class="card-body">


            @include('admin.OCTAVE.menu')



    </div>



</div>


@endsection


@section('scripts')
<script type="text/javascript">
    Livewire.on('planStore', () => {
        $('#planAccionModal').modal('hide');
        $('.modal-backdrop').hide();
        toastr.success('Plan de Acción creado con éxito');
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
