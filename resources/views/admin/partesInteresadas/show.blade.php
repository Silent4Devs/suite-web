@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.partes-interesadas.create') }}

    <div class="card">
        <div class="card-header">
            Detalles
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.partes-interesadas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.partesInteresada.fields.id') }}
                            </th>
                            <td>
                                {{ $partesInteresada->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.partesInteresada.fields.parteinteresada') }}
                            </th>
                            <td>
                                {{ $partesInteresada->parteinteresada }}
                            </td>
                        </tr>
                    </tbody>
                </table>


                @if ($result == false)
                    <div class=" bg-warning col-12">
                        <p class="card-text" style="color:black; text-align:center">Esta parte interesada aún no
                            registra Necesidades /Expectativas
                        </p>
                    </div><br>
                @else
                    <div class="form-group col-12">
                        <p class="text-center text-light p-1" style="background-color:#345183; border-radius: 100px;">
                            Requisitos</p>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="min-width:250px; color:black;">Necesidad</th>
                                <th scope="col" style="min-width:250px;  color:black;">Expectativa</th>
                                <th scope="col" style="min-width:200px;  color:black;">Norma</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requisitos as $requisito)
                                <tr>
                                    <td>{{ $requisito->necesidades }}</td>
                                    <td>{{ $requisito->expectativas }}</td>
                                    <td>
                                        @if (count($requisito->normas) > 0)
                                            @foreach ($requisito->normas as $item)
                                                <li>{{ $item->norma }}</li>
                                            @endforeach
                                        @else
                                            Sin definir
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @endif
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.partes-interesadas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
