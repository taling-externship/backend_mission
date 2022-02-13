<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardSaveRequest;
use App\Models\Board;
use Illuminate\Http\Request;
use Storage;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::orderBy('id', 'desc')->paginate(10);

        return view('boards.list', [
            'boards' => $boards
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            return view('boards.save', [
                'pageMode' => 'write',
                'board' => new Board()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardSaveRequest $request)
    {
        $validated = $request->validated();
        $board = new Board();
        $board->user_id = 1;
        $board->title = $validated['title'];
        $board->body = $validated['body'];

        if($request->hasFile('img')) {
            $board->img = $request->file('img')->store('board/' . date('Y/m/d'), 'public');
        }
        $board->save();

        return redirect()->route('boards.show', $board->id)->with('success', "{$board->id}번 게시물이 작성되었습니다.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return view('boards.detail', [
            'board' => $board
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        return view('boards.save', [
            'pageMode' => 'edit',
            'board' => $board
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board
     * @return \Illuminate\Http\Response
     */
    public function update(BoardSaveRequest $request, Board $board)
    {
        $validated = $request->validated();

        $board->title = $validated['title'];
        $board->body = $validated['body'];

        if($request->hasFile('img')) {
            if($board->img) {
                Storage::disk('public')->delete($board->img);
            }
            
            $board->img = $request->file('img')->store('board/' . date('Y/m/d'), 'public');
        }

        $board->save();

        return redirect()->route('boards.show', $board->id)->with('success', "{$board->id}번 게시물을 수정하였습니다.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $id = $board->id;

        if($board->img) {
            Storage::disk('public')->delete($board->img);
        }
        
        $board->delete();

        return redirect()->route('boards.index')->with('success', "{$id}번 게시물을 삭제하였습니다.");
    }
}
