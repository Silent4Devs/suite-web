<div>
    <div>
        <style>
            .dotverde {
                height: 15px;
                width: 15px;
                background-color: #38c172;
                border-radius: 50%;
                display: inline-block;
            }
    
            .dotyellow {
                height: 15px;
                width: 15px;
                background-color: orange;
                border-radius: 50%;
                display: inline-block;
            }
    
            .dotred {
                height: 15px;
                width: 15px;
                background-color: red;
                border-radius: 50%;
                display: inline-block;
            }
        </style>
    
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="nombre"><i class="fas fa-id-card iconos-crear"></i>Nombre del
                    indicador</label>
                <span class="ml-1"> {{ $indicadoresSgsis->nombre }}</span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <div class="form-group">
                    <label for="id_proceso"><i class="fas fa-cogs iconos-crear"></i>Proceso</label>
                    <span class="ml-1">
                        {{ $indicadoresSgsis->proceso->codigo }}/{{ $indicadoresSgsis->proceso->nombre }}</span>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="formula"><i class="fas fa-square-root-alt iconos-crear"></i></i>Fórmula</label>
                <span class="ml-1"> {{ $indicadoresSgsis->formula }}</span>
            </div>
        </div>
    
    
        <div class="row">
            <div class="form-group col-sm-4">
                <div class="form-group">
                    <label for="meta"><i class="fas fa-flag-checkered iconos-crear"></i></i>Meta</label>
                    <span class="ml-1"> {{ $indicadoresSgsis->meta . $indicadoresSgsis->unidadmedida }}</span>
                </div>
            </div>
        </div>
        @include("livewire.evaluaciones.$view")
    
        <hr>
        @include('livewire.evaluaciones.table')
    </div>
    
    <script>
        window.addEventListener('contentChanged', event => {
            var inputArray = document.querySelectorAll('.slugs-inputs');
            inputArray.forEach(function(input) {
                input.value = "";
            });
        });
    
        window.addEventListener('contentChanged', event => {
            console.log("Evento2");
        });
    
        document.querySelectorAll("button.btnAñadir").forEach(function(elem) {
            elem.addEventListener('click', agregarTexto, false);
        });
    
        function agregarTexto() {
            var btnValor = this.value;
            var elInput = document.getElementById("formula");
            elInput.value += btnValor;
        }
    
        // $('#fecha').datepicker({
        //     format: "dd-mm-yyyy",
        //     todayBtn: true,
        //     orientation: "bottom right",
        //     autoclose: true,
        //     autoHide: true,
        //     beforeShowDay: function(date) {
        //         if (date.getMonth() == (new Date()).getMonth())
        //             switch (date.getDate()) {
        //                 case 4:
        //                     return {
        //                         tooltip: 'Example tooltip',
        //                             classes: 'active'
        //                     };
        //                 case 8:
        //                     return false;
        //                 case 12:
        //                     return "blue";
        //             }
        //     }
        // });
    </script>
</div>
