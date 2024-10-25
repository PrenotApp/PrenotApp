@extends('layouts.app')

@section('links')
    @vite(['resources/js/bookingsFilters.js'])
@endsection

@section('content')
    <h1>Lista Prenotazioni</h1>

    <form id="filterForm">
        <div class="row">
            <div class="col-md-3">
                <label for="data_inizio">Data Inizio:</label>
                <input type="date" name="data_inizio" id="data_inizio" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="data_fine">Data Fine:</label>
                <input type="date" name="data_fine" id="data_fine" class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Filtra</button>
            </div>
        </div>
    </form>

    <div id="bookingsList">
        @include('bookings.partials.list', ['bookings' => $bookings])
    </div>
@endsection
