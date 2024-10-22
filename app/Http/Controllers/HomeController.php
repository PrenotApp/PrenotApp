<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// imported
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use Illuminate\Support\Facades\DB;

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

        $items = DB::table('items')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', 'items.*')
            ->where('items.school_id', $school->id)
            ->orderBy('category_id')
            ->get();

        $groupedItems = $items->groupBy('category_name')
            ->map(function ($items) {
                return $items;
            })
            ->toArray();

        return view('main.index', compact('user','groupedItems'));
    }
}
