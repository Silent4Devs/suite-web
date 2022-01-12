@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Wonderful Company
        @endcomponent
    @endslot
    Dear {{ $empleado->name }}


    <h2>{{ $capacitacion->cursoscapacitaciones }}</h2>

    <p>{{ $capacitacion->instructor }}</p>

    click on the link below to see more


    @component('mail::button', ['url' => url('/')])
        View Arrival
    @endcomponent

    Regards,<br>
    Wonderful Company Support Team

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
        @endcomponent
    @endslot
@endcomponent
