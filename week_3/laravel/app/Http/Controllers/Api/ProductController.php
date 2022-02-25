<?php

namespace App\Http\Controllers\Api;

use App\Facades\DataTransferObject;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Services\ProductService;
use App\Requests\Product\IndexRequest as IndexDto;
use App\Requests\Product\StoreRequest as StoreDto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->middleware('auth:api')->only('create', 'store');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $dto = DataTransferObject::map(IndexDto::class, $request->all());
        $products = $this->service->index($dto);

        return ProductResource::collection($products);
    }

    public function store(StoreRequest $request)
    {
        $productSerialNumber = $this->service->store(
            DataTransferObject::map(StoreDto::class, $request->all())
        );

        return response()->json($productSerialNumber, 201);
    }
}
