<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BoardController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('home');
    }

}
