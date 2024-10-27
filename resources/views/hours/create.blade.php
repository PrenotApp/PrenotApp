@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/timeCreate.js'])
@endsection

@section('content')
    <form action="{{ route('hour.store') }}" method="POST" id="myForm">
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name" id="name">
        <p class="error"></p>

        @error('name')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="start">Inizio</label>
        <input type="time" name="start" id="start">

        <label for="end">Fine</label>
        <input type="time" name="end" id="end">
        <p id="timeEr" class="error"></p>

        <button type="submit">Crea</button>
    </form>
@endsection
