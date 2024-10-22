@extends('layouts.app')

@section('content')
    <h1>{{ $item->name }}</h1>
    <h2>Prenotazioni passate:</h2>
    @foreach($bookings as $booking)
        {{ $booking->date }}
    @endforeach
@endsection
