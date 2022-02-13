<?php

namespace App\Models;

interface NotifyMessage
{
    public function success($message, $title);

    public function error($message, $title);

    public function warning($message, $title);

    public function info($message, $title);
}
