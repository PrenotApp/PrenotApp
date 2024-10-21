<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// imported
use Illuminate\Support\Facades\Auth;
use App\Models\School;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $school = School::where('id', $user->school_id)->firstOrFail();
        $items = $school->items;

        return view('main.index', compact('user','items'));
    }
}
