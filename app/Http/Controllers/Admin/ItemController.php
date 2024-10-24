<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your imports
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\School;
use App\Models\Category;
use App\Http\Requests\CreateItemRequest;

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

        $bookings = $item->bookings();
        return view('items.show', compact('bookings','item'));
    }

    public function create()
    {
        $categories = Category::where('school_id', Auth::user()->school_id)
            ->get();
        return view('items.create', compact('categories'));
    }

    public function store(CreateItemRequest $request)
    {
        dd($request);

        $data = $request->validated();
        $user = Auth::user();
        $data['school_id'] = $user->school_id;

        $item = Item::create($data);
        $item->save();
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $school = School::where('id', $user->school_id)->firstOrFail();
        $item = Item::findOrFail($id);

        if ($item->school_id !== $school->id) {
            abort(403);
        }

        $categories = Category::where('school_id', Auth::user()->school_id)
            ->get();
        return view('items.edit', compact('categories', 'item'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $item->update($validatedData);

        return redirect()->route('home')->with('success', 'Item aggiornato con successo!');
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('home');
    }
}
