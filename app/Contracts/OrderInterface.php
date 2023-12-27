<?php

namespace App\Contracts;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

interface OrderInterface
{
    public function get();
    public function store(OrderRequest $request);
    public function update(OrderRequest $request, Order $model);
    public function destroy(Order $model);
}
