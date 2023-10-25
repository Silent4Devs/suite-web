<div>
    <div class="card card-body">
        <div class="form-row" style="">
            <div class="col-md-10 titulo-card-template" style="font:roboto;color:#306BA9; font-size:16px;">
                Define el valor de los parámetros con los que se evaluará tu cuestionario
            </div>
            <div class="col-m-1" style="font:roboto;color:#306BA9; font-size:14px; ">
                <div class="">Añadir Sección</div>
            </div>
            <div class="col-m-1 " style="">
                <select id="secciones" name="secciones" wire:model.lazy="secciones" class="form-control">
                    <option value=1 selected>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                </select>
            </div>
        </div>
    </div>
    <div>
        <div class="seccion col-m-2">
            Sección 1
        </div>
        <div class="linea-seccion col-md-12">
        </div>
        <div class="card card-body">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4" style="color:#FF0000; font-size:10px;">La evaluación debe tener un valor total
                    del
                    100% entre las secciones
                </div>
            </div>
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control">
                            </textarea>
                            <label>Descripción</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card card-body mt-5">
            <div style="color:#306BA9; font-size:16px;">Formulario
                <hr style="">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control">
                                </textarea>
                                <label>Pregunta</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@livewireScripts()
