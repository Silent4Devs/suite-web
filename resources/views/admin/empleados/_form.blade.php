<style>
    .select2-container {
        margin-top: 0px !important;
    }

</style>

<div>
    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
        INFORMACIÓN GENERAL
    </div>
    <div class="informacion-general">
        @include('admin.empleados.form_components.general')
    </div>
    <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
        INFORMACIÓN PERSONAL
    </div>
    <div class="informacion-personal">
        @include('admin.empleados.form_components.personal')
    </div>
    <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
        INFORMACIÓN FINANCIERA
    </div>
    <div class="informacion-financiera row">
        @include('admin.empleados.form_components.financiera')
    </div>
    {{-- </div> --}}
</div>
<script type="module">
    import {
        formatNumber,
        formatCurrency
    } from "{{ asset('js/money-format/moneyInput.js') }}";

    document.addEventListener('DOMContentLoaded', function() {
        initInpusToMoneyFormat();
        inputsToMoneyFormat();
        const toogleProyectoAsignado = (ocultar) => {
            const elProyectoAsignado = document.getElementById('proyecto_asignado');
            const containerProyectoAsignado = document.getElementById('c_proyecto_asignado');
            const containerEsquemaContratacion = document.getElementById('c_esquema_contratacion');
            if (ocultar) {
                containerProyectoAsignado.classList.remove('col-sm-6');
                containerProyectoAsignado.classList.add('d-none');
                containerEsquemaContratacion.classList.remove('col-sm-6');
                containerEsquemaContratacion.classList.add('col-sm-12');
                elProyectoAsignado.setAttribute('disabled', 'disabled');
                elProyectoAsignado.removeAttribute('type');
                elProyectoAsignado.setAttribute('type', 'hidden');
                elProyectoAsignado.value = "";
            } else {
                containerProyectoAsignado.classList.add('col-sm-6');
                containerProyectoAsignado.classList.remove('d-none');
                containerEsquemaContratacion.classList.remove('col-sm-12');
                containerEsquemaContratacion.classList.add('col-sm-6');
                elProyectoAsignado.removeAttribute('disabled');
                elProyectoAsignado.removeAttribute('type');
                elProyectoAsignado.setAttribute('type', 'text');
            }
        }

        $('#sede_id').on('select2:select', function(e) {
            const direction = e.target.options[e.target.selectedIndex].getAttribute('data-direction');
            setDirectionOnInput(direction);
        });
        $('#tipo_contrato_empleados_id').on('select2:select', function(e) {
            const slug = e.target.options[e.target.selectedIndex].getAttribute('data-slug');
            console.log(slug);
            if (slug === "por-proyecto") {
                toogleProyectoAsignado(false);
            } else {
                toogleProyectoAsignado(true);
            }
        });

        document.getElementById('sede_id').addEventListener('change', function(e) {
            const direction = e.target.options[e.target.selectedIndex].getAttribute('data-direction');
            setDirectionOnInput(direction);
        })
        const setDirectionOnInput = (direction) => {
            document.getElementById('direccion').value = direction;
        }
    })

    function initInpusToMoneyFormat() {
        document.querySelectorAll("input[data-type='currency']").forEach(element => {
            formatCurrency($(element));
        })
    }

    function inputsToMoneyFormat() {
        $("input[data-type='currency']").on({
            init: function() {
                console.log(this);
            },
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });
    }
</script>
