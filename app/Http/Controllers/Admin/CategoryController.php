<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//your imports
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
            $icons = [ // !! dopo qualsiasi modifica cambiare anche nella validation js
                'fa-solid fa-tablet-alt',
                'fa-solid fa-location-dot',
                'fa-solid fa-paperclip',
                'fa-solid fa-pen',
                'fa-brands fa-windows',
                'fa-solid fa-book',
                'fa-solid fa-print',
                'fa-regular fa-folder',
                'fa-solid fa-laptop',
                'fa-solid fa-cube',
                'fa-solid fa-puzzle-piece',
                'fa-solid fa-house',
            ];

            return view('categories.create',compact('icons'));
        }
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();
        $data['school_id'] = $user->school_id;

        $category = Category::create($data);
        $category->save();
        return redirect()->route('home')->with('success', 'Categoria creata con successo.');
    }
}