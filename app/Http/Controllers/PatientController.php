<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    //

    public function index()
    {
        return view('pages.patient.index');
    }

    function create()
    {
        return view('pages.patient.create');
    }
}
