@extends('layouts.app')

@section('content')

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

        @if (count($approveds) == 0)
            <p>Il cestino &egrave; vuoto</p>
        @else
            @foreach($approveds as $approved)
                <h2>{{ $approved->email }}</h2>
                <form action="{{ route('approved.restore', $approved->id) }}" method="POST">
                    @method('patch')
                    @csrf

                    <button>Ripristina</button>
                </form>
                <form action="{{ route('approved.forceDelete', $approved->id) }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button>Elimina</button>
                </form>
            @endforeach
        @endif

@endsection
