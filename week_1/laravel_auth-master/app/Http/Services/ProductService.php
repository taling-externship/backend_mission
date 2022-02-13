<?php

namespace App\Http\Services;

use App\Facades\ProductNumber;
use App\Models\Category;
use App\Models\Market;
use App\Models\Product;
use App\Requests\Product\IndexRequest;
use App\Requests\Product\StoreRequest;

class ProductService
{
    public function index(IndexRequest $request)
    {
        if ($this->hasCategory($request->getCategory())) {
            $query = Category::where('name', $request->getCategory())
                ->firstOrFail()
                ->products();
        } else {
            $query = new Product;
        }

        if ($request->getKeyword()) {
            $query = $query->with('market')
                ->where('display_name', 'like', '%'.$request->getKeyword().'%');
        }

        return $query->latest()->paginate(8);
    }

    public function store(StoreRequest $request)
    {
        return Product::create([
            'serial_number' => ProductNumber::generate(),
            'name' => $request->getName(),
            'display_name' => $request->getDisplayName(),
            'description' => $request->getDescription(),
            'price' => $request->getPrice(),
            'sale_price' => $request->getSalePrice(),
            'thumb_img_path' => $request->getThumbImg()->store(Product::THUMB_IMG_PATH, 'public'),
            'category_id' => $request->getCategoryId(),
            'market_id' => $request->getMarketId(),
        ]);
    }

    public function update(StoreRequest $request, $serialNumber)
    {
        $product = $this->findBySerialNumber($serialNumber);

        return tap($product)->update([
            'name' => $request->getName(),
            'display_name' => $request->getDisplayName(),
            'description' => $request->getDescription(),
            'price' => $request->getPrice(),
            'sale_price' => $request->getSalePrice(),
            'thumb_img_path' => optional($request->getThumbImg())->store(Product::THUMB_IMG_PATH, 'public') ?? $product->thumb_img_path,
            'category_id' => $request->getCategoryId(),
            'market_id' => $request->getMarketId(),
        ]);
    }

    public function destroy($serialNumber)
    {
        return tap($this->findBySerialNumber($serialNumber))->delete();
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getAllMarket()
    {
        return Market::all();
    }

    public function findBySerialNumber($serialNumber)
    {
        return Product::findBySerialNumber($serialNumber);
    }

    public function hasCategory($category)
    {
        return $category && $category !== IndexRequest::CATEGORY_ALL;
    }
}
