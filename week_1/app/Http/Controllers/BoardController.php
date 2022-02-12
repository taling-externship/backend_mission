<?php

namespace App\Http\Controllers;

use App\Models\Board;
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

    public function list()
    {
        $board = Board::where('is_show', true)->paginate(15);
        return $board;
    }
}
