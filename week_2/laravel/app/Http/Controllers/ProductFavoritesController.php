<?php

namespace App\Http\Controllers;

use App\Facades\Notify;
use App\Http\Services\ProductFavorites;

class ProductFavoritesController extends Controller
{
    protected $service;

    public function __construct(ProductFavorites $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function store($serialNumber)
    {
        $productSerialNumber = $this->service->add($serialNumber);

        Notify::success('현재 상품 좋아요', 'Success');

        return redirect()->route('products.show', $productSerialNumber);
    }

    public function destroy($serialNumber)
    {
        $productSerialNumber = $this->service->delete($serialNumber);

        Notify::success('현재 상품 좋아요 취소', 'Success');

        return redirect()->route('products.show', $productSerialNumber);
    }
}
