@extends('layouts.app')

@section('content')
    @dump($items)
    @if($user->role === 'admin')
        <a href="{{ route('admin.create.item') }}">
            Add an item
        </a>
        <a href="{{ route('admin.create.category') }}">
            Add a category
        </a>
    @endif
@endsection
