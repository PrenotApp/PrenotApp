<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//your imports
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerificationController extends Controller
{
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        $user = Auth::user();
        $me = User::findOrFail($user->id);

        // Verifica se il codice di verifica è corretto
        if ($me->verification_code == $request->verification_code) {
            $me->email_verified_at = now();
            $me->save();

            return redirect()->route('home')->with('success', 'Email verificata con successo!');
        }

        return back()->withErrors(['verification_code' => 'Codice di verifica non valido.']);
    }
}
