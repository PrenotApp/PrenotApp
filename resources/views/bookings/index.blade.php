@extends('layouts.app')

@section('links')
    @vite(['resources/js/bookingsFilters.js','resources/sass/bookings/index.scss'])
@endsection

@section('content')
    <section class="main-container">
        <div class="content-container">
            <h1 class="bold">Prenotazioni</h1>
            <form id="filterForm">
                @csrf

                <div class="horizontal">
                    <div class="inputContainer">
                        <label for="start_date">Da:</label>
                        <input type="date" name="start_date" id="start_date">
                    </div>
                    <div class="inputContainer">
                        <label for="end_date">A:</label>
                        <input type="date" name="end_date" id="end_date">
                    </div>
                    <div class="inputContainer submitContainer">
                        <button type="submit" class="submit">Filtra</button>
                    </div>
                </div>
            </form>
            <div id="bookingsList">
                @include('bookings.partials.list', ['bookings' => $bookings])
            </div>
        </div>
    </section>
@endsection
