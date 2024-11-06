@extends('layouts.app')

@section('links')
    @vite(['resources/js/bookingsAvailable.js','resources/js/validations/bookingCreate.js','resources/sass/bookings/create.scss'])
@endsection

@section('meta')
    <meta name="item-id" content="{{ $item->id }}">
@endsection

@section('content')
    <section class="myContainer">
            <form action="{{ route('booking.store', $item->id) }}" method="POST" id="myForm">
                @csrf

                <label for="item">Articolo:</label>
                <a href="{{ route('item.show',$item->id) }}"><h2 class="bold" name="item" id="item">{{ $item->name }}</h2></a>

                <div class="inputContainer">
                    <label for="date">Giorno</label>
                    <input type="date" name="date" id="date">
                    <div class="error"></div>
                </div>

                <div class="inputContainer">
                    <label for="hour_id">Ora</label>
                    <select name="hour_id" id="hour_id">
                        {{-- gestito dinamicamente da js --}}
                    </select>
                    <p class="error on" id="dateError">Seleziona una data per vedere gli orari disponibili</p>
                </div>

                <div class="inputContainer">
                    <button class="submit" type="submit">Prenota</button>
                </div>
            </form>
    </section>
@endsection
