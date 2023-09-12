@extends('layouts.admin')



@section('content')

<h5 class="col-12 titulo_general_funcion">Categorías</h5>

<div class="d-flex justify-content-end mb-3">

    <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.create') }}" style="background-color: #345183; width: 150px; white-space: nowrap;">NUEVA CATEGORÍA &nbsp; +</a>

</div>

<div class="card">

    <div class="card-body">

        <table class="table table-bordered w-100 datatable datatable-Role" id="tblCategories">

            <thead>

                <tr style="background-color: #345183; color: white;">

                    <th style="background-color: #345183;">ID</th>

                    <th style="background-color: #345183;">Nombre</th>

                    <th style="background-color: #345183;">Opciones</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($categories as $category)

                <tr>

                    <td>

                        {{$category->id}}

                    </td>

                    <td>

                        {{$category->name}}

                    </td>

                    <td class="d-flex justify-content-end mr-3">

                        <a class="btn" href="{{route('admin.categories.edit', $category)}}"><i style="font-size:12pt; color:#000" class="fas fa-edit" title="Editar"></i></a>
                        <form style="display:inline-block" action="{{route('admin.categories.destroy', $category)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" type="submit"><i style="font-size:12pt;" class="fa-regular fa-trash-can"  data-toggle="tooltip" data-placement="top" title="Eliminar"></i></button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection



@section('scripts')

    @parent

    <script>

        $(document).ready(function() {

            let tblCategories = $("#tblCategories").DataTable({

                buttons: [],

            });

        });

    </script>

@endsection
