<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $results = [];

        // 요청에 query라는 키가 들어 있다면
        if($query = $request->get(key:'query')){

            $results = Board::search($query)->paginate(5);

            return response()->json([
                'data' => $results->items(),
                'meta' => [
                    'current_page' => $results->currentPage(),
                    'last_page' => $results->lastPage(),
                    'path' => $results->path(),
                    'per_page' => $results->perPage(),
                    'hasMorePages' => $results->hasMorePages(),
                    'total' => $results->total(),
                ]
            ], Response::HTTP_OK);
        }
        else {
            return response()->json([
                'results' => null
            ], Response::HTTP_NO_CONTENT);
        }
    }
}
