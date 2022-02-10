<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface ArticleInterface
{
    public function store();
    public function getList();
    public function getOne($article);
}
