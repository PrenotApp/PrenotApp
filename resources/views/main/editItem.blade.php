@extends('layouts.app')

@section('content')
    @if(0 == 0)
    @endif
    <form action="{{ route('admin.update.item', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="category_id">Category</label>
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

        <button type="submit">Modifica</button>
    </form>
@endsection
