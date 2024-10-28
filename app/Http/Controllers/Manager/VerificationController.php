<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//your imports
use App\Models\User;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::where('verification_code', $request->code)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->verification_code = null;  // Pulisce il codice dopo l’uso
            $user->save();

            return redirect()->route('home')->with('status', 'Email verificata con successo!');
        }

        return back()->withErrors(['code' => 'Codice di verifica non valido.']);
    }
}
