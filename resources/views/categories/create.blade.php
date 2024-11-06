@extends('layouts.app')

@section('links')
    @vite(['resources/js/validations/categoryCreate.js', 'resources/sass/categories/create.scss'])
@endsection


@section ('content')
    <section class="main-container" id="create">
        <div class="content-container">
            <form action="{{ route('category.store') }}" method="POST" id="myForm">
                @csrf

                <div class="check">
                    @foreach($icons as $index => $icon)
                        <input class="btn-check" type="radio" id="{{ 'icon' . ($index + 1) }}" name="icon" value="{{ $icon }}" index="{{ $index }}">
                        <label  class="btn secondary-outline" for="{{ 'icon' . ($index + 1) }}">
                            <i class="{{ $icon }}"></i>
                        </label>
                    @endforeach
                </div>

                <div class="inputContainer">
                    <div>
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name">
                        <button class="submit" type="submit">Crea categoria</button>
                    </div>

                    <p class="error"></p>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

            </form>
        </div>
    </section>
@endsection
