@if ($bookings->isEmpty())
    <p>Nessuna prenotazione trovata.</p>
@else
    <div id="bookingContainer">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Articolo</th>
                    <th scope="col">Data</th>
                    <th scope="col">Orario</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->email }}</td>
                        <td><a href="{{ route('item.show',$booking->item) }}">{{ $booking->item->name }}</a></td>
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
    </div>
@endif
