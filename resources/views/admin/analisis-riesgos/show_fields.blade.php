<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $analisis->nombre }}</p>
</div>

<!-- Categoria Field -->
<div class="form-group">
    {!! Form::label('tipo', 'Tipo:') !!}
    <p>{{ $analisis->tipo }}</p>
</div>

<!-- Descripcion Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{{ $analisis->fecha }}</p>
</div>

<div class="form-group">
    {!! Form::label('porcentaje_implementacion', 'Porcentaje Implementación:') !!}
    <p>{{ $analisis->porcentaje_implementacion }}</p>
</div>

<div class="form-group">
    {!! Form::label('id_elaboracion', 'Elaboro:') !!}
    <p>{{ $analisis->empleado->name }}</p>
</div>

<div class="form-group">
    {!! Form::label('id_elaboracion', 'Elaboro:') !!}
    <p>{{ $analisis->empleado->name }}</p>
</div>

<div class="form-group">
    {!! Form::label('estatus', 'Estatus:') !!}
    @if ($analisis->estatus == 1)
        <p>Válido</p>
    @else
        <p>Obsoleto</p>
    @endif

</div>
