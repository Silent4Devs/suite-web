@extends('layouts.admin')
@section('content')


<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2>Lista de Empleados</h2>
            </div>
            <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ url('empleados/imprimir') }}" >Imprimir</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <caption>Lista de Empleados</caption>
                    <thead>
                      <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Núm. de registro</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Antiguedad</th>
                        <th scope="col">Estatus</th>
                      </tr>
                    </thead>
                    {{-- {{$visualizarEmpleados}} --}}
                    <tbody>
                        @foreach ($Empleados as $Empleado)
                        <tr>
                            <th scope="row">{{ $Empleado->name }}</th>
                            <td>{{ $Empleado->n_registro }}</td>
                            <td>{{ $Empleado->puesto }}</td>
                            <td>{{ $Empleado->antiguedad }}</td>
                            <td>{{ $Empleado->estatus }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</body>

@endsection