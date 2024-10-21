@extends('layouts.app')

@section('content')
    @if(Auth::user()->role == 'manager') {{-- # only if you are the manager you can see this page --}}

        {{-- <a href="{{ route('manager.create') }}">Aggiungi una scuola</a> --}}

        <form action="{{ route('manager.store') }}" method="POST">
            @csrf

            <label for="name">Nome</label>
            <input type="text" name="name" id="name" placeholder="Scrivi il nome della scuola">

            <button type="submit">Aggiungi</button>
        </form>

        @foreach($schools as $school)
            <h1>{{ $school->name }} - <span>Codice: {{ $school->code }}</span></h1>
        @endforeach
    @else
        {{@abort(404)}} {{-- # otherwhise u obtain a 404 --}}
    @endif
@endsection
