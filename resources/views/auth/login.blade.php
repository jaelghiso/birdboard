@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}"
     class="md:w-1/2 md:mx-auto bg-card py-12 px-16 rounded shadow">
        @csrf
        <h1 class="text-2xl font-normal mb-10 text-muted text-center">Login</h1>
        <div class="field mb-6">
            <label for="email" class="text-default text-sm mb-2 block">{{ __('E-Mail Address') }}</label>

            <div class="control">
                <input id="email" type="email" class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full{{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
        </div>

        <div class="field mb-6">
            <label for="password" class="text-default text-sm mb-2 block">{{ __('Password') }}</label>

            <div class="control">
                <input id="password" type="password" class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full{{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" required autocomplete="current-password">
            </div>
        </div>

        <div class="field mb-6">
            <div class="control">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="text-sm" for="remember">
                        {{ __('Remember Me') }}
                    </label>
            </div>
        </div>

        <div class="field mb-6">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="button-primary mr-2">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="text-default text-sm" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>

@endsection
