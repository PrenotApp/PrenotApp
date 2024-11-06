@if ($bookings->isEmpty())
    <p>Nessuna prenotazione trovata.</p>
@else
    <div id="bookingContainer">
        <section>
            @foreach ($bookings as $booking)
                <article>
                    <p>{{ $booking->user->email }}</p>
                    <a href="{{ route('item.show',$booking->item) }}">{{ $booking->item->name }}</a>
                    <p>{{ $booking->date }}</p>
                    <p>{{ $booking->hour->name}}</p>
                    @if(Auth::user()->id === $booking->user_id)
                        <form action="{{ route('booking.delete', $booking->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Elimina</button>
                        </form>
                    @endif
                </article>
            @endforeach
        </section>
    </div>
@endif
