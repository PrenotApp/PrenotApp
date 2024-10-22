@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>
    <form action="{{ route('admin.delete.item', $item->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Elimina</button>
    </form>
    <h2>Prenotazioni passate:</h2>
    @foreach($bookings as $booking)
        {{ $booking->date }}
    @endforeach
@endsection
