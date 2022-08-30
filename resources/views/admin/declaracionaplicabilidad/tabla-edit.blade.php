@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Control</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.declaracion-aplicabilidad.updateTabla', $control) }}">
                @method('PUT')
                @csrf
                @include('admin.declaracionaplicabilidad._form-tabla')

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ route('admin.declaracion-aplicabilidad.tabla') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        let contacto = document.querySelector('#nombre_contacto_puesto');
        let puesto_init = contacto.options[contacto.selectedIndex].getAttribute('data-puesto');

        document.getElementById('contacto_puesto').innerHTML = puesto_init;
        contacto.addEventListener('change', function(e) {
            e.preventDefault();
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('contacto_puesto').innerHTML = puesto;
        })

        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("foto_area").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    })
</script>
