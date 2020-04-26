@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}"
    class="md:w-1/2 md:mx-auto bg-card py-12 px-16 rounded shadow"
    >
        @csrf
        <h1 class="text-2xl font-normal mb-10 text-muted text-center">{{ __('Reset Password') }}</h1>
        <div class="field mb-6">
            <label for="email" class="text-default text-sm mb-2 block">{{ __('E-Mail Address') }}</label>

            <div class="control">
                <input id="email" type="email"
                    class="bg-transparent border border-muted-light rounded p-2 text-sm text-muted w-full{{ $errors->has('email') ? 'is-invalid' : ''}}"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="field mb-0">
                    <button type="submit" class="button">
                                    {{ __('Send Password Reset Link') }}
                    </button>
            </div>
        </form>
@endsection
