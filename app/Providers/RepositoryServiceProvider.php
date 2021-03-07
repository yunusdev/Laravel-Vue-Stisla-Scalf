<?php


namespace App\Providers;


use App\Contracts\CategoryContract;
use App\Contracts\SubCategoryContract;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [

        CategoryContract::class => CategoryRepository::class,
        SubCategoryContract::class => SubCategoryRepository::class

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
