@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/timeCreate.js', 'resources/sass/hours/index.scss'])
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif
    <section id="index" class="main-container">
        <div class="content-container">
            @if(Auth::check() && Auth::user()->role !== 'common')
                <form class="add" action="{{ route('hour.store') }}" method="POST" id="myForm">
                    @csrf

                    <div class="inputContainer">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" placeholder="Inserisci nome dell'orario">
                        <p class="error"></p>

                        @error('name')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="inputContainer time">
                        <label for="start">Inizio</label>
                        <input type="time" name="start" id="start">
                    </div>


                    <div class="inputContainer time" >
                        <label for="end">Fine</label>
                        <input type="time" name="end" id="end">
                        <p id="timeEr" class="error"></p>
                    </div>


                    <button class="submit" type="submit">Crea</button>
                </form>
            @endif

            <section class="content-container list">
                @foreach($hours as $index => $hour)
                <div class="singleEl">
                    <div>
                        <h1>{{ $hour->name }}</h1>
                        <div>
                            <p>Orario: {{ $hour->start }} - {{ $hour->end }}</p>
                        </div>
                    </div>
                    @if(Auth::check() && Auth::user()->role !== 'common')
                    <div class="buttons">
                        <a class="btn btn-warning" href="{{ route('hour.edit', $hour->id) }}">Modifica</a>
                        <form action="{{ route('hour.delete', $hour->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" type="submit">Elimina</button>
                        </form>
                    </div>
                    @endif
                </div>
                @if ($index < count($hours) - 1)
                                    <hr>
                                @endif
                @endforeach
            </section>

        </div>
    </section>

@endsection
