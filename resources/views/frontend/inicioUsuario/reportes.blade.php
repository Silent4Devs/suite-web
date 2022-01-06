<style type="text/css">
    .cards_reportes{
        width: 250px;
        padding: 20px 0px;
        padding-left: 30px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: left;
        display:inline-block;
        margin: 10px;
        cursor: pointer;
        color: #888888;
    }
    .cards_reportes i{
        font-size: 16pt;
        margin-right: 10px;
    }
    .cards_reportes:hover{
        color: #345183;
        border: 1px solid #345183;
    }
</style>

<div style="text-align: center;" class="mt-5">
    <a href="{{ asset('inicioUsuario/reportes/seguridad') }}" class="cards_reportes">
        <i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
    </a>
    <a href="{{ asset('inicioUsuario/reportes/riesgos') }}" class="cards_reportes">
        <i class="fas fa-shield-virus"></i> Riesgo Identificado
    </a>
    <a href="{{ asset('inicioUsuario/reportes/quejas') }}" class="cards_reportes">
        <i class="fas fa-frown"></i> Realizar queja
    </a>
    <a href="{{ asset('inicioUsuario/reportes/denuncias') }}" class="cards_reportes">
        <i class="fas fa-hand-paper"></i> Realizar denuncia
    </a>
    <a href="{{ asset('inicioUsuario/reportes/mejoras') }}" class="cards_reportes">
        <i class="fas fa-rocket"></i> Reportar mejora
    </a>
    <a href="{{ asset('inicioUsuario/reportes/sugerencias') }}" class="cards_reportes">
        <i class="fas fa-lightbulb"></i> Realizar sugerencia
    </a>
</div>
