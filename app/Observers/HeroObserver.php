<?php

namespace App\Observers;

use App\Models\Hero;
use Illuminate\Support\Facades\Cache;


class HeroObserver
{
    /**
     * Handle the Hero "created" event.
     */
    public function created(Hero $hero): void
    {
        Cache::forget('hero');
    }

    /**
     * Handle the Hero "updated" event.
     */
    public function updated(Hero $hero): void
    {
        Cache::forget('hero');
    }

    /**
     * Handle the Hero "deleted" event.
     */
    public function deleted(Hero $hero): void
    {
        Cache::forget('hero');
    }

    /**
     * Handle the Hero "restored" event.
     */
    public function restored(Hero $hero): void
    {
        Cache::forget('hero');
    }

    /**
     * Handle the Hero "force deleted" event.
     */
    public function forceDeleted(Hero $hero): void
    {
        Cache::forget('hero');
    }
}
