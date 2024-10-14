@extends('layouts.central')

@section('content')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Create a new account
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            Or
            <a href="{{ route('central.tenants.login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                sign in to your account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form action="{{ route('central.tenants.register.submit') }}" method="POST">
                @csrf
                <div>
                    <x-form.label for="company" value="Company"/>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-form.input autocomplete="off" value="{{ old('company', '') }}" name="company" id="company" type="text" required autofocus />
                    </div>

                    <x-form.input-error for="company" />
                </div>

                <div class="mt-6">
                    <x-form.label for="name" value="Full name"/>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-form.input autocomplete="off" value="{{ old('name', '') }}" name="name" id="name" type="text" required autofocus />
                    </div>

                    <x-form.input-error for="name" />
                </div>

                <div class="mt-6">
                    <x-form.label for="domain" value="Domain"/>

                    <div class="mt-1 flex rounded-md shadow-sm">
                        <x-form.input-addon addon_text=".{{ config('tenancy.central_domains')[0] }}" autocomplete="off" value="{{ old('domain', '') }}" name="domain" id="domain" type="text" required autofocus/>
                    </div>

                    <p class="mt-2 text-xs text-gray-600">You'll be able to add a custom branded domain after you sign up.</p>

                    <x-form.input-error for="domain" />
                </div>

                <div class="mt-6">
                    <x-form.label for="email" value="Email address"/>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-form.input autocomplete="off" value="{{ old('email', '') }}" name="email" id="email" type="email" required/>
                    </div>

                    <x-form.input-error for="email" />
                </div>

                <div class="mt-6">
                    <x-form.label for="password" value="Password"/>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-form.input autocomplete="off" value="{{ old('password', '') }}" name="password" id="password" type="password" required/>
                    </div>

                    <x-form.input-error for="password" />
                </div>

                <div class="mt-6">
                    <x-form.label for="password_confirmation" value="Confirm Password"/>

                    <div class="mt-1 rounded-md shadow-sm">
                        <x-form.input autocomplete="off" value="{{ old('password_confirmation', '') }}" name="password_confirmation" id="password_confirmation" type="password" required/>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <x-button class="w-full" type="submit">Register</x-button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection