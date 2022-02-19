<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductFavorites
{
    public function add($serialNumber)
    {
        $product = Product::findBySerialNumber($serialNumber);
        $product->favorites()->attach(Auth::user()->id);

        return $product->serial_number;
    }
}
