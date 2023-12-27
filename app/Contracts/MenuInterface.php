<?php

namespace App\Contracts;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;

interface MenuInterface
{
    public function get();
    public function store(MenuRequest $request);
    public function update(MenuRequest $request, Menu $model);
    public function destroy(Menu $model);
}
