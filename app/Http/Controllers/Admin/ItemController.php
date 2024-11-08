<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your imports
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\School;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Models\Rack;

class ItemController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        $school = School::where('id', $user->school_id)->firstOrFail();
        $item = Item::findOrFail($id);

        if ($item->school_id !== $school->id) {
            abort(403);
        }

        $bookings = $item->bookings;
        return view('items.show', compact('bookings','item'));
    }

    public function create()
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $categories = Category::where('school_id', Auth::user()->school_id)
            ->get();
        $racks = Rack::where('school_id', Auth::user()->school_id)->get();
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
            return view('items.create', compact('categories','racks'));
        }
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $schoolId = Auth::user()->school_id;

        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('items')->where(function ($query) use ($schoolId) {
                    return $query->where('school_id', $schoolId);
                }),
            ],
            'category_id' => 'required',
            'rack_id' => 'nullable|exists:racks,id'
        ], [
            'name.unique' => 'Esiste già un oggetto con questo nome',
        ]);

        $data['rack_id'] = $request->rack_id ? $request->rack_id : null; // se e' null o '', metti null

        $data['school_id'] = $schoolId;

        $item = Item::create($data);
        $item->save();
        return redirect()->route('home')->with('success', 'Dispositivo creato con successo.');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $user = Auth::user();
        $school = School::where('id', $user->school_id)->firstOrFail();
        $item = Item::findOrFail($id);
        $racks = Rack::where('school_id', $user->school_id)->get();
        $categories = Category::where('school_id', Auth::user()->school_id)
            ->get();

        if ($item->school_id !== $school->id || $user->role === 'common') {
            abort(403);
        } else {
            return view('items.edit', compact('categories', 'item','racks'));
        }
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'rack_id' => 'nullable|exists:racks,id'
        ]);

        $validatedData['rack_id'] = $request->rack_id ? $request->rack_id : null; // se e' null o '', metti null

        $item->update($validatedData);

        return redirect()->route('home')->with('success', 'Dispositivo aggiornato con successo!');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('home')->with('success', 'Dispositivo eliminato con successo.');
        }
    }
}
