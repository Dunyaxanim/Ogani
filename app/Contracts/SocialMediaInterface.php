<?php

namespace App\Contracts;

use App\Models\SocialMedia;

use App\Http\Requests\SocialMediaRequest;
interface SocialMediaInterface
{
    public function get();
    public function store(SocialMediaRequest $SocialMediaRequest);
    public function update(SocialMediaRequest $SocialMediaRequest, SocialMedia $model);
    public function destroy(SocialMedia $model);
}
