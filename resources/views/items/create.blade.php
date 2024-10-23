@extends('layouts.app')

@section('content')
    <form action="{{ route('item.store') }}" method="POST">
        @csrf

        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="name">Nome</label>
        <input type="text" name="name" id="name">

        <button type="submit">Crea item</button>
    </form>
@endsection
