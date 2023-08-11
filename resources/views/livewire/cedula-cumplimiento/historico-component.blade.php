@extends('layouts.app')
@section('content')
@section('titulo', 'Histórico cédula de cumplimiento')
    <div class="row">
        <div class="col s12 m12">
            <div class="card">
                <div class="card-content">
                    <section class="content-header">
                        <span class="card-title">
                        </span>
                        {{-- <div class='btn-group'>
                            <a class="right btn waves-effect waves-light btn-redondeado"
                                style=" margin: 13px 12px 12px 10px; " href="{{ route('usuarios.create') }}" type="submit"
                                name="action">Nuevo<i class="material-icons right">add</i></a>
                        </div> --}}

                    </section>
                    <div class="content">
                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row">
                                    @if (count($items_historico) > 0)
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Elaboró</th>
                                                    <th>Revisó</th>
                                                    <th>Autorizó</th>
                                                    <th>Cumple</th>
                                                    <th>Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items_historico as $item_historico)
                                                    <tr>
                                                        <td><i class="fas fa-user-edit"></i>
                                                            {{ $item_historico->elaboro }}
                                                        </td>
                                                        <td><i class="fas fa-user-clock"></i>
                                                            {{ $item_historico->reviso }}
                                                        </td>
                                                        <td><i class="fas fa-user-shield"></i>
                                                            {{ $item_historico->autorizo }}</td>
                                                        <td>
                                                            @if ($item_historico->cumple == '1')
                                                                <div style="display: flex; align-items: center">
                                                                    <i class="material-icons green-text">check</i>
                                                                    <span>Cumple</span>
                                                                </div>
                                                            @else
                                                                <div style="display: flex; align-items: center">
                                                                    <i class="material-icons red-text">close</i>
                                                                    <span> No cumple</span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item_historico->updated_at != null)
                                                                <i class="fas fa-calendar-alt"></i>
                                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item_historico->updated_at)->format('d-m-Y g:i A') }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            {{-- <tfoot>
                                            <tr>
                                                <th>Elaboró</th>
                                                <th>Revisó</th>
                                                <th>Autorizó</th>
                                                <th>Cumple</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </tfoot> --}}
                                        </table>
                                        {{ $items_historico->links('pagination-tradicional-materializecss') }}
                                    @else
                                        <div style="background-color: #09996b;padding: 15px;
                                                                    margin-bottom: 20px;
                                                                    border: 1px solid transparent;
                                                                    color: white;
                                                                    border-radius: 4px;
                                                                    font-size: 18px">
                                            <strong>Sin Novedades!</strong> La cédula de cumplimiento no ha sufrido
                                            modificaciones
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-center">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection


{{-- <style>
    .modal {
        background-color: #fff;
    }

    .modal.modal-fixed-header {
        padding: 0;
    }

    .modal.modal-fixed-header .modal-header {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 0;
    }

    .modal.modal-fixed-header .modal-header {
        padding: 10px;
        height: 56px;
        width: 100%;
    }

    .modal.modal-fixed-header .modal-content {
        position: absolute;
        top: 56px;
        max-height: 100%;
        width: 100%;
        overflow-y: auto;
    }

</style>
<div id="modal_historico" class="modal modal-fixed-footer">

    <div class="modal-content">
        <h4><i class="fas fa-history"></i> Historico de la cédula de cumplimiento</h4>
        <table>
            <thead>
                <tr>
                    <th>Elaboró</th>
                    <th>Revisó</th>
                    <th>Autorizó</th>
                    <th>Cumple</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items_historico as $item_historico)
                    <tr>
                        <td><i class="fas fa-user-edit"></i> {{ $item_historico->elaboro }}</td>
                        <td><i class="fas fa-user-clock"></i> {{ $item_historico->reviso }}</td>
                        <td><i class="fas fa-user-shield"></i> {{ $item_historico->autorizo }}</td>
                        <td>
                            @if ($item_historico->cumple == '1')
                                <div style="display: flex; align-items: center">
                                    <i class="material-icons green-text">check</i>
                                    <span>Cumple</span>
                                </div>
                            @else
                                <div style="display: flex; align-items: center">
                                    <i class="material-icons red-text">close</i>
                                    <span> No cumple</span>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($item_historico->updated_at != null)
                                <i class="fas fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item_historico->updated_at)->format('d-m-Y g:i A') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Elaboró</th>
                    <th>Revisó</th>
                    <th>Autorizó</th>
                    <th>Cumple</th>
                    <th>Fecha</th>
                </tr>
            </tfoot>
        </table>

        <br>
        {{-- {{ $items_historico->links('pagination-materializecss') }}     </div>
     <div class="modal-footer">
         <button class="modal-close waves-effect waves-green btn-flat">Cerrar</button>
     </div>
     </div> --}}
