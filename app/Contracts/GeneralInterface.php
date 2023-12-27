<?php

namespace App\Contracts;

use App\Http\Requests\GeneralRequest;
use App\Models\General;

interface GeneralInterface
{
    public function get();
    public function store(GeneralRequest $request);
    public function update(GeneralRequest $request, General $model);
    public function destroy(General $model);
}
