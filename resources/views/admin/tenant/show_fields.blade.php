<!-- Nombre Field -->
<div class="form-group">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $tenant->nombre }}</p>
</div>

<!-- Categoria Field -->
<div class="form-group">
    {!! Form::label('categoria', 'Categoria:') !!}
    <p>{{ $tenant->categoria }}</p>
</div>

<!-- Descripcion Field -->
<div class="form-group">
    {!! Form::label('descripcion', 'Descripción:') !!}
    <p>{{ $tenant->descripcion }}</p>
</div>

