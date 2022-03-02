<?php

use Illuminate\Support\Facades\Route;

Route::get('/attachment/article/{article}/attachment/{attachment}/{name}', 'App\\Http\\Controllers\\AttachmentController');
