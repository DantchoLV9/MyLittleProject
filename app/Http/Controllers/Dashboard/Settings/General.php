<?php

namespace App\Http\Controllers\Dashboard\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class General extends Controller
{
    
    function index () {

        return view('dashboard.settings.general');

    }

}
