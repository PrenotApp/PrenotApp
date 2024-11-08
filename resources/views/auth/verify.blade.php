@extends('layouts.app')

@section('content')
    <section class="main-container" id="create">
        <div class="content-container">
            <p class="text-center">Verifica il tuo indirizzo mail</p>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    Un nuovo link &grave; stato mandato al tuo indirizzo mail
                </div>
            @endif

            <p class="d-inline">Prima di procedere, per favore cerca il link di verifica nella tua casella di posta, se non hai ricevuto la mail</p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">fai clic qui per riceverne un'altra</button>.
            </form>
        </div>
    </section>
@endsection
