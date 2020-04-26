@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('password.confirm') }}"
class="md:w-1/2 md:mx-auto bg-card py-12 px-16 rounded shadow"
>
        @csrf
        <h1 class="text-2xl font-normal mb-10 text-muted text-center">{{ __('Confirm Password') }}</h1>
        <h5>{{ __('Please confirm your password before continuing.') }}</h5>
        <div class="field mb-6">
            <label for="password" class="text-default text-sm mb-2 block">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full{{ $errors->has('password') ? 'is-invalid' : ''}}"
                name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="field mb-0">
            <button type="submit" class="button">
                {{ __('Confirm Password') }}
            </button>

            @if (Route::has('password.request'))
                <a class="button" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                 </a>
            @endif
        </div>
    </form>
@endsection
