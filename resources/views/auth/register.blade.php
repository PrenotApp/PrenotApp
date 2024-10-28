@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/userRegistration.js','resources/js/passwordToggle.js', 'resources/js/passwordConfirmationToggle.js'])
@endsection

@section('content')
    <div class="myContainer">
        <form method="POST" action="{{ route('register') }}" id="myForm">
            @csrf

            <div class="inputContainer">
                <label for="name">Nome</label>
                <div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Es: Mario Rossi">
                    <p class="error"></p>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="inputContainer">
                <label for="email">Indirizzo email</label>
                <div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Es: mario@email.it">
                    <p class="error"></p>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="inputContainer">
                <label for="code">Codice scuola</label>
                <div>
                    <input id="code" type="text" name="code" value="{{ old('code') }}" autocomplete="code" placeholder="Es: XXXXXXXX">
                    <p class="error"></p>
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="inputContainer">
                <label for="password">Password</label>
                <div>
                    <input id="password" name="password" type="password" autocomplete="new-password">
                    <p class="error"></p>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="showPassword">
                <label class="form-check-label" for="showPassword">Mostra password</label>
            </div>
            <div class="inputContainer">
                <label for="password-confirm">Conferma password</label>
                <div>
                    <input id="password-confirm" name="password_confirmation" type="password" autocomplete="new-password">
                    <p class="error"></p>
                </div>
            </div>
            <div class="form-check mt-2">
                <input type="checkbox" class="form-check-input" id="showConfirmationPassword">
                <label class="form-check-label" for="showPassword">Mostra password</label>
            </div>
                <div>
                    <button class="submit" type="submit">Registrati</button>
                </div>
        </form>
    </div>
@endsection
