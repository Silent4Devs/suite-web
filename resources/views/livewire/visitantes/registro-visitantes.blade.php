<div style="background: #f1f1f1;zoom: 80%">
    @include('visitantes.registro-visitantes.estilos-camara')
    @include('visitantes.registro-visitantes.estilos-stepper')
    <x-loading-indicator />
    <div class="container p-5">
        <div class="accordion" id="accordionExample">
            <div class="steps">
                <progress id="progress" value=0 max=100></progress>
                <div class="step-item">
                    <button wire:click.prevent="goToStep(1)" id="datosVisitante" class="step-button text-center"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="{{ $showStepOne ? 'true' : 'false' }}" aria-controls="collapseOne">
                        <i class="bi bi-person-bounding-box"></i>
                    </button>
                    <div class="step-title">
                        <strong>Datos</strong>
                    </div>
                </div>
                <div class="step-item">
                    <button wire:click.prevent="goToStep(2)" id="camaraVisitante"
                        class="step-button text-center collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="{{ $showStepTwo ? 'true' : 'false' }}"
                        aria-controls="collapseTwo">
                        <i class="bi bi-camera"></i>
                    </button>
                    <div class="step-title">
                        <strong>Fotografía</strong>
                    </div>
                </div>
                <div class="step-item">
                    <button wire:click.prevent="goToStep(3)" id="aQuienVisita" class="step-button text-center collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                        aria-expanded="{{ $showStepThree ? 'true' : 'false' }}" aria-controls="collapseThree">
                        <i class="bi bi-people"></i>
                    </button>
                    <div class="step-title">
                        <strong>¿A quién visitas?</strong>
                    </div>
                </div>
                <div class="step-item">
                    <button id="finalizarStep" class="step-button text-center"
                        aria-expanded="{{ $showStepFour ? 'true' : 'false' }}">
                        <i class="bi bi-check-circle"></i>
                    </button>
                    <div class="step-title">
                        <strong>Finalizar</strong>
                    </div>
                </div>
            </div>

            <div class="card">
                <div id="collapseOne" class="collapse {{ $showStepOne ? 'show' : '' }}" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="card-body">
                        @include('visitantes.registro-visitantes.form-datos-visitante')
                    </div>
                </div>
            </div>
            <div class="card">
                <div id="collapseTwo" class="collapse {{ $showStepTwo ? 'show' : '' }}" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="card-body">
                        @include('visitantes.registro-visitantes.form-tomar-foto')
                    </div>
                </div>
            </div>
            <div class="card">
                <div id="collapseThree" class="collapse {{ $showStepThree ? 'show' : '' }}" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="card-body">
                        @include('visitantes.registro-visitantes.form-a-quien-visitas')
                    </div>
                </div>
            </div>
            <div class="card">
                <div id="collapseFour" class="collapse {{ $showStepFour ? 'show' : '' }}" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="card-body">
                        @include('visitantes.registro-visitantes.visitante-registrado')
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        <div wire:ignore.self class="modal fade" id="visitanteCredencial" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="m-0 row container justify-content-center">
                            <div
                                class="col-8 col-md-12 col-sm-12 col-lg-8 text-center header-text border rounded p-4 border-4">
                                <h3 style="color: #3086AF">REGISTRADO CON ÉXITO</h3>
                                <div id="credencialVisitante" class="border border-4 rounded">
                                    @include('visitantes.registro-visitantes._visitante-registrado', [
                                        'visitante' => $registrarVisitante,
                                        'mostrarQrIngreso' => true,
                                        'urlQrIngreso' => route('visitantes.salida.registrar', [
                                            'registrarVisitante' => $registrarVisitante
                                                ? $registrarVisitante->uuid
                                                : null,
                                        ]),
                                        'mostrarQrSalida' => false,
                                        'urlQrSalida' => '',
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click.prevent="imprimirCredencial"><i
                                class="bi bi-printer"></i> Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            Livewire.on('finalizarRegistroVisitante', () => {
                window.location.href = "{{ route('visitantes.index') }}";
            });

            Livewire.on('imprimirCredencialSelf', (pdf) => {
                html2canvas(document.querySelector("#credencialVisitante")).then(canvas => {
                    let imgData = canvas.toDataURL('image/png');
                    @this.emit('imprimirCredencialImage', imgData);
                });
            });

            Livewire.on('credencialImpresa', (pdf) => {
                setTimeout(() => {
                    window.location.href = "{{ route('visitantes.presentacion') }}";
                }, 1000);
            });

            Livewire.on('guardarRegistroVisitante', (registrarVisitante) => {
                //open modal 
                $('#visitanteCredencial').modal('show');

            })

            Livewire.on('increaseStepVisitantes', (step) => {
                console.log(step);
                if (step == 1) {
                    //toogle collapse
                    document.getElementById('datosVisitante').click();
                    showStep('collapseOne', true);
                    showStep('collapseTwo', false);
                    showStep('collapseThree', false);
                    showStep('collapseFour', false);

                } else if (step == 2) {
                    document.getElementById('camaraVisitante').click();
                    showStep('collapseOne', false);
                    showStep('collapseTwo', true);
                    showStep('collapseThree', false);
                    showStep('collapseFour', false);
                } else if (step == 3) {
                    document.getElementById('aQuienVisita').click();
                    showStep('collapseOne', false);
                    showStep('collapseTwo', false);
                    showStep('collapseThree', true);
                    showStep('collapseFour', false);
                } else if (step == 4) {
                    document.getElementById('finalizarStep').click();
                    showStep('collapseOne', false);
                    showStep('collapseTwo', false);
                    showStep('collapseThree', false);
                    showStep('collapseFour', true);
                }
            });
        });

        function showStep(element, active) {
            if (active) {
                document.getElementById(element).classList.add('show');
            } else {
                document.getElementById(element).classList.remove('show');
            }
        }
    </script>
    @include('visitantes.registro-visitantes.scripts-camara')
</div>



{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            $('.persona').select2();
            $('.area').select2();
        });
    </script>
@endpush --}}
