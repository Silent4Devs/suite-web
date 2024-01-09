<script rel="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>

<!--<span class="card-title">Agregar factura</span>-->

{{-- <div class="col s12">
    <div class="form-group diseño-titulo">
        <p class="center-align white-text" style="font-size:13pt;">AGREGAR FACTURA</p>
    </div>
</div> --}}

{{-- <div class="card card-content row"> --}}
<h4 class="sub-titulo-form col s12">AGREGAR FACTURA</h4>

<form wire:submit="store" enctype="multipart/form-data">

    @include('livewire.factura.form')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/botones.css') }}">


    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>

</form>
{{-- </div> --}}
