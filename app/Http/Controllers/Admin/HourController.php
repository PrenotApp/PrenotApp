<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your imoprts
use App\Models\Hour;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHourRequest as StoreHourRequest;
use Illuminate\Support\Carbon;

class HourController extends Controller
{
    public function index()
    {
        $hours = Hour::where('school_id', Auth::user()->school_id)
            ->get()
            ->map(function ($hour) {
                $hour->start = Carbon::createFromFormat('H:i:s', $hour->start)->format('H:i');
                $hour->end = Carbon::createFromFormat('H:i:s', $hour->end)->format('H:i');
                return $hour;
            });
        return view('hours.index', compact('hours'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin'){
            abort(403);
        }
        return view('hours.create');
    }

    public function store(StoreHourRequest $request)
    {
        $data = $request->validated();

        $data['school_id'] = Auth::user()->school_id;

        $hour = Hour::create($data);
        $hour->save();

        return redirect()->route('hour.index');
    }

    public function edit($id)
    {
        $hour = Hour::findOrFail($id);
        if (Auth::user()->role !== 'admin' || Auth::user()->school_id !== $hour->school_id){
            abort(403);
        }
        $hour['start'] = date('H:i', strtotime($hour['start']));
        $hour['end'] = date('H:i', strtotime($hour['end']));
        return view('hours.edit', compact('hour'));
    }

    public function update(StoreHourRequest $request, $id)
    {
        $hour = Hour::findOrFail($id);
        $data = $request->validated();


        $hour->update($data);

        return redirect()->route('hour.index')->with('success', 'Orario aggiornato con successo!');
    }

    public function delete($id)
    {
        $hour = Hour::findOrFail($id);
        $hour->delete();
        return redirect()->route('hour.index');
    }
}
