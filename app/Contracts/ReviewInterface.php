<?php

namespace App\Contracts;

use App\Models\Review;

use App\Http\Requests\ReviewRequest;
interface ReviewInterface
{
    public function get();
    public function store(ReviewRequest $request);
    public function update(ReviewRequest $request, Review $model);
    public function destroy(Review $model);
}
