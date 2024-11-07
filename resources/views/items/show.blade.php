@extends('layouts.app')

@section('links')
    @vite(['resources/sass/items/show.scss'])
@endsection

@section('content')
    <div class="main-container">
        <section class="content-container">
            <label for="item">Articolo:</label>
            <h2 class="bold">{{ $item->name }}</h2>

            <div>
                <a class="btn btn-primary d-inline py-2" href="{{ route('booking.create',$item) }}">Prenota</a>
                @if (Auth::user()->role !== 'common')
                    <form class="d-inline" action="{{ route('item.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                @endif
            </div>
            <h3>Prenotazioni:</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Orario</th>
                            <th scope="col">Data</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->hour->name }}</td>
                                <td>
                                    @if(Auth::user()->id === $booking->user_id)
                                        <form action="{{ route('booking.delete', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit">Elimina</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </section>
    </div>
@endsection
