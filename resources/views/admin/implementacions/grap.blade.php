<style type="text/css">
    
.accordion-container {
    width: 100%;
    margin-top: 5px;
    clear:both;
}

.accordion-titulo {
    position: relative;
    display: block;
    padding: 10px;
    font-size: 13pt;
    font-weight: 20pt;
    background: #2c3e50;
    color: #fff;
    text-decoration: none;
}
.accordion-titulo.open {
    background: #16a085;
    color: #fff;
}
.accordion-titulo:hover {
    background: #1abc9c;
}

.accordion-titulo span.toggle-icon:before {
    content:"+";
}

.accordion-titulo.open span.toggle-icon:before {
    content:"-";
}

.accordion-titulo span.toggle-icon {
    position: absolute;
    top: 0px;
    right: 20px;
    font-size: 38px;
    font-weight:bold;
}

.accordion-content {
    display: none;
    padding: 20px;
    max-height: 400px;
    overflow: scroll;
}

.accordion-content p{
    margin:0;
}

.accordion-content img {
    display: block;
    float: left;
    margin: 0 15px 10px 0;
    width: 50%;
    height: auto;
}


@media (max-width: 767px) {
    .accordion-content {
        padding: 10px 0;
    }
}






table thead{
    background-color: #eee;
}
table th{
    text-align: center;
    padding: 10px;
}
table tbody tr{
    border-bottom: 1px solid #ccc;
}

table td{
    padding: 10px;
}

</style>

    <div class="accordion-container">
        <a href="#" class="accordion-titulo">ANALISIS INICIAL<span class="toggle-icon"></span></a>
        <div class="accordion-content">
            <table>
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Actividad</th>
                        <th>Fase</th>
                        <th>Ejecutar</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Colaborador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Compromiso</th>
                        <th>Fecha Real</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($planbases as $actividadplan)
                        <tr>
                            <td>{{$actividadplan->id}}</td>
                            <td>{{$actividadplan->actividad}}</td>
                            <td>
                                @if($actividadplan->actividad_fase != null)
                                    {{$actividadplan->actividad_fase->fase_nombre}}
                                @endif
                            </td>
                            <td>{{$actividadplan->ejecutar_id}}</td>
                            <td>{{$actividadplan->estatus_id}}</td>
                            <td>{{$actividadplan->responsable_id}}</td>
                            <td>{{$actividadplan->colaborador_id}}</td>
                            <td>{{$actividadplan->fecha_inicio}}</td>
                            <td>{{$actividadplan->fecha_fin}}</td>
                            <td>{{$actividadplan->compromiso}}</td>
                            <td>{{$actividadplan->real}}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



    <div class="accordion-container">
        <a href="#" class="accordion-titulo">PLANEACIÓN<span class="toggle-icon"></span></a>
        <div class="accordion-content">    
            <table>
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Actividad</th>
                        <th>Actividad Principal</th>
                        <th>Ejecutar</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Colaborador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Compromiso</th>
                        <th>Fecha Real</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($planbases as $actividadplan)
                        <tr>
                            <td>{{$actividadplan->id}}</td>
                            <td>{{$actividadplan->actividad}}</td>
                            <td>{{$actividadplan->actividad_padre_id}}</td>
                            <td>{{$actividadplan->ejecutar_id}}</td>
                            <td>{{$actividadplan->estatus_id}}</td>
                            <td>{{$actividadplan->responsable_id}}</td>
                            <td>{{$actividadplan->colaborador_id}}</td>
                            <td>{{$actividadplan->fecha_inicio}}</td>
                            <td>{{$actividadplan->fecha_fin}}</td>
                            <td>{{$actividadplan->compromiso}}</td>
                            <td>{{$actividadplan->real}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




     <div class="accordion-container">
        <a href="#" class="accordion-titulo">SOPORTE<span class="toggle-icon"></span></a>
        <div class="accordion-content">    
            <table>
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Actividad</th>
                        <th>Actividad Principal</th>
                        <th>Ejecutar</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Colaborador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Compromiso</th>
                        <th>Fecha Real</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($planbases as $actividadplan)
                        <tr>
                            <td>{{$actividadplan->id}}</td>
                            <td>{{$actividadplan->actividad}}</td>
                            <td>{{$actividadplan->actividad_padre_id}}</td>
                            <td>{{$actividadplan->ejecutar_id}}</td>
                            <td>{{$actividadplan->estatus_id}}</td>
                            <td>{{$actividadplan->responsable_id}}</td>
                            <td>{{$actividadplan->colaborador_id}}</td>
                            <td>{{$actividadplan->fecha_inicio}}</td>
                            <td>{{$actividadplan->fecha_fin}}</td>
                            <td>{{$actividadplan->compromiso}}</td>
                            <td>{{$actividadplan->real}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



     <div class="accordion-container">
        <a href="#" class="accordion-titulo">OPERACIÓN DE SGSI<span class="toggle-icon"></span></a>
        <div class="accordion-content">    
            <table>
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Actividad</th>
                        <th>Actividad Principal</th>
                        <th>Ejecutar</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Colaborador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Compromiso</th>
                        <th>Fecha Real</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($planbases as $actividadplan)
                        <tr>
                            <td>{{$actividadplan->id}}</td>
                            <td>{{$actividadplan->actividad}}</td>
                            <td>{{$actividadplan->actividad_padre_id}}</td>
                            <td>{{$actividadplan->ejecutar_id}}</td>
                            <td>{{$actividadplan->estatus_id}}</td>
                            <td>{{$actividadplan->responsable_id}}</td>
                            <td>{{$actividadplan->colaborador_id}}</td>
                            <td>{{$actividadplan->fecha_inicio}}</td>
                            <td>{{$actividadplan->fecha_fin}}</td>
                            <td>{{$actividadplan->compromiso}}</td>
                            <td>{{$actividadplan->real}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




     <div class="accordion-container">
        <a href="#" class="accordion-titulo">EVALUACIÓN<span class="toggle-icon"></span></a>
        <div class="accordion-content">    
            <table>
                <thead class="">
                    <tr>
                        <th>No</th>
                        <thstado</th>
                        <th>Responsable</th>
                        <th>Colaborador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Compromiso</th>
                        <th>Fecha Real</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($planbases as $actividadplan)
                        <tr>
                            <td>{{$actividadplan->id}}</td>
                            <td>{{$actividadplan->actividad}}</td>
                            <td>{{$actividadplan->actividad_padre_id}}</td>
                            <td>{{$actividadplan->ejecutar_id}}</td>
                            <td>{{$actividadplan->estatus_id}}</td>
                            <td>{{$actividadplan->responsable_id}}</td>
                            <td>{{$actividadplan->colaborador_id}}</td>
                            <td>{{$actividadplan->fecha_inicio}}</td>
                            <td>{{$actividadplan->fecha_fin}}</td>
                            <td>{{$actividadplan->compromiso}}</td>
                            <td>{{$actividadplan->real}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




     <div class="accordion-container">
        <a href="#" class="accordion-titulo">MEJORA CONTINUA<span class="toggle-icon"></span></a>
        <div class="accordion-content">    
            <table>
                <thead class="">
                    <tr>
                        <th>No</th>
                        <thstado</th>
                        <th>Responsable</th>
                        <th>Colaborador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Fecha Compromiso</th>
                        <th>Fecha Real</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($planbases as $actividadplan)
                        <tr>
                            <td>{{$actividadplan->id}}</td>
                            <td>{{$actividadplan->actividad}}</td>
                            <td>{{$actividadplan->actividad_padre_id}}</td>
                            <td>{{$actividadplan->ejecutar_id}}</td>
                            <td>{{$actividadplan->estatus_id}}</td>
                            <td>{{$actividadplan->responsable_id}}</td>
                            <td>{{$actividadplan->colaborador_id}}</td>
                            <td>{{$actividadplan->fecha_inicio}}</td>
                            <td>{{$actividadplan->fecha_fin}}</td>
                            <td>{{$actividadplan->compromiso}}</td>
                            <td>{{$actividadplan->real}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>







  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    $(function(){
        $(".accordion-titulo").click(function(e){
               
            e.preventDefault();
        
            var contenido=$(this).next(".accordion-content");

            if(contenido.css("display")=="none"){ //open        
              contenido.slideDown(250);         
              $(this).addClass("open");
            }
            else{ //close       
              contenido.slideUp(250);
              $(this).removeClass("open");  
            }

        });
    });
</script>