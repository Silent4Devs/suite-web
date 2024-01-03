<div>
    <div class="titulo">
        Análisis de Brechas
    </div>
    <div class="row">
        <div class="card card-body mt-3" style="width:1030px;">
            <div class="titulo-card">Templates generados
                <hr>
            </div>
            <div class="datatable-rds datatable-fix">
                <table id="datatable_analisisbrechas" class="table w-100" style="width:100%">
                    <thead >
                        <tr>
                            <th style="max-width:300px !important;background-color:rgb(255, 255, 255); color:#414141;">ID</th>
                            <th style="min-width:200px; background-color:rgb(255, 255, 255); color:#414141;">Nombre del template
                            </th>
                            <th style="max-width:80px;background-color:rgb(255, 255, 255); color:#414141;">
                                Fecha de creación</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">No de preguntas</th>
                            <th style="background-color:rgb(255, 255, 255); color:#414141;">Top 8</th>
                            {{-- <th style="background-color:rgb(255, 255, 255); color:#414141;"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($top_analisis as $key => $analisis )
                            <tr>
                                <td>
                                    {{$analisis->id}}
                                </td>
                                <td>
                                    {{$analisis->nombre_template}}
                                </td>
                                <td>
                                    {{$analisis->created_at}}
                                </td>
                                <td>

                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault{{$analisis->id}}"
                                        {{$analisis->top ? 'checked':''}}
                                        {{ $registrosactivos >= $limit_registros && !$analisis->top ? 'disabled' : '' }}
                                         wire:click = 'top({{$analisis->id}})'>
                                        <label class="form-check-label" for="flexCheckDefault">
                                        </label>
                                      </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        {{-- <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-left:40px;">

        </div> --}}
    </div>
</div>
