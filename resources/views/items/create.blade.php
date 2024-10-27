@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/schoolCreate.js'])
@endsection

@section('content')
    <form action="{{ route('item.store') }}" method="POST" id="myForm">
        @csrf

        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="es: Aula 12">

        @error('name')
            <span>
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button type="submit">Crea item</button>
    </form>
@endsection
