<?php

namespace App\Models;

interface DataTransferObjectMapper
{
    public function map($object, $request);
}
