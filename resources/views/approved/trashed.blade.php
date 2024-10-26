@extends('layouts.app')

@section('content')

        @if (count($approveds) == 0)
            <p>Il cestino &egrave; vuoto</p>
        @else
            @foreach($approveds as $approved)
                <h2>{{ $approved->email }}</h2>
                <form action="{{ route('approved.forceDelete', $approved->id) }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button>Elimina</button>
                </form>
            @endforeach
        @endif

@endsection
