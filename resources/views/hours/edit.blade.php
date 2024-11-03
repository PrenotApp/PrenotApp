@extends('layouts.app')


@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <form action="{{ route('hour.update',$hour->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ old('name', $hour->name) }}">

        <label for="start">Inizio</label>
        <input type="time" name="start" id="start" value="{{ old('start', $hour->start) }}">

        <label for="end">Fine</label>
        <input type="time" name="end" id="end" value="{{ old('end', $hour->end) }}">

        <button type="submit">Modifica</button>
    </form>
@endsection
