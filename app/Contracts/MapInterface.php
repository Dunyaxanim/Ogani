<?php

namespace App\Contracts;

use App\Http\Requests\MapRequest;
use App\Models\Map;

interface MapInterface
{
    public function get();
    public function store(MapRequest $request);
    public function update(MapRequest $request, Map $model);
    public function destroy(Map $model);
}
