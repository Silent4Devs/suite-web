 <div wire:ignore.self class="modal fade" id="planAccionModal" tabindex="-1" aria-labelledby="planAccionModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="planAccionModalLabel">Agregar Plan de Acción</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-sm-12 col-lg-6">
                         <div class="form-group">
                             <label for="parent">Nombre:</label>
                             <input type="text" class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" id="parent" aria-describedby="parent" wire:model="parent" value="{{  old('parent')  }}}}" autocomplete="off">
                             @if ($errors->has('parent'))
                             <span class="invalid-feedback">{{ $errors->first('parent') }}</span>
                             @endif
                             <span class="text-danger parent_error error-ajax"></span>
                         </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                         <div class="form-group">
                             <label for="norma">Norma:</label>
                             <select class="custom-select {{ $errors->has('norma') ? 'is-invalid' : '' }}" id="norma" wire:model="norma">
                                <option selected>-- Selecciona una Norma --</option>
                                @foreach (App\Models\PlanImplementacion::NORMAS as $key =>$norma)
                                    <option value="{{ $key }}" {{ old('norma') == $norma ? 'selected' : '' }}>{{ $norma }}</option>
                                @endforeach
                             </select>
                             @if ($errors->has('norma'))
                             <div class="invalid-feedback">{{ $errors->first('norma') }}</div>
                             @endif
                             <span class="text-danger norma_error error-ajax"></span>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-12 col-lg-6">
                         <div class="form-group">
                             <label for="modulo_origen">Modulo de Origen:</label>
                             <input type="text" class="form-control {{ $errors->has('modulo_origen') ? 'is-invalid' : '' }}" id="modulo_origen" aria-describedby="modulo_origen" wire:model="modulo_origen" value="{{ $modulo_origen }}" autocomplete="off" readonly>
                             @if ($errors->has('modulo_origen'))
                             <span class="invalid-feedback">{{ $errors->first('modulo_origen') }}</span>
                             @endif
                             <span class="text-danger modulo_origen_error error-ajax"></span>
                         </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                         <div class="form-group">
                             <label for="objetivo">Objetivo:</label>
                             <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" id="objetivo" wire:model="objetivo">{{ old('objetivo') }}</textarea>
                             @if ($errors->has('objetivo'))
                             <div class="invalid-feedback">{{ $errors->first('objetivo') }}</div>
                             @endif
                             <span class="text-danger norma_error error-ajax"></span>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                 <button type="button" class="btn btn-primary" wire:click.prevent="save">Guardar</button>
             </div>
         </div>
     </div>
 </div>
