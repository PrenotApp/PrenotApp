@extends('layouts.app')

@section('content')
    <a href="{{ route('manager.trashed') }}">
        Cestino
    </a>

    <form action="{{ route('manager.store') }}" method="POST">
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="Scrivi il nome della scuola">

        <button type="submit">Aggiungi</button>
    </form>

    @foreach($schools as $school)
        @if ($school->code !== 'ADM908IN')
            <h2>{{ $school->name }} - <span>Codice: {{ $school->code }}</span></h2>
            <form action="{{ route('manager.delete', $school) }}" method="POST">
                @method('DELETE')
                @csrf

                <button>Elimina</button>
            </form>
        @endif
    @endforeach
@endsection
