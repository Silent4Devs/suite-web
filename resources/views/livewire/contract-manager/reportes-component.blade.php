<div>
    <div class="row">
        <div class="col s12" style="margin-bottom: 30px;">
            <h4 class="titulo-form">GENERAR REPORTE</h4>
            <p class="instrucciones">Por favor seleccione el tipo de reporte</p>
        </div>
    </div>
    <center>
        <div class="row">
            <div class="col s12 m8">
                <a href="#organizacion" class="a_btn">
                    <img src="{{ asset('img/reportes/org.svg') }}" style="left: 40px; width: 100%; padding-bottom: 6px;">
                    <span style="color:var(--color-tbj)"><strong>Organización</strong></span>
                </a>

                <a href="#proveedores" class="a_btn">
                    <img src="{{ asset('img/reportes/prov.svg') }}"
                        style="left: 40px; width: 100%; padding-bottom: 6px;">
                    <span style="color:var(--color-tbj)"><strong>Proveedores</strong></span>
                </a>

                <a href="#contratos" class="a_btn">
                    <img src="{{ asset('img/reportes/contr.svg') }}"
                        style="left: 40px; width: 100%; padding-bottom: 6px;">
                    <span style="color:var(--color-tbj)"><strong>Contratos</strong></span>
                </a>
            </div>
        </div>
    </center>

    <div class="row">
        <div class="col s12 m12">

            <section id="organizacion">
                @include('contract_manager.reportes.organizacion')
            </section>


            <section id="proveedores">
                @include('contract_manager.reportes.proveedor')
            </section>


            <section id="contratos">
                @include('contract_manager.reportes.contrato')
            </section>

            <p style="opacity: 0.9; margin-top: 30px;">
                <span style="font-weight: bold;"><span style="color: #2395AA;">Nota:</span></span> Para la
                visualización de elementos gráficos dentro del reporte es necesario activar la opción
                <strong>"imprimir gráficos"</strong> que se encuentra dentro de más opciones - imprimir gráficos
            </p>
        </div>
    </div>
</div>
