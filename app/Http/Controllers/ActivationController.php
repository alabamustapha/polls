<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function showMessage()
    {

        
        return view('users.activation');
    }
}
