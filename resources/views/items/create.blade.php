@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/schoolCreate.js'])
@endsection

@section('content')
    <section class="myContainer">
        <h6>Crea articolo</h6>

        <form action="{{ route('item.store') }}" method="POST" id="myForm">
            @csrf
            <div class="inputContainer">
                <label for="category_id">Categoria</label>
                <select name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="inputContainer">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="es: Aula 12">

                @error('name')
                    <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="inputContainer">
                <label>Aggiungi al gruppo</label>
                <select name="rack_id" id="rack_id">
                    <option value="" selected>Nessuno</option>
                    @foreach($racks as $rack)
                    <option value="{{ $rack->id }}">{{ $rack->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="submit">Crea articolo</button>
        </form>
    </section>
@endsection
