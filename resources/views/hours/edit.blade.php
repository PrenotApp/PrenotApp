@extends('layouts.app')

@section('links')
    @vite(['resources/sass/hours/edit.scss'])
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

    <section id="edit" class="main-container">
        <div class="content-container">
            <form class="add" action="{{ route('hour.update',$hour->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="inputContainer">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $hour->name) }}">
                </div>

                <div class="inputContainer time">
                    <label for="start">Inizio</label>
                    <input type="time" name="start" id="start" value="{{ old('start', $hour->start) }}">
                </div>

                <div class="inputContainer time">
                    <label for="end">Fine</label>
                    <input type="time" name="end" id="end" value="{{ old('end', $hour->end) }}">
                </div>

                <button class="submit" type="submit">Modifica</button>
            </form>
        </div>
    </section>

@endsection
