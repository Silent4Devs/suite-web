 <div class="form-group col-md-6 col-sm-6 col-12">
     <label for="fortalezas"> <i class="fas fa-thumbs-up"></i> Fortalezas</label>
     <textarea class="form-control fortalezas {{ $errors->has('fortalezas') ? 'is-invalid' : '' }}" name="fortalezas"
         id="fortalezas">{{ old('fortalezas', $entendimientoOrganizacion->fortalezas) }}</textarea>
     @if ($errors->has('fortalezas'))
         <div class="invalid-feedback">
             {{ $errors->first('fortalezas') }}
         </div>
     @endif
 </div>
 <div class="form-group col-md-6 col-sm-6 col-12">
     <label for="debilidades"> <i class="fas fa-thumbs-down"></i> Debilidades</label>
     <textarea class="form-control debilidades {{ $errors->has('debilidades') ? 'is-invalid' : '' }}"
         name="debilidades"
         id="debilidades">{{ old('debilidades', $entendimientoOrganizacion->debilidades) }}</textarea>
     @if ($errors->has('debilidades'))
         <div class="invalid-feedback">
             {{ $errors->first('debilidades') }}
         </div>
     @endif
 </div>
 <div class="form-group col-md-6 col-sm-6 col-12">
     <label for="oportunidades"> <i class="fas fa-lightbulb"></i> Oportunidades</label>
     <textarea class="form-control oportunidades {{ $errors->has('oportunidades') ? 'is-invalid' : '' }}"
         name="oportunidades"
         id="oportunidades">{{ old('oportunidades', $entendimientoOrganizacion->oportunidades) }}</textarea>
     @if ($errors->has('oportunidades'))
         <div class="invalid-feedback">
             {{ $errors->first('oportunidades') }}
         </div>
     @endif
 </div>
 <div class="form-group col-md-6 col-sm-6 col-12">
     <label for="amenazas"><i class="fas fa-bomb"></i> Amenazas</label>
     <textarea class="form-control amenazas {{ $errors->has('amenazas') ? 'is-invalid' : '' }}" name="amenazas"
         id="amenazas">{{ old('amenazas', $entendimientoOrganizacion->amenazas) }}</textarea>
     @if ($errors->has('amenazas'))
         <div class="invalid-feedback">
             {{ $errors->first('amenazas') }}
         </div>
     @endif
 </div>
 <div class="text-right form-group col-md-12">
     <button class="btn btn-danger" type="submit">
         {{ $btnText }}
     </button>
 </div>
