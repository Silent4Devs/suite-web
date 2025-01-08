@extends('layouts.tenant', ['title' => 'Application settings'])

@push('head')
@livewireStyles
@endpush

@push('body')
@livewireScripts
@endpush

@section('content')

<x-section title="Configuration" description="Settings for your application.">
  <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
    <form action="{{ route('tenant.settings.application.configuration') }}" method="POST">
      @csrf
      <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
        <div class="grid grid-cols-1 gap-6">
          <div class="col-span-12 sm:col-span-4">
            <x-form.label for="name" value="Company name"/>

            <x-form.input type="text" id="company" name="company" value="{{ old('company', tenant('company')) }}" placeholder="My company"/>

            <x-form.input-error for="company" />
          </div>
        </div>
      </div>
      <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
        <x-button type="submit">Save</x-button>
      </div>
    </form>
  </div>
</x-section>

<x-section-devider />

<x-section title="Domains" description="Manage your application's domains.">
  <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
    @livewire('domains')
    @livewire('new-domain')
    @livewire('fallback-domain')
  </div>
</x-section>

<x-section-devider />

<x-section title="Billing" description="Manage your subscription and payment methods.">
  <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
    @livewire('subscription-banner')
    @livewire('upcoming-payment')
    @livewire('billing-address')
    @livewire('invoices')
    @livewire('subscription-plan')
    @livewire('payment-method')
  </div>
</x-section>
@endsection
