
<div class="row">
    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-file-signature iconos-crear"></i>{!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', old("nombre",$calendario->nombre), ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>
    <!-- Fecha inicio Field -->
    @php
      if($calendario->fecha){
        $fecha=explode("-",$calendario->fecha);
        $startDate=$fecha[0];
        $endDate=$fecha[1];
      }else {
        $startDate=now();
        $endDate=now();
      }
    @endphp
    <div class="form-group col-sm-6">
        <label for="fecha"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha</label>
        <input type="text" id="fecha" name="fecha" class="form-control">
        <script>$('#fecha').daterangepicker({
            startDate:moment(@json($startDate)),
            endDate:moment(@json($endDate))
        });</script>
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-th-list iconos-crear"></i>{!! Form::label('categoria', 'Categoría:') !!}
        {!! Form::text('categoria', old("nombre",$calendario->categoria), ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}
        {!! Form::text('descripcion',old("nombre",$calendario->descripcion), ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Submit Field -->
   <div class="text-right form-group col-12">
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>
