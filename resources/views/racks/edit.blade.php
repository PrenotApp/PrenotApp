@extends('layouts.app')

@section('links')
    @vite(['resources/sass/racks/create-edit.scss'])
@endsection

@section('content')
    <section class="main-container" id="create-edit">
        <div class="content-container">
            <form class="inputContainer" action="{{ route('rack.update',$rack->id) }}" method="POST" id="myForm">
                <div>
                    @method('PUT')
                    @csrf


                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="es: Gruppo A" value="{{ old('name', $rack->name) }}">

                    @error('name')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <button class="submit" type="submit">Modifica gruppo</button>
            </form>
        </div>
    </section>
@endsection
