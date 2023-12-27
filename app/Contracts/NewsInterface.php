<?php

namespace App\Contracts;

use App\Http\Requests\NewsRequest;
use App\Models\News;

interface NewsInterface
{
    public function get();
    public function store(NewsRequest $request);
    public function update(NewsRequest $request, News $model);
    public function destroy(News $model);
}
