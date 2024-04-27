<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function enter()
    {
        return view('pages.code.enter');
    }

    public function invalid()
    {
        return view('pages.code.invalid');
    }
}
