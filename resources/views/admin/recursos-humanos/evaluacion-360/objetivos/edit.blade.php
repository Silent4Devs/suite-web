@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Objetivos-Edit') }}
    <h5 class="col-12 titulo_general_funcion">Editar: Objetivo</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form id="formObjetivoCreate" method="POST" action="{{ route('admin.ev360-objetivos.index') }}"
                class="mt-3 row">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.objetivos._form')
                <div class="d-flex justify-content-end w-100">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
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
