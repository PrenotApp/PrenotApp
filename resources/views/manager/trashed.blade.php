@extends('layouts.app')

@section('links')
    @vite(['resources/sass/manager/trashed.scss'])
@endsection


@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

    @if(Auth::user()->role == 'manager') {{-- // only if you are the manager you can see this page --}}
    <section id="trashed">
        @if (count($schools) == 0)
            <h1>Il cestino &egrave; vuoto</h1>
        @else
            <div class="school">
                @foreach($schools as $school)
                <section class="list">
                    <div>
                        <h2>Nome: {{ $school->name }}</h2>
                        <h2>Codice: {{ $school->code }}</h2>
                    </div>

                    <section class="button">
                        <form  action="{{ route('manager.restore', $school->id) }}" method="POST">
                            @method('patch')
                            @csrf

                            <button class="restore">Ripristina</button>
                        </form>

                        <form action="{{ route('manager.forceDelete', $school->id) }}" method="POST">
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
@else
    {{@abort(403)}} {{-- // otherwhise u obtain a 403 --}}
@endif
@endsection
