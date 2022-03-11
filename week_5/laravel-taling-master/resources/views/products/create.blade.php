@extends('app')

@section('title', '상품 추가')

@section('content')
    <section class="container section-1 t-my-3">
        <div class="t-container t-mx-auto">
            <div class="card">
                <div class="card-header"><i class="fas fa-pen"></i> 상품</div>

                <div class="card-body">
                    <form class="t-grid t-grid-cols-1 t-gap-4 t-mt-4" action="{{ route('products.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="form-label">상품명(내부용)</label>
                            <input name="name" type="text" maxlength="100"
                                   class="@error('name') is-invalid @enderror form-control" placeholder="상품명(내부용)을 입력해주세요."
                                   value="{{ old('name') }}">

                            @error('name')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">상품명(노출용)</label>
                            <input name="display_name" type="text" maxlength="100"
                                   class="@error('display_name') is-invalid @enderror form-control" placeholder="상품명(노출용)을 입력해주세요."
                                   value="{{ old('display_name') }}">

                            @error('display_name')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">설명</label>
                            <textarea name="description" class="@error('description') is-invalid @enderror form-control" rows="6"
                                      placeholder="설명을 입력해주세요.">{{ old('description') }}</textarea>

                            @error('description')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">권장판매가</label>
                            <input name="price" type="number" maxlength="100"
                                   class="@error('price') is-invalid @enderror form-control" value="{{ old('price') }}"
                                   placeholder="권장판매가 입력해주세요.">

                            @error('price')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">실제판매가</label>
                            <input name="sale_price" type="number" maxlength="100"
                                   class="@error('sale_price') is-invalid @enderror form-control" value="{{ old('sale_price') }}"
                                   placeholder="실제판매가 입력해주세요.">

                            @error('sale_price')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">카테고리</label>
                            <select name="category_id" class="@error('category_id') is-invalid @enderror form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">마켓</label>
                            <select name="market_id" class="@error('market_id') is-invalid @enderror form-select">
                                @foreach($markets as $market)
                                    <option value="{{ $market->id }}">{{ $market->name }}</option>
                                @endforeach
                            </select>

                            @error('market_id')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">상품 이미지</label>
                            <input type="file" name="thumb_img" class="@error('thumb_img') is-invalid @enderror form-control">

                            @error('thumb_img')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="t-flex t-gap-4">
                            <button class="btn btn-primary t-mr-auto">
                                <i class="fas fa-pen"></i>
                                추가
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>
@endsection
