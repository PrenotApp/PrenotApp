@extends('layouts.app')

@section('content')
    @if($user->role === 'admin')
        <a href="{{ route('item.create') }}">
            Add an item
        </a>
        <a href="{{ route('category.create') }}">
            Add a category
        </a>
    @endif
    @foreach ($groupedItems as $category => $items)
        <h2>{{ $category }}</h2>
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a>
                    <a href="{{ route('item.edit', $item->id) }}">Modifica</a>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection
