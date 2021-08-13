 <div class="mb-4 col-10" id="plan_accion_select">
     <label for="plan_accion"> <i class="fas fa-question-circle iconos-crear"></i> ¿Vincular con plan de acción?</label>
     <select class="form-control select2 {{ $errors->has('cumplerequisito') ? 'is-invalid' : '' }}" name="plan_accion[]" id="plan_accion" multiple>
         @foreach($planes_implementacion as $plan)
                <option value="{{ $plan->id }}" {{ in_array(old('plan_accion',$plan->id),$planes_seleccionados) ? 'selected' : '' }}>{{ $plan->parent }}</option>     
         @endforeach
     </select>
 </div>
