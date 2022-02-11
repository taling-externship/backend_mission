<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface ArticleInterface
{
    public function store();
    public function getList();
    public function getOne($article);
    public function editForm($article);
    public function update($article);
}
