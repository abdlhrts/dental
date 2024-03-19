<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //

    public function index()
    {
        return view('pages.patient.index');
    }

    public function create()
    {
        return view('pages.patient.create');
    }

    public function edit(Patient $patient)
    {
        return view('pages.patient.edit', compact('patient'));
    }
}
