<?php

namespace App\Services\Board;

interface BoardInterface
{
    public function listView();
    public function detailView();
    public function editView();
    public function create();
    public function update();
    public function delete();
}
