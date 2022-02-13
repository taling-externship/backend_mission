<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\BoardUpdateRequest;
use App\Http\Requests\Board\BoardWriteRequest;
use App\Models\Board;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BoardController extends Controller
{
    /**
     * [View] 목록 페이지
     * @return Application|Factory|View
     */
    public function list(Request $search): Application|Factory|View
    {
        $boards = Board::where('is_show', true);
        if (isset($search['search'])) {
            $keyword = Str::of($search['search'])->trim();
            $boards = $boards->where('title', 'LIKE', "%$keyword%");
        }
        $boards = $boards->paginate(15);
        return view('boards.list', compact('boards'));
    }

    /**
     * [View] 상세 페이지
     * @param Request $request
     * @return Application|Factory|View
     */
    public function detail(Request $request): Application|Factory|View
    {
        $slug_id = explode('-', $request->slug)[0];
        $board = Board::where('is_show', true)
            ->where('slug_id', '$slug_id')
            ->first();
        // boards 가 없는 경우 404 Network Tab 404 로 전환
        if (!$board) {
            abort(404);
        }

        $next = Board::where('id', '>', $board->id)->first();
        return view('boards.detail', compact('board', 'next'));
    }

    /**
     * [View]: 편집 페이지
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request): Application|Factory|View
    {
        $board = Board::find($request->id);
        // boards 가 없는 경우 404 Network Tab 404 로 전환
        if (!$board) {
            abort(404);
        }

        return view('boards.edit', compact('board'));
    }

    /**
     * [View]: 작성 페이지
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('boards.create');
    }

    /**
     * [Event]: 수정
     * @param BoardUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(BoardUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $result = Board::where('id', $validated['id'])->update([
            'title' => Str::of($validated['title'])->trim(),
            'body' => Str::of($validated['body'])->trim(),
            'slug_id' => $validated['slug_id'],
            'slug' => $validated['slug'],
        ]);

        if (!$result) {
            abort(500);
        }
        return redirect()->route('boards');
    }

    /**
     * [Event]: 작성
     * @param BoardWriteRequest $request
     * @return RedirectResponse
     */
    public function write(BoardWriteRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $result = Board::create([
            'title' => Str::of($validated['title'])->trim(),
            'body' => Str::of($validated['body'])->trim(),
            'slug_id' => $validated['slug_id'],
            'slug' => $validated['slug'],
        ]);

        if (!$result) {
            abort(500);
        }
        return redirect()->route('boards');
    }

    /**
     * [Event] 삭제
     * @param Int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        Board::where('id', $id)->delete();
        return redirect()->route('boards');
    }
}
