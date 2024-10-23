<!-- Nombre Field -->
<div class="form-group">
    <label for="nombre">Nombre:</label>
    <p>{{ $vulnerabilidad->nombre }}</p>
</div>

<!-- Descripción Field -->
<div class="form-group">
    <label for="descripcion">Descripción:</label>
    <p>{{ $vulnerabilidad->descripcion }}</p>
</div>

<!-- Id Amenaza Field -->
<div class="form-group">
    <label for="id_amenaza">Amenaza:</label>
    <p>{{ $vulnerabilidad->idAmenaza->nombre }}</p>
</div>
