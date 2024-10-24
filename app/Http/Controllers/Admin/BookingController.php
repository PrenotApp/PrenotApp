<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your imports
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // $bookings = $this->getBookingsQuery()->with('hour')->orderBy('date', 'asc')->get();
        $bookings = Booking::with('hour','item')->get();
        dd($bookings);
        return view('bookings.index', compact('bookings'));
    }

    public function filter(Request $request)
    {
        $query = $this->getBookingsQuery();

        // Filtri
        if ($request->filled('data_inizio') && $request->filled('data_fine')) {
            $query->whereBetween('date', [$request->data_inizio, $request->data_fine]);
        }

        $bookings = $query->orderBy('date', 'asc')->get();

        return view('bookings.partials.list', compact('bookings'))->render();
    }

    private function getBookingsQuery() // filter by the role
    {
        $user = Auth::user();

        // Se l'utente è un admin, visualizza tutte le prenotazioni della scuola
        if ($user->role === 'admin') {
            return Booking::where('school_id', $user->school_id);
        }

        // Se l'utente è comune, visualizza solo le sue prenotazioni
        if ($user->role === 'common') {
            return Booking::where('user_id', $user->id)
                            ->where('school_id', $user->school_id);
        }

        return Booking::query(); // Per gli altri ruoli
    }
}
