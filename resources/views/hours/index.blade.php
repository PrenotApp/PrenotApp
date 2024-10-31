@extends('layouts.app')

@section('content')
    @if (Auth::user()->role !== 'common')
        <a href="{{ route('hour.create') }}">Crea orario</a>
    @endif
    @foreach($hours as $hour)
        <h1>{{ $hour->name }}</h1>
        <p>{{ $hour->start }}</p>
        <p>{{ $hour->end }}</p>
        <a href="{{ route('hour.edit', $hour->id) }}">Modifica</a>
        <form action="{{ route('hour.delete', $hour->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">Elimina</button>
        </form>
    @endforeach
@endsection
