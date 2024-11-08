@extends('layouts.app')

@section('links')
    @vite(['resources/js/racksAvailable.js','resources/js/validations/rackBooking.js','resources/sass/racks/booking.scss'])
@endsection

@section('meta')
    <meta name="rack-id" content="{{ $rack->id }}">
@endsection

@section('content')
    <section id="booking" class="myContainer">

            <form action="{{ route('rack.book',$rack->id) }}" method="POST" id="myForm">
                @csrf


                <h2 class="bold" name="item" id="item">{{ $rack->name }}</h2></a>

                <div class="inputContainer">
                <label for="date">Giorno</label>
                <input type="date" name="date" id="date">
                <div class="error"></div>
                </div>

                <div class="inputContainer">
                    <label for="hour_id">Ora</label>
                    <select name="hour_id" id="hour_id">
                        @foreach ($hours as $hour)
                        <option value="{{$hour->id}}">{{$hour->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button class="submit" type="submit">Prenota tutti gli articoli disponibili</button>


            </form>
            <h3>Articoli disponibili: <span id="countItems"></span></h3>
            <div class="availableItems" id="availableItems">
                <p>Seleziona data ed ora per vedere gli articoli disponibili</p>
                {{-- Gestito dinamicamente da JS --}}
            </div>

    </section>

@endsection
