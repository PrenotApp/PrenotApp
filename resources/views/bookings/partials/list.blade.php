@if ($bookings->isEmpty())
    <p>Nessuna prenotazione trovata.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Ora</th>
                <th>Utente</th>
                <th>Dispositivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->hour->name}}</td>
                    <td>{{ $booking->user->email }}</td>
                    <td>{{ $booking->item->name }}</td>
                    @if(Auth::user()->id === $booking->user_id)
                        <td>
                            <form action="{{ route('booking.delete', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit">Elimina</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
