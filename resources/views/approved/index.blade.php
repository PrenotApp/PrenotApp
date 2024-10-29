@extends('layouts.app')

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('approved.trashed') }}">
        Cestino
    </a>

    <form action="{{ route('approved.store') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input type="text" name="email" id="email">


        <button type="submit">Aggiungi docente</button>
    </form>

    @foreach($approveds as $approved)
            <h2>{{ $approved->email }} </h2>
            <form action="{{ route('approved.delete', $approved) }}" method="POST">
                @method('DELETE')
                @csrf

                <button>Elimina</button>
            </form>
    @endforeach
@endsection
