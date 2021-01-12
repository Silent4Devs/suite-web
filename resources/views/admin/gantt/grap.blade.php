@extends('layouts.admin')
@section('content')

<style type="text/css">
.graph_container{
  display:block;
  width:600px;
}
		</style>
        
<div class="card mt-5">
    
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Plan de trabajo base</strong></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <div class="graph_container">
				<canvas id="myChart"></canvas>
		</div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js">
</script>
<script>
var barOptions_stacked = {
    hover :{
        animationDuration:10
    },
    scales: {
        xAxes: [{
            label:"Duration",
            ticks: {
                beginAtZero:true,
                fontFamily: "'Open Sans Bold', sans-serif",
                fontSize:11
            },
            scaleLabel:{
                display:false
            },
            gridLines: {
            }, 
            stacked: true
        }],
        yAxes: [{
            gridLines: {
                display:false,
                color: "#fff",
                zeroLineColor: "#fff",
                zeroLineWidth: 0
            },
            ticks: {
                fontFamily: "'Open Sans Bold', sans-serif",
                fontSize:11
            },
            stacked: true
        }]
    },
    legend:{
        display:false
    },
};

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {    
    type: 'horizontalBar',
    labels: {
            render: 'value'
        },
    data: {
        labels: ["Levantamiento de información Levantamiento de información Levantamiento de información", "Análisis y Evaluación de Riesgos", "Declaración de aplicabilidad SoA", "Conformar el Comité de Seguridad"],
        
        datasets: [{
            label: '',
            data: [50,150, 300, 400, 500],
            backgroundColor: "rgba(63,103,126,0)",
            hoverBackgroundColor: "rgba(50,90,100,0)"
            
        },{
            data: [100, 100, 200, 200, 100],
            backgroundColor: ['rgba(22, 160, 133, 0.6)', 'rgba(244, 208, 63, 0.6)', 'rgba(231, 76, 60, 0.6)', 'rgba(221, 45, 60, 0.6)'],
        }]
    },
    options: barOptions_stacked,
    
});

// this part to make the tooltip only active on your real dataset
var originalGetElementAtEvent = myChart.getElementAtEvent;
myChart.getElementAtEvent = function (e) {
    return originalGetElementAtEvent.apply(this, arguments).filter(function (e) {
        return e._datasetIndex === 1;
    });
}
</script>
@endsection