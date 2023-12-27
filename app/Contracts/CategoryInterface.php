<?php

namespace App\Contracts;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

interface CategoryInterface
{
    public function get();
    public function store(CategoryRequest $request);
    public function update(CategoryRequest $request, Category $model);
    public function destroy(Category $model);
}
