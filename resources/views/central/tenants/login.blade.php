@extends('layouts.central')

@section('content')

<div>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
            Log in to your account
        </h2>

        <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
            Or
            <a href="{{ route('central.tenants.register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                create a new account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
            <form action="{{ route('central.tenants.login.submit') }}" method="POST">
                @csrf
                <div>
                    <x-form.label for="email" value="Email address"/>

                    <x-form.input value="{{ old('email', '') }}" id="email" name="email" type="email" required autocomplete="off" />

                    <x-form.input-error for="email" />
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <x-button class="w-full" type="submit">Login</x-button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection