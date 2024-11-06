<!-- resources/views/approved/partials/approved-list.blade.php -->
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

