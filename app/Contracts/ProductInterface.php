<?php

namespace App\Contracts;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

interface ProductInterface
{
    public function get();
    public function getWith($string);
    public function store(ProductRequest $request);
    public function update(ProductRequest $request, Product $model);
    public function destroy(Product $model);
}
