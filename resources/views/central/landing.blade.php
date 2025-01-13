@extends('layouts.central')

@section('content')

<div class="text-center leading-loose">
    <h1 class="font-bold text-4xl">Awesome SaaS</h1>
    <p>This is a sample landing page. Of course, replace it completely.</p>
    <p>It's meant to guide you towards the onboarding flow &mdash; the registration feature and the login feature.</p>
</div>

<div class="flex justify-center mt-4">
    <x-button as="a" href="{{ route('central.tenants.login') }}">Login</x-button>
    <x-button class="ml-2" as="a" href="{{ route('central.tenants.register') }}">Register</x-button>
</div>

@endsection