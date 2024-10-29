@extends('layouts.app')

@section('content')
    <form action="{{ route('rack.update',$rack->id) }}" method="POST" id="myForm">
        @method('PUT')
        @csrf


        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="es: Gruppo A" value="{{ old('name', $rack->name) }}">

        @error('name')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button type="submit">Crea gruppo</button>
    </form>
@endsection
