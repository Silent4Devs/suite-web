<div style="padding:5rem;">
    <div class="generar-reporte mb-3" style="background-color:white; border-radius: 15px">
        <div class="row">
            <div class="col s12" style="margin-bottom: 30px;">
                <h4 class="titulo-form ms-3 mt-3">GENERAR REPORTE</h4>
                <p class="instrucciones ms-3">Por favor seleccione el tipo de reporte</p>
            </div>
        </div>
        <center>
            <div class="row">
                <div class="col s12 m8 mb-4">
                    <button wire:click="setMenu(1)" class="a_btn">
                        <span class="material-symbols-outlined"
                            style="left: 40px; width: 100%; padding-bottom: 6px; font-size: 6rem; display:block; color:var(--color-tbj);">
                            corporate_fare
                        </span>
                        <span
                            style="font-weight: 500; white-space: nowrap; color:var(--color-tbj)"><strong>Organización</strong></span>
                    </button>

                    <button wire:click="setMenu(2)" class="a_btn">
                        <span class="material-symbols-outlined"
                            style="left: 40px; width: 100%; padding-bottom: 6px; font-size: 6rem; display:block; color:var(--color-tbj);">
                            assignment_ind
                        </span>
                        <span style="color:var(--color-tbj)"><strong>Proveedores</strong></span>
                    </button>

                    <button wire:click="setMenu(3)" class="a_btn">
                        <span class="material-symbols-outlined"
                            style="left: 40px; width: 100%; padding-bottom: 6px; font-size: 6rem; display:block; color:var(--color-tbj);">
                            article
                        </span>
                        <span style="color:var(--color-tbj)"><strong>Contratos</strong></span>
                    </button>
                </div>
            </div>
        </center>
    </div>

    <div class="row">
        <div class="col s12 m12">
            <div class="w-100 d-flex justify-content-center">
                <div wire:loading class="loading-overlay mb-5 mt-2">
                    <div class="spinner">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div wire:loading.remove>
                @if ($showMenu === 1)
                    <section id="organizacion">
                        @include('contract_manager.reportes.organizacion')
                    </section>
                @endif

                @if ($showMenu === 2)
                    <section id="proveedores">
                        @include('contract_manager.reportes.proveedor')
                    </section>
                @endif

                @if ($showMenu === 3)
                    <section id="contratos">
                        @include('contract_manager.reportes.contrato')
                    </section>
                @endif
            </div>

            <p style="opacity: 0.9; margin-top: 30px;">
                <span style="font-weight: bold;"><span style="color: #2395AA;">Nota:</span></span> Para la
                visualización de elementos gráficos dentro del reporte es necesario activar la opción
                <strong>"imprimir gráficos"</strong> que se encuentra dentro de más opciones - imprimir gráficos
            </p>
        </div>
    </div>
</div>


