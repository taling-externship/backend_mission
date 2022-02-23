<?php

namespace App\Http\Controllers;

use App\Contracts\LoveInterface;
use App\Http\Requests\Article\LoveRequest;
use App\Models\Love;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\LoveService;

class LoveController extends Controller
{
    public function __construct(private LoveInterface $service)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Article $article)
    {
        return $this->service->store($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Love  $love
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Love $love)
    {
        return $this->service->destroy($article, $love);
    }
}
