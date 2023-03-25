<div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-6">
            <div class="row" x-data="{isUploading:false, progress:0}"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="col-sm-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            INE / IFE
                        </div>
                        <div class="card-body">
                            @if (!$documentoIne)
                                <div class="input-group mb-3">
                                    <input wire:model="documentoIne" type="file" id="INE" aria-describedby="INE01">
                                    @error('documentoIne')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="progress" x-show.transition="isUploading">
                                    <div class="progress-bar" role="progressbar" x-bind:style="`width:${progress}%`"
                                        x-bind:aria-valuenow="`${progress}`" x-bind:aria-valuemin="0"
                                        x-bind:aria-valuemax="100" x-text="`${progress}%`">
                                    </div>
                                </div>
                            @else
                                <div class="form-control">
                                    <a target="_blank" href="{{ $documentoIne->ruta_documento }}"
                                        class="text-muted"><i
                                            class="fas fa-file-pdf mr-2"></i>{{ $documentoIne->documentos }}</a>
                                    <i class="fas fa-times-circle ml-2" style="cursor: pointer;"
                                        @click="isUploading = false"
                                        wire:click="removeDocumento({{ $documentoIne->id }})"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" x-data="{isUploading:false, progress:0}"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="col-sm-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            IMSS
                        </div>
                        <div class="card-body">
                            @if (!$documentoImss)
                                <div class="input-group mb-3">
                                    <input wire:model="documentoImss" type="file" id="IMSS" aria-describedby="IMSS01">
                                    @error('documentoImss')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="progress" x-show.transition="isUploading">
                                    <div class="progress-bar" role="progressbar" x-bind:style="`width:${progress}%`"
                                        x-bind:aria-valuenow="`${progress}`" x-bind:aria-valuemin="0"
                                        x-bind:aria-valuemax="100" x-text="`${progress}%`">
                                    </div>
                                </div>
                            @else
                                <div class="form-control">
                                    <a target="_blank" href="{{ $documentoImss->ruta_documento }}"
                                        class="text-muted"><i
                                            class="fas fa-file-pdf mr-2"></i>{{ $documentoImss->documentos }}</a>
                                    <i class="fas fa-times-circle ml-2" style="cursor: pointer;"
                                        @click="isUploading = false"
                                        wire:click="removeDocumento({{ $documentoImss->id }})"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" x-data="{isUploading:false, progress:0}"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="col-sm-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            CURP
                        </div>
                        <div class="card-body">
                            @if (!$documentoCurp)
                                <div class="input-group mb-3">
                                    <input wire:model="documentoCurp" type="file" id="CURP" aria-describedby="CURP01">
                                    @error('documentoCurp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="progress" x-show.transition="isUploading">
                                    <div class="progress-bar" role="progressbar" x-bind:style="`width:${progress}%`"
                                        x-bind:aria-valuenow="`${progress}`" x-bind:aria-valuemin="0"
                                        x-bind:aria-valuemax="100" x-text="`${progress}%`">
                                    </div>
                                </div>
                            @else
                                <div class="form-control">
                                    <a target="_blank" href="{{ $documentoCurp->ruta_documento }}"
                                        class="text-muted"><i
                                            class="fas fa-file-pdf mr-2"></i>{{ $documentoCurp->documentos }}</a>
                                    <i class="fas fa-times-circle ml-2" style="cursor: pointer;"
                                        @click="isUploading = false"
                                        wire:click="removeDocumento({{ $documentoCurp->id }})"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" x-data="{isUploading:false, progress:0}"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <div class="col-sm-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header bg-white">
                            RFC
                        </div>
                        <div class="card-body">
                            @if (!$documentoRfc)
                                <div class="input-group mb-3">
                                    <input wire:model="documentoRfc" type="file" id="RFC" aria-describedby="RFC01">
                                    @error('documentoRfc')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="progress" x-show.transition="isUploading">
                                    <div class="progress-bar" role="progressbar" x-bind:style="`width:${progress}%`"
                                        x-bind:aria-valuenow="`${progress}`" x-bind:aria-valuemin="0"
                                        x-bind:aria-valuemax="100" x-text="`${progress}%`">
                                    </div>
                                </div>
                            @else
                                <div class="form-control">
                                    <a target="_blank" href="{{ $documentoRfc->ruta_documento }}"
                                        class="text-muted"><i
                                            class="fas fa-file-pdf mr-2"></i>{{ $documentoRfc->documentos }}</a>
                                    <i class="fas fa-times-circle ml-2" style="cursor: pointer;"
                                        @click="isUploading = false"
                                        wire:click="removeDocumento({{ $documentoRfc->id }})"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
