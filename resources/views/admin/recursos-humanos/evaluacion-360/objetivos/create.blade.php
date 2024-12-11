@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('EV360-Objetivos-Create') }}

    <div class="mt-4 card">
        <h5 class="col-12 titulo_general_funcion">Registrar: Objetivo</h5>
        <div class="card-body">
            <form id="formObjetivoCreate" method="POST" action="{{ route('admin.ev360-objetivos.index') }}" class="mt-3 row">
                @csrf
                @include('admin.recursos-humanos.evaluacion-360.objetivos._form')
                <div class="d-flex justify-content-end w-100">
                    <a href="{{ route('admin.ev360-objetivos.index') }}" class="btn btn-outline-primary">Regresar</a>
                    {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
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
            Swal.fire({
            title: 'Tipo de objetivo',
            text: "Ha sido registrado correctamente",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
        });
        Livewire.on('metricaObjetivoStore', () => {
            $('#metricaObjetivoModal').modal('hide');
            $('.modal-backdrop').hide();
            Swal.fire({
            title: 'Métrica del objetivo',
            text: "Ha sido registrado correctamente",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
            });
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
