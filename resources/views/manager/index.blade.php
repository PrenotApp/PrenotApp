@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/schoolCreate.js'])
@endsection


@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('manager.trashed') }}">
        Cestino
    </a>

    <form action="{{ route('manager.store') }}" method="POST" id="myForm">
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
