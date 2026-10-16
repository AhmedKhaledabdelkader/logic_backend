<?php

namespace App\Providers;

use App\Repositories\Contracts\AboutPageRepositoryInterface;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Repositories\Contracts\HeroSlideRepositoryInterface;
use App\Repositories\Contracts\InsightRepositoryInterface;
use App\Repositories\Contracts\RegionalRepositoryInterface;
use App\Repositories\Contracts\StatisticRepositoryInterface;
use App\Repositories\Contracts\VideoContentRepositoryInterface;
use App\Repositories\Eloquents\AboutPageRepository;
use App\Repositories\Eloquents\AuthRepository;
use App\Repositories\Eloquents\ContactRepository;
use App\Repositories\Eloquents\HeroSlideRepository;
use App\Repositories\Eloquents\InsightRepository;
use App\Repositories\Eloquents\RegionalRepository;
use App\Repositories\Eloquents\StatisticRepository;
use App\Repositories\Eloquents\VideoContentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            HeroSlideRepositoryInterface::class,
            HeroSlideRepository::class
          
        );

         $this->app->bind(
            RegionalRepositoryInterface::class,
            RegionalRepository::class
          
        );

          $this->app->bind(
            StatisticRepositoryInterface::class,
            StatisticRepository::class
          
        );

           $this->app->bind(
            VideoContentRepositoryInterface::class,
            VideoContentRepository::class
          
        );

            $this->app->bind(
            InsightRepositoryInterface::class,
            InsightRepository::class
          
        );

              $this->app->bind(
            AboutPageRepositoryInterface::class,
            AboutPageRepository::class
          
        );



              $this->app->bind(
            ContactRepositoryInterface::class,
            ContactRepository::class
          
        );

        
              $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
          
        );

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
