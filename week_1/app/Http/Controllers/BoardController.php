<?php

namespace App\Http\Controllers;

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
            $boards = $boards->where("title", "LIKE", "%$keyword%");
        }
        $boards = $boards->paginate(15);
        return view("boards.list", compact("boards"));
    }

    /**
     * [View] 상세 페이지
     * @param Request $request
     * @return Application|Factory|View
     */
    public function detail(Request $request): Application|Factory|View
    {
        $slug_id = explode("-", $request->slug)[0];
        $board = Board::where("is_show", true)
            ->where("slug_id", "$slug_id")
            ->first();

        // boards 가 없는 경우 404 Network Tab 404 로 전환
        if (!$board) {
            abort(404);
        }

        return view("boards.detail", compact("board"));
    }

    /**
     * [View]: 편집 페이지
     * @param Board $board
     * @return Application|Factory|View
     */
    public function edit(Board $board): Application|Factory|View
    {
        $board = Board::find($board->id);
        // boards 가 없는 경우 404 Network Tab 404 로 전환
        if (!$board) {
            abort(404);
        }

        return view("boards.edit", compact("board"));
    }

    /**
     * [View]: 작성 페이지
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view("boards.create");
    }

    /**
     * [Event]: 수정
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $board = Board::find($request->id);
        $result = Board::where("id", $request->id)->update([
            "title" => Str::of($request->title)->trim(),
            "body" => Str::of($request->body)->trim(),
            "slug_id" => $board->slug_id,
            "slug" => $board->slug_id."-".Str::slug(Str::of($request->title)->trim(), "-"),
        ]);

        if (!$result) {
            abort(500);
        }
        return redirect()->route("boards");
    }

    /**
     * [Event]: 작성
     * @param Request $request
     * @return RedirectResponse
     */
    public function write(Request $request): RedirectResponse
    {
        $slug_id = mt_rand(100000000, 9999999999);
        $result = Board::create([
            "title" => Str::of($request->title)->trim(),
            "body" => Str::of($request->body)->trim(),
            "slug_id" => $slug_id,
            "slug" => $slug_id."-".Str::slug(Str::of($request->title)->trim(), "-"),
        ]);

        if (!$result) {
            abort(500);
        }
        return redirect()->route("boards");
    }

    /**
     * [Event] 삭제
     * @param Int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        Board::where("id", $id)->delete();
        return redirect()->route("boards");
    }
}
