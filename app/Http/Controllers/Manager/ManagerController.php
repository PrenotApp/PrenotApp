<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your import
use App\Http\Requests\CreateSchoolRequest as CreateSchoolRequest;
use Illuminate\Support\Str;
use App\Models\Item;

// import models
use App\Models\School;

class ManagerController extends Controller
{
    public function indexSchool()
    {
        $schools = School::all();
        return view('manager.index', compact('schools'));
    }

    public function storeSchool(CreateSchoolRequest $request)
    {
        $data = $request->validated();

        // Genera un codice alfanumerico e lo rende uppercase
        do {
            $code = strtoupper(Str::random(8));
        } while (Item::where('code', $code)->exists()); // Controlla se esiste già

        $school = new School($data);
        $school->save();

        return redirect()->route('manager.index');
    }

    public function deleteSchool(School $school)
    {
        $school->delete(); // soft delete
        return redirect()->route('manager.index');
    }

    public function trashedSchools()
    {
        $schools = School::onlyTrashed()->get();
        return view('manager.trashed', compact('schools'));
    }

    public function forceDeleteSchool($id)
    {
        $school = School::onlyTrashed()->where('id', $id)->firstOrFail();
        $school->forceDelete();
        return redirect()->route('manager.trashed');
    }
}
