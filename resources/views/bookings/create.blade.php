@extends('layouts.app')

@section('links')
    @vite(['resources/js/bookingsAvailable.js'])
@endsection

@section('content')
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <label for="item_id">Item</label>
        <select name="item_id" id="item_id">
            @foreach ($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>

        <label for="date">Giorno</label>
        <input type="date" name="date" id="date">

        <label for="hour_id">Ora</label>
        <select name="hour_id" id="hour_id">
            {{-- gestito dinamicamente da js --}}
        </select>
        <p id="dateError">Seleziona una data per vedere gli orari disponibili</p>
        
        <button type="submit">Prenota</button>
    </form>
@endsection
