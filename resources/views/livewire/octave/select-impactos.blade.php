<div class="col-12" style="padding:0 !important">
    <div class="row col-12 mr-2">
        <div wire:ignore class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="operacional"><i class="fas fa-project-diagram iconos-crear"></i>Operacional</label><a id="btnAgregarTipo" onclick="event.preventDefault();"
            style="font-size:12pt; float: right;"data-toggle="modal" data-target="#marcaslec" data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i class="fas fa-info-circle" ></i></a>
            <select class="form-control select2 {{ $errors->has('operacional') ? 'is-invalid' : '' }}"
                wire:model.live='operacionalId' name="operacional" id="operacional">
                <option value="0" {{ $operacionalId == 0 ? 'selected' : '' }}>0 - Sin impacto</option>
                <option value="1" {{ $operacionalId == 1 ? 'selected' : '' }}>1 - Muy Bajo</option>
                <option value="2" {{ $operacionalId == 2 ? 'selected' : '' }}>2 - Bajo</option>
                <option value="3" {{ $operacionalId == 3 ? 'selected' : '' }}>3 - Medio</option>
                <option value="4" {{ $operacionalId == 4 ? 'selected' : '' }}>4 - Alto</option>
                <option value="5" {{ $operacionalId == 5 ? 'selected' : '' }}>5 - Crítico</option>
            </select>

        </div>

        <div wire:ignore class="form-group col-sm-4 col-md-4 col-lg-4">
            <label for="cumplimiento"><i class="fas fa-check iconos-crear"></i>Cumplimiento</label>
            <a id="btnAgregarTipo" onclick="event.preventDefault();"
            style="font-size:12pt; float: right;"data-toggle="modal"  data-target="#modelolec" data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i class="fas fa-info-circle" ></i></a>
            </a>
            <select class="form-control select2 {{ $errors->has('cumplimiento') ? 'is-invalid' : '' }}"
                wire:model.live='cumplimientoId' name="cumplimiento" id="cumplimiento">
                <option value="0" {{ $cumplimientoId == 0 ? 'selected' : '' }}>0 - Sin impacto</option>
                <option value="1" {{ $cumplimientoId == 1 ? 'selected' : '' }}>1 - Muy Bajo</option>
                <option value="2" {{ $cumplimientoId == 2 ? 'selected' : '' }}>2 - Bajo</option>
                <option value="3" {{ $cumplimientoId == 3 ? 'selected' : '' }}>3 - Medio</option>
                <option value="4" {{ $cumplimientoId == 4 ? 'selected' : '' }}>4 - Alto</option>
                <option value="5" {{ $cumplimientoId == 5 ? 'selected' : '' }}>5 - Crítico</option>
            </select>
        </div>

        <div wire:ignore class="form-group col-sm-4 col-md-3 col-lg-4">
            <label for="legal"><i class="fas fa-gavel iconos-crear"></i>Legal</label>
            <a id="btnAgregarTipo" onclick="event.preventDefault();"
            style="font-size:12pt; float: right;"data-toggle="modal"  data-target="#legalec" data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i class="fas fa-info-circle" ></i></a>
            </a>
            <select class="form-control select2 {{ $errors->has('legal') ? 'is-invalid' : '' }}" wire:model.live='legalId'
                name="legal" id="legal">
                <option value="0" {{ $legalId == 0 ? 'selected' : '' }}>0 - Sin impacto</option>
                <option value="1" {{ $legalId == 1 ? 'selected' : '' }}>1 - Muy Bajo</option>
                <option value="2" {{ $legalId == 2 ? 'selected' : '' }}>2 - Bajo</option>
                <option value="3" {{ $legalId == 3 ? 'selected' : '' }}>3 - Medio</option>
                <option value="4" {{ $legalId == 4 ? 'selected' : '' }}>4 - Alto</option>
                <option value="5" {{ $legalId == 5 ? 'selected' : '' }}>5 - Crítico</option>
            </select>
        </div>

    </div>

    <div class="row col-12">
        <div wire:ignore class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="reputacional"><i class="fas fa-newspaper iconos-crear"></i>Reputacional</label>
            <a id="btnAgregarTipo" onclick="event.preventDefault();"
            style="font-size:12pt; float: right;"data-toggle="modal"  data-target="#reputacionallec" data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i class="fas fa-info-circle" ></i></a>
            </a>
            <select class="form-control select2 {{ $errors->has('reputacional') ? 'is-invalid' : '' }}"
                wire:model.live='reputacionalId' name="reputacional" id="reputacional">
                <option value="0" {{ $reputacionalId == 0 ? 'selected' : '' }}>0 - Sin impacto</option>
                <option value="1" {{ $reputacionalId == 1 ? 'selected' : '' }}>1 - Muy Bajo</option>
                <option value="2" {{ $reputacionalId == 2 ? 'selected' : '' }}>2 - Bajo</option>
                <option value="3" {{ $reputacionalId == 3 ? 'selected' : '' }}>3 - Medio</option>
                <option value="4" {{ $reputacionalId == 4 ? 'selected' : '' }}>4 - Alto</option>
                <option value="5" {{ $reputacionalId == 5 ? 'selected' : '' }}>5 - Crítico</option>
            </select>
        </div>



        <div wire:ignore class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="tecnologico"><i class="fas fa-laptop iconos-crear"></i>Tecnológico</label>
            <a id="btnAgregarTipo" onclick="event.preventDefault();"
            style="font-size:12pt; float: right;"data-toggle="modal"  data-target="#tecnologialec" data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i class="fas fa-info-circle" ></i></a>
            </a>
            <select class="form-control select2 {{ $errors->has('tecnologico') ? 'is-invalid' : '' }}"
                wire:model.live='tecnologicoId' name="tecnologico" id="tecnologico">
                <option value="0" {{ $tecnologicoId == 0 ? 'selected' : '' }}>0 - Sin impacto</option>
                <option value="1" {{ $tecnologicoId == 1 ? 'selected' : '' }}>1 - Muy Bajo</option>
                <option value="2" {{ $tecnologicoId == 2 ? 'selected' : '' }}>2 - Bajo</option>
                <option value="3" {{ $tecnologicoId == 3 ? 'selected' : '' }}>3 - Medio</option>
                <option value="4" {{ $tecnologicoId == 4 ? 'selected' : '' }}>4 - Alto</option>
                <option value="5" {{ $tecnologicoId == 5 ? 'selected' : '' }}>5 - Crítico</option>
            </select>
        </div>

        <div wire:ignore.self class="form-group col-sm-12 col-md-3 col-lg-3">
            <label for="valor"><i class="fas fa-bullseye iconos-crear"></i>Valor del impacto</label>
            <input class="form-control mt-2 {{ $errors->has('valor') ? 'is-invalid' : '' }}" type="number"
                wire:model='valorId' name="valor" value="{{ old('valor', '') }}" readonly
                style="background: {{ $colorReglaTipo }};color:{{ $colorTextoTipo }};" id="valorImpacto">
            @if ($errors->has('valor'))
                <div class="invalid-feedback">
                    {{ $errors->first('valor') }}
                </div>
            @endif
        </div>

        <div  class="form-group col-sm-12 col-md-3 col-lg-3">
            <label><i class="fas fa-bullseye iconos-crear"></i>Nivel de Impacto</label>
           <input  style="background: {{ $colorReglaTipo }};color:{{ $colorTextoTipo }};" class="mt-2 form-control" id="nivelImpactoTxt" readonly wire:model="nivelImpactoTxt"/>
        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#cumplimiento').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('cumplimientoId', data.id);
        });
        $('#operacional').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('operacionalId', data.id);
        });
        $('#legal').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('legalId', data.id);
        });
        $('#reputacional').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('reputacionalId', data.id);
        });
        $('#tecnologico').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('tecnologicoId', data.id);
        });
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded',() => {
        Livewire.on('procesoObtenido', valor => {
            let promedio=document.getElementById('valor').value;
            let final= valor*promedio
            document.getElementById('nivel_riesgo').value= Math.round(final);
            let contenedorTxt=document.getElementById('valorCriticidadTxt');
            contenedorTxt.innerHTML=null;
            let contenedorValor=document.getElementById('nivel_riesgo');
            contenedorValor.innerHTML=null;
            if (final <=5){
                        resultado="Muy Bajo"
                        contenedorTxt.style.background="green"
                        contenedorValor.style.background="green"
                        contenedorTxt.style.color="white"
                        contenedorValor.style.color="white"
                    }
                    else if (final >5 && final<=20){
                        resultado="Baja"
                        contenedorTxt.style.background="rgb(50, 205, 63)"
                        contenedorValor.style.background="rgb(50, 205, 63)"
                        contenedorTxt.style.color="white"
                        contenedorValor.style.color="white"
                    }
                    else if (final <=50){
                        resultado="Medio"
                        contenedorTxt.style.background="yellow"
                        contenedorValor.style.background="yellow"
                        contenedorTxt.style.color="black"
                        contenedorValor.style.color="black"
                    }
                    else if (final <=80){
                        resultado="Alta"
                        contenedorTxt.style.background="orange"
                        contenedorValor.style.background="orange"
                        contenedorTxt.style.color="white"
                        contenedorValor.style.color="white"
                    }
                    else{
                        resultado="Crítica"
                        contenedorTxt.style.background="red"
                        contenedorValor.style.background="red"
                        contenedorTxt.style.color="white"
                        contenedorValor.style.color="white"

                    }

                    document.getElementById('valorCriticidadTxt').innerHTML=resultado;
        })
    });


</script>
