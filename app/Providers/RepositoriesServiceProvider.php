<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UserInterface;
use App\Repositories\UserRepository;
use App\Contracts\MapInterface;
use App\Repositories\MapRepository;
use App\Contracts\GeneralInterface;
use App\Repositories\GeneralRepository;
use App\Contracts\BlogInterface;
use App\Repositories\BlogRepository;
use App\Contracts\ProductInterface;
use App\Repositories\ProductRepository;
use App\Contracts\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Contracts\NewsInterface;
use App\Repositories\NewsRepository;
use App\Repositories\MeasurementRepository;
use App\Contracts\MeasurementInterface;
use App\Repositories\ProductImgRepository;
use App\Contracts\ProductImgInterface;
use App\Repositories\MenuRepository;
use App\Contracts\MenuInterface;
use App\Repositories\SocialMediaRepository;
use App\Contracts\SocialMediaInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(GeneralInterface::class, GeneralRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(MapInterface::class, MapRepository::class);
        $this->app->bind(BlogInterface::class, BlogRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(NewsInterface::class, NewsRepository::class);
        $this->app->bind(MeasurementInterface::class, MeasurementRepository::class);
        $this->app->bind(ProductImgInterface::class, ProductImgRepository::class);
        $this->app->bind(MenuInterface::class, MenuRepository::class);
        $this->app->bind(SocialMediaInterface::class, SocialMediaRepository::class);
    }
    public function boot(): void
    {
        //
    }
}
