<?php

namespace App\Services\Board;

use Illuminate\Database\Eloquent\Model;

interface BoardInterface
{
    /**
     * @return mixed
     */
    public function listView();

    /**
     * @return mixed
     */
    public function detailView();
    public function editView();
    public function create();
    public function update();
    public function delete();
}
