@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('register') }}"
     class="md:w-1/2 md:mx-auto bg-card py-12 px-16 rounded shadow">
        @csrf
        <h1 class="text-2xl font-normal mb-10 text-muted text-center">Register</h1>
        <div class="field mb-6">
            <label for="name" class="text-default text-sm mb-2 block">{{ __('Name') }}</label>

            <div class="control">
                <input id="name" type="text"
                class="bg-transparent border border-muted-light rounded p-2 text-xs text-muted w-full{{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            </div>
        </div>

        <div class="field mb-6">
            <label for="email" class="text-default text-sm mb-2 block">{{ __('E-Mail Address') }}</label>

            <div class="control">
                <input id="email" type="email"
                class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
        </div>

        <div class="field mb-6">
            <label for="password" class="text-default text-sm mb-2 block">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password"
                class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full{{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required autocomplete="new-password">
            </div>
        </div>

        <div class="field mb-6">
            <label for="password-confirm" class="text-default text-sm mb-2 block">{{ __('Confirm Password') }}</label>

            <div class="control">
                <input id="password-confirm" type="password" class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button-primary is-link mr-2">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>

@endsection
