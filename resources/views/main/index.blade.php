@extends('layouts.app')

@section('content')

    @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ route('booking.index') }}">
            Prenotazioni
        </a>
        <a href="{{ route('item.create') }}">
            Aggiungi dispositivo
        </a>
        <a href="{{ route('category.create') }}">
            Aggiungi categoria
        </a>
        <a href="{{ route('hour.create') }}">
            Aggiungi orario
        </a>
        <a href="{{ route('approved.index') }}">
            Gestisci docenti
        </a>
    @endif

    @foreach ($groupedItems as $category => $items)
        <h2>{{ $category }}</h2>
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="{{ route('item.show', $item->id) }}">{{ $item->name }}</a>
                    <a href="{{ route('item.edit', $item->id) }}">Modifica</a>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection
