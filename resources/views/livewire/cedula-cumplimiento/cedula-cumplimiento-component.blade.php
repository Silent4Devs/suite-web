<div>
    <div>
        @include('livewire.cedula-cumplimiento.table')
    </div>
    <br>
    <div>
        @if (!$show_contrato)
            @include("livewire.cedula-cumplimiento.$view")
            <h4 style="text-align: center" class="sub-titulo-form col s12">HALLÁZGOS</h4>
            {{-- <div class="form-group diseño-titulo">
                <h4 class="sub-titulo-form col s12">HALLÁZGOS</h4>
            </div> --}}
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Facturas</div>
                    <div class="collapsible-body"> @include("livewire.cedula-cumplimiento.facturas_table")</div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">multiline_chart</i>Niveles de servicio
                    </div>
                    <div class="collapsible-body"> @include("livewire.cedula-cumplimiento.niveles_servicio_table")</div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">event</i>Entregables mensuales
                    </div>
                    <div class="collapsible-body"> @include("livewire.cedula-cumplimiento.entregables_mensuales_table")
                    </div>
                </li>
                <li>
                    <div class="collapsible-header"><i class="material-icons">assignment_turned_in</i>Cierre proyecto
                    </div>
                    <div class="collapsible-body"> @include("livewire.cedula-cumplimiento.cierre_contratos_table")</div>
                </li>
            </ul>
        @endif
    </div>
</div>
