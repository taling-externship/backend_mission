<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Article\ArticleRequest;
use App\Services\AbstractArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __construct(private AbstractArticleService $service)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View | RedirectResponse | JsonResponse
    {
        return $this->service->getList();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     * @return \Illuminate\Http\RedirectResponse : if not login user
     */
    public function create(): View | RedirectResponse
    {
        return $this->service->createForm();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Article\ArticleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleRequest $request): RedirectResponse | JsonResponse
    {
        return $this->service->store($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Article $article): View | JsonResponse
    {
        return $this->service->getOne($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Article $article): View
    {
        return $this->service->editForm($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Article\ArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse | JsonResponse
    {
        return $this->service->update($request->validated(), $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse | JsonResponse
    {
        return $this->service->delete($article);
    }
}
