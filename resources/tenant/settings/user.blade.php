@extends('layouts.tenant', ['title' => 'My account'])

@section('content')

<x-section title="Personal information" description="This information will be displayed publicly.">
  <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
    <form action="{{ route('tenant.settings.user.personal') }}" method="POST">
      @csrf
      <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
        <div class="grid grid-cols-1 gap-6">
          <div class="col-span-12 sm:col-span-4">
            <x-form.label for="name" value="Name"/>

            <x-form.input id="name" name="name" type="text" required value="{{ old('name', auth()->user()->name) }}" placeholder="John Doe" autocomplete="name"/>

            <x-form.input-error for="name" />
          </div>
          <div class="col-span-12 sm:col-span-4">
            <x-form.label for="email" value="Email address"/>

            <x-form.input id="email" name="email" type="email" required value="{{ old('email', auth()->user()->email) }}" placeholder="you@example.com"/>

            <x-form.input-error for="email" />
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

<x-section title="Password" description="Change your password." description_href="{{ route('tenant.password.request') }}" description_href_text="Forgot your current password?">
  <div class="mt-4 md:mt-0 w-full md:w-2/3 pl-0 md:pl-2">
    <form action="{{ route('tenant.settings.user.password') }}" method="POST">
      @csrf
      <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
        <div class="grid grid-cols-1 gap-6">
          <div class="col-span-12 sm:col-span-4">
            <x-form.label for="password" value="Password"/>

            <div class="mt-1 rounded-md">
              <x-form.input id="password" type="password" required name="password"/>

              <x-form.input-error for="password" />
            </div>
          </div>

          <div class="col-span-12 sm:col-span-4">
            <x-form.label for="new_password" value="New password"/>

            <div class="mt-1 rounded-md">
              <x-form.input id="new_password" type="password" required name="new_password"/>

              <x-form.input-error for="new_password" />
            </div>
          </div>

          <div class="col-span-12 sm:col-span-4">
            <x-form.label for="new_password_confirmation" value="Confirm password"/>

            <div class="mt-1 rounded-md">
              <x-form.input id="new_password_confirmation" type="password" required name="new_password_confirmation"/>
            </div>
          </div>
        </div>
      </div>

      <div class="px-4 sm:px-6 py-2 bg-gray-50 flex justify-end">
        <x-button type="submit">Save</x-button>
      </div>
    </form>
  </div>
</x-section>
@endsection

