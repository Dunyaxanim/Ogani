<?php

namespace App\Contracts;

use App\Http\Requests\ProductImgRequest;
use App\Models\ProductImg;
use App\Models\Product;

interface ProductImgInterface
{
    public function get(Product $product);
    public function store(ProductImgRequest $request);
    public function destroy(ProductImg $model);
}
