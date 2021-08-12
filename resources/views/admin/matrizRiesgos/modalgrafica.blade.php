<!-- Modal -->
<div class="modal fade" id="graficaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Gráfica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around" align="center">
                    <div>
                        <h5>Sede</h5>
                        <select class="sedeSelect" name="sede" id="sede">
                            <option value="">Seleccion una opción</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h5>Área</h5>
                        <select class="areaSelect" name="area" id="area">
                            <option value="">Seleccion una opción</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <h5>Proceso</h5>
                        <select class="sedeSelect" name="state">
                            <option value="">Seleccion una opción</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->id }}">{{ $proceso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        asdad
                    </div>
                    <div class="col-md-6">
                        adsasd
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
</script>
