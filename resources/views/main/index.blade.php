@extends('layouts.app')

@section('content')
    @dump($items)
    @if($user->role === 'admin')
        <a href="{{ route('admin.create') }}">
            Add an Item
        </a>
    @endif
@endsection
