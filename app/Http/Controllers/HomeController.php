<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// imported
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\Category;
use Illuminate\Support\Facades\Config;
use App\Models\Rack;


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
        $categories = Category::where('school_id', $user->school_id)->get();
        $racks = Rack::where('school_id', $user->school_id)->get();

        // Invia l'email con il codice di verifica
        $verificationCode = rand(100000, 999999); // Codice di verifica generato (esempio con 6 cifre)
        // Mail::to('giordanofabrizi@gmail.com')->send(new VerifyEmail($verificationCode, $user->name));


        return view('main.index', compact('user','categories','racks'));
    }
}
