<?php

use Illuminate\Support\Facades\Route;

Route::get('/attachment/{attachment}/{name}', 'App\\Http\\Actions\\AttachmentResponse');
