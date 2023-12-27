<?php

namespace App\Contracts;

use App\Http\Requests\MeasurementRequest;
use App\Models\Measurement;

interface MeasurementInterface
{
    public function get();
    public function store(MeasurementRequest $request);
    public function update(MeasurementRequest $request, Measurement $model);
    public function destroy(Measurement $model);
}
