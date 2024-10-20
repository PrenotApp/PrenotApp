<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// import models
use App\Models\School;

class ManagerController extends Controller
{
    public function indexSchool()
    {
        $schools = School::all();

        return view('manager.schools', compact('schools'));
    }

    public function createSchool()
    {

    }
}
