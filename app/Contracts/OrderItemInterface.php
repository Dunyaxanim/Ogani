<?php

namespace App\Contracts;

use App\Http\Requests\OrderItemRequest;
use App\Models\OrderItem;

interface OrderItemInterface
{
    public function get();
    public function store(OrderItemRequest $request);
    public function update(OrderItemRequest $request, OrderItem $model);
    public function destroy(OrderItem $model);

}
