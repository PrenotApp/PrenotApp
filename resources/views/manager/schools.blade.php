@extends('layouts.app')

@section('content')
    @if(Auth::user()->role == 'manager') {{-- # only if you are the manager you can see this page --}}
        @foreach($schools as $school)
            <h1>{{ $school->name }}</h1>
        @endforeach
    @else
        {{@abort(404)}} {{-- # otherwhise u obtain a 404 --}}
    @endif
@endsection
