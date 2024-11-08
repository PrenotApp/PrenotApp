@extends('layouts.app')

@section('links')
    @vite(['resources/js/passwordToggle.js', 'resources/js/passwordConfirmationToggle.js','resources/js/validations/resetPassword.js'])
@endsection

@section('content')
<div class="myContainer">
    <div>Ripristina password</div>

    <form method="POST" action="{{ route('password.update') }}" id="myForm">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="inputContainer">
            <label for="email">Indirizzo email</label>

            <div>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="es: mario@gmail.com" autocomplete="email" autofocus>

                <p class="error"></p>
            </div>
        </div>

        <div class="inputContainer">
            <label for="password">Password</label>

            <div>
                <input id="password" type="password" name="password" autocomplete="new-password">

                <p class="error"></p>

            </div>
        </div>

        <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="showPassword">
            <label class="form-check-label" for="showPassword">Mostra password</label>
        </div>

        <div class="inputContainer">
            <label for="password-confirm">Conferma password</label>

            <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password">

            <p class="error"></p>
        </div>


        <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" id="showConfirmationPassword">
            <label class="form-check-label" for="showPassword">Mostra password</label>
        </div>

        <button type="submit" class="submit">Ripristina password</button>
    </form>
</div>
@endsection
