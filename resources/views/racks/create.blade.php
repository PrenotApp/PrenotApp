@extends('layouts.app')

@section('content')
    <form action="{{ route('rack.store') }}" method="POST" id="myForm">
        @csrf


        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="es: Gruppo A">

        @error('name')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button type="submit">Crea gruppo</button>
    </form>
@endsection
