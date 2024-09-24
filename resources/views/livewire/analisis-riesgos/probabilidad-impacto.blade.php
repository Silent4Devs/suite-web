<div>
    <div class="card">
        <div class="card-body" style="padding-bottom:0px;">
            <div class="row m-0 p-0">
                <div class="col-12">
                    <h5 class="title-grafics">
                        Escalas de Probabilidad e Impacto
                    </h5>
                </div>
            </div>
            <hr style="margin-top: 0px; margin-bottom:38px;">
            <div class="row m-0 p-0">
                <div class="col-8" style="margin-bottom:49px;">
                    <h6 class="title-rango">Rango</h6>
                    <p class="subtitle-rango">Especifica el valor mínimo y máximo que tendrá la Probabilidad e Impacto
                    </p>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group pl-0 anima-focus">
                                <input type="number" class="form-control" placeholder="" name="min"
                                    wire:model="min" value="{{ old('min') }}">
                                <label for="min">Minimo*</label>
                                @error('min')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group pl-0 anima-focus">
                                <input type="number" class="form-control" placeholder="" name="Maximo"
                                    wire:model="max">
                                <label for="Maximo">Máximo*</label>
                                {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                            </div>
                        </div>
                        <div class="col-1" style="padding-top: 10px;">
                            <i wire:click="resetMinMax()" class="text-sm text-red-500 fas fa-trash-alt"></i>
                        </div>
                    </div>

                    <h6 class="title-rango">Escalas</h6>
                    <p class="subtitle-rango">Define las escalas de medición, asigna su color, valor y nombre para
                        indetificarlos</p>

                    @if (!$edit)
                        @foreach ($prob_imp as $key => $probImp)
                            <div class="row m-0 p-0">
                                <div class="col-1" style="padding-left:0px; padding-right:0px;">
                                    <div class="color-picker" style="width: 100%;">
                                        <input type="color" wire:model="prob_imp.{{ $key }}.color"
                                            class="color-input form-control" title="Seleccione un color">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group pl-0 anima-focus">
                                        <input type="number" wire:model.live="prob_imp.{{ $key }}.valor"
                                            class="form-control" placeholder="">
                                        <label for="valor">Valor</label>
                                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group pl-0 anima-focus">
                                        <input wire:model.live="prob_imp.{{ $key }}.nombre"
                                            class="form-control" placeholder="">
                                        <label for="name">Nombre de la escala</label>
                                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1" style="padding-top: 10px;">
                                    @if ($key > 1)
                                        <i wire:click="removeInput({{ $key }})"
                                            class="text-sm text-red-500 fas fa-trash-alt"></i>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($prob_imp as $key => $probImp)
                            <div class="row m-0 p-0">
                                <div class="col-1" style="padding-left:0px; padding-right:0px;">
                                    <div class="color-picker" style="width: 100%;">
                                        <input type="color" wire:model="prob_imp.{{ $key }}.color"
                                            class="color-input form-control" title="Seleccione un color">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group pl-0 anima-focus">
                                        <input type="number" wire:model.live="prob_imp.{{ $key }}.valor"
                                            class="form-control" placeholder="">
                                        <label for="valor">Valor</label>
                                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group pl-0 anima-focus">
                                        <input wire:model.live="prob_imp.{{ $key }}.nombre"
                                            name="prob_imp[1][nombre]" class="form-control" placeholder=""
                                            value="test">
                                        <label for="name">Nombre de la escala</label>
                                        {{-- @error('name') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1" style="padding-top: 10px;">
                                    @if ($key > 1 && $probImp['id'] !== 0)
                                        <i wire:click="$dispatch('delete',{{ $probImp['id'] }},{{ $key }})"
                                            class="text-sm text-red-500 fas fa-trash-alt"></i>
                                    @elseif ($key > 1 && $probImp['id'] === 0)
                                        <i wire:click="removeInput({{ $key }})"
                                            class="text-sm text-red-500 fas fa-trash-alt"></i>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <a class="btn btn-link" wire:click.prevent="addInput"
                        style="cursor: pointer; color: var(--color-tbj)">
                        Agregar valor <i class="fas fa-plus"></i>
                    </a>

                </div>
                <div class="col-4 d-flex align-items-center justify-content-center" style="background: #F6FBF1;">
                    <div style="position: absolute; top: 96px; left: 99px;">
                        <h5 class="title-ejemplo">
                            Ejemplo</h5>
                    </div>
                    <div>
                        @include('admin.analisis-riesgos.components.tbHeaderMap')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('js')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Livewire.on("delete", (id, key) => {
                Swal.fire({
                    title: "Eliminar registro",
                    text: "¿Esta seguro que desea eliminar?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('analisis-riesgos.probabilidad-impacto', 'destroy', id,
                        key);
                        Swal.fire({
                            title: "Eliminado",
                            text: "El análisis de brechas se elimino con éxito",
                            icon: "success",
                        });
                    }
                });
            })
        });
    </script>
</div>
