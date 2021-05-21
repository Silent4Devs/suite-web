


<script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>

<style type="text/css">
  #container {
      
      margin: 1em;
  }
</style>

<ul>
   @foreach($planbases as $actividadplan)
    
   @endforeach
</ul>

<div id="container"></div>




<script>

  var today = new Date(),
    day = 1000 * 60 * 60 * 24,
    // Utility functions
    dateFormat = Highcharts.dateFormat,
    defined = Highcharts.defined,
    isObject = Highcharts.isObject,
    reduce = Highcharts.reduce;

  // Set to 00:00:00:000 today
  today.setUTCHours(0);
  today.setUTCMinutes(0);
  today.setUTCSeconds(0);
  today.setUTCMilliseconds(0);
  today = today.getTime();


  let it_ln = [

  
            {
                name: 'Rama',
                id: 'new_product',
                owner: 'Peter'
            }, 
            
        @foreach($planbases as $actividadplan)  
            {
                name: '{{$actividadplan->actividad}}',
                id: '{{$actividadplan->id}}',
                parent: 'new_product',
                start: today - day,
                end: today + (11 * day),
                completed: {
                    amount: 0.6,
                    fill: '#e80'
                },
            },
        @endforeach
  ];

  Highcharts.ganttChart('container', {

      series: [ {
        name: 'Product',
        data: it_ln,
    }],
      tooltip: {
          pointFormatter: function () {
              var point = this,
                  format = '%e. %b',
                  options = point.options,
                  completed = options.completed,
                  amount = isObject(completed) ? completed.amount : completed,
                  status = ((amount || 0) * 100) + '%',
                  lines;

              lines = [{
                  value: point.name,
                  style: 'font-weight: bold;'
              }, {
                  title: 'Start',
                  value: dateFormat(format, point.start)
              }, {
                  visible: !options.milestone,
                  title: 'End',
                  value: dateFormat(format, point.end)
              }, {
                  title: 'Completed',
                  value: status
              }, {
                  title: 'Owner',
                  value: options.owner || 'unassigned'
              }];

              return reduce(lines, function (str, line) {
                  var s = '',
                      style = (
                          defined(line.style) ? line.style : 'font-size: 0.5em;'
                      );
                  if (line.visible !== false) {
                      s = (
                          '<span style="' + style + '">' +
                          (defined(line.title) ? line.title + ': ' : '') +
                          (defined(line.value) ? line.value : '') +
                          '</span><br/>'
                      );
                  }
                  return str + s;
              }, '');
          }
      },
      title: {
          text: 'Implementación ISO 27001'
      },
      xAxis: {
          currentDateIndicator: true,
          min: today - 3 * day,
          max: today + 18 * day
      }
      
  });
</script>

<script>
    series: [ {
        name: 'Product',
        data: [{
            name: 'New product launch',
            id: 'new_product',
            owner: 'Peter'
        }, 
            
            {
                name: '{{$actividadplan->actividad}}',
                id: '{{$actividadplan->id}}',
                parent: 'new_product',
                start: today - day,
                end: today + (11 * day),
                completed: {
                    amount: 0.6,
                    fill: '#e80'
                },
          
            }

        ]
    }]
</script>




