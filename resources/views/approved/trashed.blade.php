@extends('layouts.app')

@section('links')
    @vite(['resources/sass/approved/trashed.scss'])
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section class="main-container" id="trashed">
        @if (count($approveds) == 0)
            <h1>Il cestino &egrave; vuoto</h1>
        @else
            <div class="teacher content-container">
                @foreach($approveds as $approved)
                <section class="list">
                    <h2>{{ $approved->email }}</h2>

                    <section class="button">
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
                    </section>
                </section>
                <hr>
                @endforeach
            </div>
        @endif
    </section>
@endsection
