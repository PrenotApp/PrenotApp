@if ($bookings->isEmpty())
    <p>Nessuna prenotazione trovata.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Data</th>
                <th>Ora Inizio</th>
                <th>Ora Fine</th>
                <th>Utente</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->hour->start->format('H:i') }}</td>
                    <td>{{ $booking->hour->end->format('H:i') }}</td> {{-- Collega il modello Hour --}}
                    <td>{{ $booking->user_id }}</td> {{-- Assumi di avere un campo cliente_nome --}}
                    <td>{{ $booking->item_id }}</td> {{-- Assumi di avere un campo descrizione --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
