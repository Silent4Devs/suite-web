<div class="modal fade" id="cumpleaños_comentarios_Modal_{{ $cumple->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <label><i class="fas fa-birthday-cake iconos-crear"></i> Envia tus felicitacionesa a
                    <strong>{{ $cumple->name }}</strong></label>
                @if ($cumples_felicitados_comentarios_contador == 0)
                    <form wire:submit.prevent="felicitarCumplesComentarios({{ $cumple->id }})">
                        <div class="form-group">
                            <textarea class="comentario" name="comentario" wire:model.lazy="comentarios" class="form-control" data-sample-short></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                @else
                    <form
                        wire:submit.prevent="felicitarCumplesComentariosUpdate({{ $cumples_felicitados_comentarios->id }})">
                        @csrf
                        <div class="form-group">
                            <textarea class="comentario" name="comentario" wire:model.lazy="comentarios_update" class="form-control"
                                data-sample-short>{{ $cumples_felicitados_comentarios->comentarios }}</textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
