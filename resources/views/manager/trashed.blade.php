@extends('layouts.app')


@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


    @if(Auth::user()->role == 'manager') {{-- // only if you are the manager you can see this page --}}
        @if (count($schools) == 0)
            <p>Il cestino &egrave; vuoto</p>
        @else
            @foreach($schools as $school)
                <h2>{{ $school->name }} - <span>Codice: {{ $school->code }}</span></h2>

                <form action="{{ route('manager.restore', $school->id) }}" method="POST">
                    @method('patch')
                    @csrf

                    <button>Ripristina</button>
                </form>

                <form action="{{ route('manager.forceDelete', $school->id) }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <button>Elimina</button>
                </form>
            @endforeach
        @endif
    @else
        {{@abort(403)}} {{-- // otherwhise u obtain a 403 --}}
    @endif
@endsection
