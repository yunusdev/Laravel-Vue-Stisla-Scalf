<?php


namespace App\Providers;


use App\Contracts\CartContract;
use App\Contracts\CategoryContract;
use App\Contracts\CouponContract;
use App\Contracts\ProductContract;
use App\Contracts\ProductsImageContract;
use App\Contracts\LocalityContract;
use App\Contracts\SubCategoryContract;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CouponRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductsImageRepository;
use App\Repositories\LocalityRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [

        CategoryContract::class => CategoryRepository::class,
        SubCategoryContract::class => SubCategoryRepository::class,
        ProductContract::class => ProductRepository::class,
        ProductsImageContract::class => ProductsImageRepository::class,
        CouponContract::class => CouponRepository::class,
        CartContract::class => CartRepository::class,
        LocalityContract::class => LocalityRepository::class,

    ];

    public function register(){

    }

    public function boot(){

        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }

    }

}
