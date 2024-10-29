@extends('layouts.app')

@section('content')
    @if(Auth::user()->role == 'admin')
        <form action="{{ route('item.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @if ($category->id == old('category_id', $item->category_id))
                    selected
                    @endif
                    >{{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}">

            <p>Vuoi aggiungere il tuo item a un gruppo?</p>
            <select name="rack_id" id="rack_id">
                <option value="" selected>Nessuno</option>
                @foreach($racks as $rack)
                <option value="{{ $rack->id }}">{{ $rack->name }}</option>
                @endforeach
            </select>

            <button type="submit">Modifica</button>
        </form>
    @else
        <h1>Solo gli admin possono modificare</h1>
    @endif
@endsection
