@extends('layouts.app')

@section('links')
    @vite(['resources/sass/racks/create-edit.scss'])
@endsection

@section('content')
    <section class="main-container" id="create-edit">
        <div class="content-container">
            <form class="inputContainer" action="{{ route('rack.store') }}" method="POST" id="myForm">
                <div>
                    @csrf

                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" placeholder="Inserisci nome carrello">

                    @error('name')
                        <span>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <button class="submit" type="submit">Crea carrello</button>
            </form>
        </div>
    </section>
@endsection
