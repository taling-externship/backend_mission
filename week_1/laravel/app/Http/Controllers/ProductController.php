<?php

namespace App\Http\Controllers;

use App\Facades\DataTransferObject;
use App\Facades\Notify;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Services\ProductService;
use App\Requests\Product\IndexRequest as IndexDto;
use App\Requests\Product\StoreRequest as StoreDto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $dto = DataTransferObject::map(IndexDto::class, $request->all());
        $products = $this->service->index($dto);

        return view('products.index', [
            'categories' => $this->service->getAllCategory(),
            'products' => $products,
            'request' => $dto,
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'categories' => $this->service->getAllCategory(),
            'markets' => $this->service->getAllMarket(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $product = $this->service->store(
            DataTransferObject::map(StoreDto::class, $request->all())
        );

        Notify::success('상품이 추가되었습니다.', 'Success');

        return redirect()->route('products.show', $product->serial_number);
    }

    public function show($serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);

        return view('products.show', compact('product'));
    }

    public function edit($serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);

        return view('products.edit', [
            'product' => $product,
            'categories' => $this->service->getAllCategory(),
            'markets' => $this->service->getAllMarket(),
        ]);
    }

    public function update(UpdateRequest $request, $serialNumber)
    {
        $product = $this->service->update(
            DataTransferObject::map(StoreDto::class, $request->all()),
            $serialNumber
        );

        Notify::success('상품을 수정하였습니다.', 'Success');

        return redirect()->route('products.show', $product->serial_number);
    }

    public function destroy($serialNumber)
    {
        $product = $this->service->destroy($serialNumber);

        Notify::success('상품을 삭제하였습니다.', 'Success');

        return redirect()->route('products.index');
    }
}
