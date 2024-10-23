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
        return view('categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();


        $user = Auth::user();
        $data['school_id'] = $user->school_id;

        $category = Category::create($data);
        $category->save();
        return redirect()->route('home');
    }
}
