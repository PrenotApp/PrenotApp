@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>
    @if (Auth::user()->role == 'admin')
        <form action="{{ route('admin.delete.item', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">Elimina</button>
        </form>
    @endif
    <h2>Prenotazioni passate:</h2>
    @foreach($bookings as $booking)
        {{ $booking->date }}
    @endforeach
@endsection
