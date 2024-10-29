<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// your imports
use App\Models\Rack;
use App\Models\Booking;
use App\Models\Item;
use App\Models\Hour;

class RackController extends Controller
{
    public function create()
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
            return view('racks.create');
        }
    }

    public function store(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $data = $request->validate([
            'name' => 'required',
        ]);

        $data['school_id'] = $schoolId;

        Rack::create($data);
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $rack = Rack::findOrFail($id);
        $user = Auth::user();
        if ($user->role === 'common' || $user->school_id != $rack->school_id) {
            abort(403);
        } else {
            return view('racks.edit',compact('rack'));
        }
    }

    public function update($id, Request $request)
    {
        $rack = Rack::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
        ]);

        $rack->update($data);

        return redirect()->route('home');
    }

    public function booking($id)
    {
        $rack = Rack::findOrFail($id);
        $hours = Hour::where('school_id',Auth::user()->school_id)->get();
        if (Auth::user()->school_id !== $rack->school_id) {
            abort(403);
        } else {
            return view('racks.booking',compact('rack','hours'));
        }
    }

    private function fetchAvailableItems($rackId, $date, $hourId, $schoolId)
    {
        // Query to find items that are already booked
        $bookedItems = Booking::where('date', $date)
                        ->where('hour_id', $hourId)
                        ->where('school_id', $schoolId)
                        ->pluck('item_id')
                        ->toArray();

        // Find items that are not booked
        $availableItems = Item::whereNotIn('id', $bookedItems)
                        ->where('rack_id', $rackId)
                        ->where('school_id', $schoolId)
                        ->get();

        return $availableItems;
    }

    public function getAvailableItems(Request $request)
    {
        $user = Auth::user();
        $rackId = $request->input('rack_id');
        $date = $request->input('date');
        $hourId = $request->input('hour_id');

        $availableItems = $this->fetchAvailableItems($rackId, $date, $hourId, $user->school_id);

        return response()->json($availableItems);
    }

    public function bookAvailable(Request $request)
    {
        $user = Auth::user();
        $rackId = $request->input('rack_id');
        $date = $request->input('date');
        $hourId = $request->input('hour_id');

        // Fetch all available items
        $availableItems = $this->fetchAvailableItems($rackId, $date, $hourId, $user->school_id);

        // Create a booking for each available item
        foreach ($availableItems as $item) {
            Booking::create([
                'item_id' => $item->id,
                'user_id' => $user->id,
                'date' => $date,
                'hour_id' => $hourId,
                'school_id' => $user->school_id,
            ]);
        }

        return redirect()->route('home');
    }
}