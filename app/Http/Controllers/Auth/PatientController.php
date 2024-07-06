<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PatientController extends Controller
{
    public function create(): View
    {
        return view('auth.register-patient');
    }
}
