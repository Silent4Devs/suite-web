<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $vulnerabilidad->nombre }}</p>
</div>

<!-- Descripcion Field -->
<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{{ $vulnerabilidad->descripcion }}</p>
</div>

<!-- Id Amenaza Field -->
<div class="form-group">
    {!! Form::label('id_amenaza', 'Amenaza:') !!}
    <p>{{ $vulnerabilidad->idAmenaza->nombre }}</p>
</div>

