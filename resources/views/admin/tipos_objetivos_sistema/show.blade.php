@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('admin.objetivosseguridads.create') }} --}}

    <div class="card">
        <div class="card-header">
            Tipos de Objetivos de Sistema
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.objetivosseguridads.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <td>
                                {{ $tiposObjetivosSistema->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Descripción
                            </th>
                            <td>
                                {!! $tiposObjetivosSistema->descripcion ?? 'Sin descripción' !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.tipos-objetivos.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
