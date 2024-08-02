<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function forbidden() {
        return view('backend.response.403');
    }
}
