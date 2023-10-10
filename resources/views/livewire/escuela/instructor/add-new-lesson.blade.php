<div>
    <div class="mt-4" x-data="{ open: false }">
        <div class="mb-3 d-flex justify-content-end">
            <button class="btn btn-light text-primary" type="button"
                @click="open = true; if (open) $nextTick(()=>{ $refs.lessonName.focus() });" x-show="!open">
                AGREGAR LECCIÓN <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="px-4 py-3 mb-3" x-show="open">
            <div class="card shadow-none">
                <div class="card-header" style="color:blue; border: 1px solid #D8D8D8;">
                    <i style="font-size:10pt" class="d-inline text-black-500 fas fa-play-circle"></i>
                    <h5 class="d-inline">Sin nombre</h5>
                </div>
                <div class="card-body" style="border: 1px solid #D8D8D8;">
                    <div class="row text-primary">
                        <div class="col-8">
                            <label for="name-{{ $section->id }}">Nombre</label>
                            <div>
                                <input wire:model.lazy="name" id="name-{{ $section->id }}" x-ref="lessonName" type="text"
                                    class="w-full form-control @if ($errors->has('name')) invalid @endif">
                                @error('name')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="platform-{{ $section->id }}">Plataforma</label>
                            <div class="md:col-span-5">
                                <select wire:model.lazy="platform_id" id="platform-{{ $section->id }}" type="text"
                                    class=" w-full form-control @if ($errors->has('platform_id')) invalid @endif">
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                                @error('platform_id')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <label for="url-{{ $section->id }}">URL</label>
                            <div>
                                <input wire:model.lazy="url" id="url-{{ $section->id }}" type="text"
                                    class=" w-full form-control @if ($errors->has('url')) invalid @endif">
                                @error('url')
                                    <b class="block mt-1 text-xs text-red-500">{{ $message }}</b>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="url-{{ $section->id }}">Descripción</label>
                            <div>
                                <textarea wire:model.lazy="description" id="description-{{ $section->id }}" type="text"
                                    class=" w-full form-control @if ($errors->has('description')) invalid @endif"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mt-4 pl-4 d-flex justify-content-start align-items-center" style="min-height: 99px; border: 1px dashed #BEBEBE; border-radius: 2px;">
                                <input wire:model="file" type="file" class="flex-1 form-input">
                            </div>
                            <div class="mt-1 font-bold text-blue-500" wire:loading wire:target="file">
                                Cargando ...
                            </div>
                            @error('file')
                                <span class="text-xs text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button wire:click="cancel" @click="open = false" type="button" style="background-color:white; min-width:140px;"
                        class="btn btn-light text-primary mr-3">
                        Cancelar</button>
                        <button wire:click="store" class="btn btn-outline-primary" style="min-width:140px;">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
