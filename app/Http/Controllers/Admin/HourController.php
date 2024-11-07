<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your imoprts
use App\Models\Hour;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHourRequest as StoreHourRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class HourController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $hours = Hour::where('school_id', Auth::user()->school_id)
            ->get()
            ->map(function ($hour) {
                $hour->start = Carbon::createFromFormat('H:i:s', $hour->start)->format('H:i');
                $hour->end = Carbon::createFromFormat('H:i:s', $hour->end)->format('H:i');
                return $hour;
            });
        return view('hours.index', compact('hours'));
        }
    }


    public function store(Request $request)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $schoolId = Auth::user()->school_id;

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('hours')->where(function ($query) use ($schoolId) {
                    return $query->where('school_id', $schoolId);
                }),
            ],
            'start' => 'required',
            'end' => 'required|after:start',
            'school_id' => 'nullable'
        ], [
            'name.unique' => 'Esiste già un elemento con questo nome per la tua scuola.',
        ]);

        $validatedData['school_id'] = $schoolId;
        $hour = Hour::create($validatedData);

        return redirect()->route('hour.index')->with('success', 'Orario creato con successo.');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $hour = Hour::findOrFail($id);
        if (Auth::user()->role === 'common' || Auth::user()->school_id !== $hour->school_id){
            abort(403);
        }
        $hour['start'] = date('H:i', strtotime($hour['start']));
        $hour['end'] = date('H:i', strtotime($hour['end']));
        return view('hours.edit', compact('hour'));
        }
    }

    public function update(StoreHourRequest $request, $id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $hour = Hour::findOrFail($id);
        $schoolId = Auth::user()->school_id;

        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('hours')->where(function ($query) use ($schoolId) {
                    return $query->where('school_id', $schoolId);
                })->ignore($hour->id), // Ignora l'orario attuale per il controllo di unicità
            ],
            'start' => 'required',
            'end' => 'required|after:start',
            'school_id' => 'nullable',
        ], [
            'name.unique' => 'Esiste già un elemento con questo nome per la tua scuola.',
        ]);

        $hour->update($validatedData);

        return redirect()->route('hour.index')->with('success', 'Orario aggiornato con successo!');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->role === 'common') {
            abort(403);
        } else {
        $hour = Hour::findOrFail($id);
        $hour->delete();
        return redirect()->route('hour.index')->with('success', 'Orario eliminato con successo.');
        }
    }
}