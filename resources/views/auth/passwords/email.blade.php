@extends('layouts.app')

@section('content')
    <div class="myContainer">
        <div>
            <p>Resetta la tua password</p>
        </div>

        @if (session('status'))
            <div role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="inputContainer">
                <label for="email" >Indirizzo email</label>

                <div>
                    <input id="email" type="email"  name="email" value="{{ old('email') }}" placeholder="es: mario@gmail.com" autocomplete="email" autofocus>
                    @error('email')
                        <spanrole="alert">
                            <strong>{{ $message }}</strong>
                        </spanrole=>
                    @enderror
                </div>
            </div>

            <button class="submit" type="submit">Invia il link</button>
        </form>
    </div>
@endsection
