<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// your import
use App\Http\Requests\CreateSchoolRequest as CreateSchoolRequest;
use Illuminate\Support\Str;

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
        $data['code'] = strtoupper(Str::random(8));

        $school = new School($data);
        $school->save();

        return redirect()->route('manager.index');
    }
}
