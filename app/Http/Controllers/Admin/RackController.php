<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// your imports
use App\Models\Rack;

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
}
