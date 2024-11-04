@extends('layouts.app')

@section('custom-scss')
    @vite(['resources/sass/manager/index.scss'])
@endsection

@section('links')
    @vite(['resources/js/validations/schoolCreate.js'])
@endsection


@section('content')

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section id="index">

        <div class="button">
            <a href="{{ route('manager.trashed') }}">
                Cestino
            </a>
        </div>

        <form class="inputContainer top" action="{{ route('manager.store') }}" method="POST" id="myForm">
            @csrf
            <div>
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Scrivi il nome della scuola">
            </div>

            <button class="submit" type="submit">Aggiungi</button>
        </form>

        <section class="list">
            @foreach($schools as $school)
                @if ($school->code !== 'ADM908IN')
                    <div class="school">
                        <div>
                            <h2>Nome: {{ $school->name }}</h2>
                            <h2>Codice: {{ $school->code }}</h2>
                        </div>
                        <form action="{{ route('manager.delete', $school) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <button class="submit">Elimina</button>
                        </form>
                    </div>
                    <hr>
                @endif
            @endforeach
        </div>
    </section>
@endsection
