<?php

namespace App\Services\Board;

use App\Models\Board;
use Illuminate\Support\Str;

class BoardService implements BoardInterface
{
    public function __construct(private Board $model)
    {
    }


    public function listView()
    {
        return $this->model->where('is_show', true)->paginate(15);
    }

    public function detailView(): bool
    {

        return false;
    }

    public function editView(): bool
    {

        return false;
    }

    public function create(): bool
    {

        return false;
    }

    public function update(): bool
    {

        return false;
    }

    public function delete(): bool
    {

        return false;
    }
}
