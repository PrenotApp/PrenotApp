@extends('layouts.app')

@section('content')
    @if($user->role === 'admin')
        <a href="{{ route('admin.create.item') }}">
            Add an item
        </a>
        <a href="{{ route('admin.create.category') }}">
            Add a category
        </a>
    @endif
    @foreach ($groupedItems as $category => $items)
    <h2>{{ $category }}</h2>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item }}</li>  <!-- Qui stampi i nomi degli item -->
        @endforeach
    </ul>
@endforeach
@endsection
