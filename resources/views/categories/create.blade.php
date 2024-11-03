@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/categoryCreate.js'])
@endsection


@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <form action="{{ route('category.store') }}" method="POST" id="myForm">
        @csrf

        <div>
            @foreach($icons as $index => $icon)
            <input class="btn-check" type="radio" id="{{ 'icon' . ($index + 1) }}" name="icon" value="{{ $icon }}" index="{{ $index }}">
            <label  class="btn secondary-outline" for="{{ 'icon' . ($index + 1) }}">
                <i class="{{ $icon }}"></i>
            </label>
            @endforeach
        </div>

        <label for="name">Nome</label>
        <input type="text" name="name" id="name">

        <p class="error"></p>

        <button type="submit">Crea categoria</button>
    </form>
@endsection
