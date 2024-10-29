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
        return view('racks.create');
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
}
