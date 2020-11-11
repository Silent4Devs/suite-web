@extends('layouts.admin')
@section('content')

<div class="card" style="margin-top:50px;">
  <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
      <h3 class="mb-2  text-center text-white"><strong>Calendario</strong></h3>
  </div>

    <div class="card-body">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar'></div>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,


            })
        });
</script>
@stop
