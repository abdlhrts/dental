<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    //
    public function index()
    {
        return view('pages.website-setting.index');
    }
}
