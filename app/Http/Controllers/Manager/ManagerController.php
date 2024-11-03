<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your import
use App\Http\Requests\CreateSchoolRequest as CreateSchoolRequest;
use Illuminate\Support\Str;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

// import models
use App\Models\School;

class ManagerController extends Controller
{
    public function indexSchool()
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
            $schools = School::all();
            return view('manager.index', compact('schools'));
        }
    }

    public function storeSchool(CreateSchoolRequest $request)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
        $data = $request->validated();

        // Genera un codice alfanumerico e lo rende uppercase
        do {
            $code = strtoupper(Str::random(8));
        } while (School::where('code', $code)->exists()); // Controlla se esiste già

        $data['code'] = $code;

        $school = new School($data);
        $school->save();

        return redirect()->route('manager.index');
        }
    }

    public function deleteSchool(School $school)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
        $school->delete(); // soft delete
        return redirect()->route('manager.index')->with('success', 'Scuola spostata nel cestino.');
        }
    }

    public function trashedSchools()
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
        $schools = School::onlyTrashed()->get();
        return view('manager.trashed', compact('schools'));
        }
    }

    public function restore($id)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
        $school = School::onlyTrashed()->where('id', $id)->firstOrFail();
        $school->restore();
        return redirect()->route('manager.trashed')->with('success', 'Scuola ripristinata con successo.');}
        }
    }

    public function forceDeleteSchool($id)
    {
        if (Auth::user()->role !== 'manager') {
            abort(403);
        } else {
        $school = School::onlyTrashed()->where('id', $id)->firstOrFail();
        $school->forceDelete();
        return redirect()->route('manager.trashed')->with('success', 'Scuola eliminata definitivamente.');
        }
    }
}