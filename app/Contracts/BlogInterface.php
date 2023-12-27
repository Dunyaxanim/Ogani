<?php

namespace App\Contracts;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;

interface BlogInterface
{
    public function get();
    public function store(BlogRequest $request);
    public function update(BlogRequest $request, Blog $model);
    public function destroy(Blog $model);
}
