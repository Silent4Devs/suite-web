<div class="col-12">
    <style>
        .select2-dropdown {
            top: -84px !important;
            left: -59px !important;
        }
    </style>
    <div class="header-text text-center">
        <h3>¿A QUIÉN VISITAS?</h3>
        <p>Por favor, selecciona el área o la persona que vaya a visitar</p>
    </div>
    <div x-data="{ showPersona: true }">
        <div class="d-flex justify-content-center">
            <div style="width: 500px">
                <div class="d-flex" style="justify-content: space-around">
                    <div class="form-check">
                        <input class="form-check-input @error('tipo_visita') is-invalid @enderror" type="radio"
                            wire:model.defer="tipo_visita" value="persona" name="tipo_visita" id="radioPersona"
                            {{ $tipo_visita == 'persona' ? 'checked' : '' }} x-on:click="showPersona=true">
                        <label class="form-check-label" for="radioPersona">
                            Persona
                        </label>
                        @error('tipo_visita')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('tipo_visita') is-invalid @enderror" type="radio"
                            {{ $tipo_visita == 'area' ? 'checked' : '' }} value="area" wire:model.defer="tipo_visita"
                            name="tipo_visita" id="radioArea" x-on:click="showPersona=false">
                        <label class="form-check-label" for="radioArea">
                            Área
                        </label>
                        @error('tipo_visita')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4" x-show="showPersona">
            <h6 style="color: #3086AF">Persona</h6>
            <p>Despliega la lista y selecciona una persona</p>
            <div class="w-100 grid justify-content-center">
                <div class="col-12">
                    <select wire:model.defer="empleado_id"
                        class="form-control select-buscador @error('empleado_id') is-invalid @enderror" name="persona"
                        id="persona">
                        <option value="">Selecciona una persona</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                        @endforeach
                    </select>
                    @error('empleado_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <br>
            </div>
        </div>
        <div class="text-center mt-4" x-show="!showPersona">
            <h6 style="color: #3086AF">Área</h6>
            <p>Despliega la lista y selecciona una área</p>
            <div class="w-100 row justify-content-center">
                <div class="col-12">
                    <select wire:model.defer="area_id"
                        class="select-buscador form-control @error('area_id') is-invalid @enderror" name="area"
                        id="area">
                        <option value="">Selecciona un área</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                    @error('area_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3" style="text-align: end">
        <button class="btn btn-primary" wire:click.prevent="increaseStep()">¡Listo!</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initSelect2();
            Livewire.on('select2', () => {
                initSelect2();
            });

            $('#persona').on('select2:select', function(e) {
                var data = e.params.data;
                @this.set('empleado_id', data.id);
            });

            $('#area').on('select2:select', function(e) {
                var data = e.params.data;
                @this.set('area_id', data.id);
            });
        })

        function initSelect2() {
            $('#persona').select2();
            $('#area').select2();
        }
    </script>
</div>
