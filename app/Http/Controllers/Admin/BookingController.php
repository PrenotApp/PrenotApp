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
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = $this->getBookingsQuery()
            ->with('hour')
            ->orderBy('date', 'desc')
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

            // Logga la richiesta per debug
            Log::info('Filter request data:', $request->all());

            // Filtri
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('date', [$request->start_date, $request->end_date]);
            }

            $bookings = $query->orderBy('date', 'asc')
                        ->get()
                        ->map(function ($booking) {
                            $booking->date = \Carbon\Carbon::parse($booking->date)->format('d/m/Y');
                            return $booking;
                        });

            $html = view('bookings.partials.list', compact('bookings'))->render();
            return response()->json(['html' => $html]);
    }

    private function getBookingsQuery() // filter by the role
    {
        $user = Auth::user();

        // Se l'utente è un admin, visualizza tutte le prenotazioni della scuola
        if ($user->role !== 'common') {
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
        return redirect()->route('booking.index')->with('success', 'Prenotazione eliminata con successo!');
    }

    public function create($id){
        $item = Item::findOrFail($id);
        $user = Auth::user();
        if ($item->school_id != $user->school_id || $user->role == 'common') {
            abort(403);
        }
        $hours = Hour::where('school_id', $user->school_id)
                        ->get();

        return view('bookings.create',compact('item','hours'));
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

    public function store(CreateBookingRequest $request, $id)
    {
        $data = $request->validated();
        $data['item_id'] = $id;
        $data['school_id'] = Auth::user()->school_id;
        $data['user_id'] = Auth::user()->id;

        $booking = Booking::create($data);
        $booking->save();
        return redirect()->route('home');
    }
}
