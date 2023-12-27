<?php

namespace App\Contracts;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

interface UserInterface
{
    public function get();
    public function store(UserRequest $request);
    public function update(UserUpdateRequest $request, User $model);
    public function destroy(User $model);
}
