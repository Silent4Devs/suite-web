<h1 class="subtitulo">Mejoras</h1>
        <div>
            <div class="row" style="margin-left:3px">
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #28C2A3;">
                        <h3 class="letra-tarjeta-MYA" >En curso</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($encursoCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #FF9B65;">
                        <h3 class="letra-tarjeta-MYA" >En espera</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($enesperaCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #6C6C6C;">
                        <h3 class="letra-tarjeta-MYA" >Cerrados</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($cerradoCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
                <div class="d-flex inline col-md-3">
                    <div class="tarjetas" style="background: #E66060;">
                        <h3 class="letra-tarjeta-MYA" >Sin atender</h3>
                        <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($sinatenderCount, 2, '0', STR_PAD_LEFT) }}</h6>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="display-grafica" style="margin-left: 0px;">
                            <h3 class="titulo-graficas">Total de las mejoras</h3>
                            <hr style="margin: 0px 32px 0px 32px;">
                            <div id="TM"></div>
                        </div>
                    </div>
                    <div class="row" style="margin-left:0px">
                        <div class="col-md-6">
                            <div class="display-grafica">
                                <h3 class="titulo-graficas">Porcentaje de mejora</h3>
                                <hr style="margin: 0px 32px 0px 32px;">
                                <div id="PM"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="subtitulo">Acciones Correctivas</h1>
            <div>
                <div class="row" style="margin-left:4px;">
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #28C2A3;">
                            <h3 class="letra-tarjeta-MYA">En curso</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($encursoCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #FF9B65;">
                            <h3 class="letra-tarjeta-MYA" >En espera </h3>
                            <h6 class="datos-letra-tarjeta-MYA" >{{ str_pad($enesperaCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #6C6C6C;">
                            <h3 class="letra-tarjeta-MYA" >Cerrados</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($cerradoCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #E66060;">
                            <h3 class="letra-tarjeta-MYA" >Sin atender </h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($sinatenderCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="display-grafica">
                                <h3 class="titulo-graficas">Total de las Acciones Correctivas</h3>
                                <hr style="margin: 0px 32px 0px 32px;">
                                <div id="TAC"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="display-grafica" style="margin-left: 15px;">
                                    <h3 class="titulo-graficas">Porcentaje de Acciones Correctivas</h3>
                                    <hr style="margin: px 32px 0px 32px;">
                                    <div id="PAC"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
