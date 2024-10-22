<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your import
use App\Http\Requests\CreateItemRequest as CreateItemRequest;
use App\Http\Requests\CreateCategoryRequest as CreateCategoryRequest;
use App\Models\Item;
use App\Models\Category;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function createItem()
    {
        $categories = Category::all();
        return view('main.createItem', compact('categories'));
    }

    public function storeItem(CreateItemRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $data['school_id'] = $user->school_id;

        $item = Item::create($data);
        $item->save();
        return redirect()->route('home');
    }

    public function editItem($id)
    {
        $user = Auth::user();
        $school = School::where('id', $user->school_id)->firstOrFail();
        $item = Item::findOrFail($id);

        if ($item->school_id !== $school->id) {
            abort(403, 'Accesso negato: questo item non appartiene alla tua scuola.');
        }

        $categories = Category::all();
        return view('main.editItem', compact('categories', 'item'));
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $item->update($validatedData);

        return redirect()->route('home')->with('success', 'Item aggiornato con successo!');
    }

    public function createCategory()
    {
        return view('main.createCategory');
    }

    public function storeCategory(CreateCategoryRequest $request)
    {
        $data = $request->validated();


        $user = Auth::user();
        $data['school_id'] = $user->school_id;

        $category = Category::create($data);
        $category->save();
        return redirect()->route('home');
    }
}
