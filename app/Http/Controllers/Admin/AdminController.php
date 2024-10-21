<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your import
use App\Http\Requests\CreateItemRequest as CreateItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function create()
    {
        return view('main.create');
    }

    public function store(CreateItemRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $data['school_id'] = $user->school_id;

        dump($data);

        $item = Item::create($data);
        $item->save();
        return redirect()->route('home');
    }
}
