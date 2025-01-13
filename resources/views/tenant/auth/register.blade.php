@extends('layouts.tenant')

@section('content')

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        {{ __('Sign up') }}
    </h2>
    <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
        Already have an account?
        <a href="{{ route('tenant.login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
            Sign in.
        </a>
    </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form method="POST" action="{{ route('tenant.register') }}">
            @csrf
            <div>
                <x-form.label for="name" value="Full name"/>

                <div class="mt-1 rounded-md">
                    <x-form.input name="name" id="name" type="text" required value="{{ old('name', request()->query('name')) }}" autofocus/>

                    <x-form.input-error for="name" />
                </div>
            </div>

            <div class="mt-6">
                <x-form.label for="email" value="Email address"/>

                <div class="mt-1 rounded-md">
                    <x-form.input name="email" id="email" type="email" required value="{{ old('email', request()->query('email')) }}" autofocus/>

                    <x-form.input-error for="email" />
                </div>
            </div>

            <div class="mt-6">
                <x-form.label for="password" value="Password"/>

                <div class="mt-1 rounded-md">
                    <x-form.input id="password" type="password" required name="password"/>

                    <x-form.input-error for="password" />
                </div>
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
@endsection
