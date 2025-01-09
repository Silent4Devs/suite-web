@extends('layouts.admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clausulas</title>
</head>
<body>
    <form action="{{ route('contract_manager.orden-compra.clausulas-save') }}" method="POST">
        @csrf
        <label for="nombre">Clausula:</label>
        <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Escribe aquí..." style="width: 100%; height: 400px;">{{ $clausulas->descripcion ?? null }}</textarea>
        <br>
        <div style="margin-top: 10px; text-align: right;">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</body>
</html>
@endsection
