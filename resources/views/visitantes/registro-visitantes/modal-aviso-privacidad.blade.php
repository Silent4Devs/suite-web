 <!-- Button trigger modal -->
 <button id="avisoPrivacidadVisitantesBtn" type="button" class="btn btn-primary d-none" data-bs-toggle="modal"
     data-bs-target="#avisoPrivacidadVisitantesModal">
     Mostrar Aviso
 </button>

 <!-- Modal -->
 <div style="zoom: 70%" class="modal fade" id="avisoPrivacidadVisitantesModal" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="text-center p-3">
                 <img src="{{ $organizacionLogo }}" alt="logotipo" class="img-fluid" style="max-width: 100px">
                 <h4 style="color: #1C274A">AVISO DE PRIVACIDAD</h4>
             </div>
             <div class="modal-body">
                 @if ($aviso_privacidad->aviso_privacidad)
                     {!! $aviso_privacidad->aviso_privacidad !!}
                 @else
                     <h1>No se ha cargado un aviso de privacidad</h1>
                 @endif
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Acepto</button>
             </div>
         </div>
     </div>
 </div>
