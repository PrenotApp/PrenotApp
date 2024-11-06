@extends('layouts.app')

@section('links')
    @vite(['resources/js/bookingsFilters.js'])
@endsection

@section('content')
    <section class="main-container">
        <div class="content-contaioner">
            <h1>Lista Prenotazioni</h1>
            <form id="filterForm">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <label for="start_date">Da:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">A:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4">Filtra</button>
                    </div>
                </div>
            </form>
            <div id="bookingsList">
                @include('bookings.partials.list', ['bookings' => $bookings])
            </div>
        </div>
    </section>
@endsection
