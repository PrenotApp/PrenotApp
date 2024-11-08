@extends('layouts.app')

@section('links')
    @vite(['resources/sass/approved/index.scss'])
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <section id="approved" class="main-container">
        <a class="submit" href="{{ route('approved.trashed') }}">Cestino</a>
        <div class="content-container">

            <!-- Form per aggiungere un docente -->
            <form class="inputContainer" action="{{ route('approved.store') }}" method="POST" id="myForm">
                @csrf
                <div>
                    <input type="text" name="email" id="email" placeholder="Scrivi email docente">
                    <label for="email">Email</label>
                </div>
                <button class="submit" type="submit">Aggiungi docente</button>
            </form>

            <!-- Campo di ricerca con evento input -->
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input class="search" type="text" id="searchInput" placeholder="Cerca docente" value="{{ request('search') }}">
            </div>


            <!-- Lista dei docenti approvati -->
            <section class="list" id="approvedList">
                @foreach($approveds as $approved)
                    <div>
                        <h2>{{ $approved->email }}</h2>
                        <form action="{{ route('approved.delete', $approved) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="submit">Elimina</button>
                        </form>
                    </div>
                    <hr>
                @endforeach
            </section>
        </div>
    </section>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let query = this.value;

            fetch(`{{ route('approved.index') }}?search=${query}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'  // Indica che è una richiesta AJAX
                }
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('approvedList').innerHTML = data;
            })
            .catch(error => console.error('Errore:', error));
        });
        </script>

@endsection
