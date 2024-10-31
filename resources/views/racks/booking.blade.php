@extends('layouts.app')

@section('links')
    @vite(['resources/js/racksAvailable.js'])
@endsection

@section('content')
    <form action="{{ route('rack.book',$rack->id) }}" method="POST" id="myForm">
        @csrf

        <input type="hidden" name="rack_id" value="{{ $rack->id }}" id="rack_id">

        <label>Dispositivi disponibili</label>
        <div id="availableItems">
            <p>Seleziona data ed ora per vedere i dispositivi</p>
            {{-- Gestito dinamicamente da JS --}}
        </div>

        <label for="date">Giorno</label>
        <input type="date" name="date" id="date">
        <div class="error"></div>

        <label for="hour_id">Ora</label>
        <select name="hour_id" id="hour_id">
            @foreach ($hours as $hour)
                <option value="{{$hour->id}}">{{$hour->name}}</option>
            @endforeach
        </select>

        <button type="submit">Prenota Tutti gli Item Disponibili</button>
    </form>
@endsection
