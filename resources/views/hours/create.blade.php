@extends('layouts.app')

@section('content')
    <form action="{{ route('hour.store') }}" method="POST">
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name" id="name">

        <label for="start">Inizio</label>
        <input type="time" name="start" id="start">

        <label for="end">Fine</label>
        <input type="time" name="end" id="end">

        <button type="submit">Crea</button>
    </form>
@endsection
