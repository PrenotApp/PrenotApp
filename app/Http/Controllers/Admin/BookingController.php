<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your imports
use App\Models\Booking;
use App\Models\Item;
use App\Models\Hour;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateBookingRequest as CreateBookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = $this->getBookingsQuery()
            ->with('hour')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($booking) {
                $booking->date = \Carbon\Carbon::parse($booking->date)->format('d/m/Y');
                return $booking;
            });
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

    public function delete($id){
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('booking.index');
    }

    public function create(){
        $items = Item::where('school_id', Auth::user()->school_id)
                        ->get();
        $hours = Hour::where('school_id', Auth::user()->school_id)
                        ->get();

        return view('bookings.create',compact('items','hours'));
    }

    public function getAvailableHours(Request $request)
    {
        // Valida la richiesta (per evitare richieste incomplete)
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'date' => 'required|date'
        ]);

        $itemId = $request->input('item_id');
        $date = $request->input('date');
        $schoolId = Auth::user()->school_id;

        // Recupera tutte le ore della scuola
        $hours = Hour::where('school_id', $schoolId)->get();

        // Trova le ore già prenotate
        $bookedHours = Booking::where('item_id', $itemId)
                        ->where('date', $date)
                        ->pluck('hour_id');

        // Filtra le ore disponibili
        $availableHours = $hours->filter(function($hour) use ($bookedHours) {
            return !$bookedHours->contains($hour->id);
        });

        // Restituisce la lista delle ore disponibili come JSON
        return response()->json($availableHours);
    }

    public function store(CreateBookingRequest $request)
    {
        $data = $request->validated();
        $data['school_id'] = Auth::user()->school_id;
        $data['user_id'] = Auth::user()->id;

        $booking = Booking::create($data);
        $booking->save();
        return redirect()->route('booking.index');
    }
}
