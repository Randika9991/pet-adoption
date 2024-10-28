<?php

namespace App\Providers;

use App\Repositories\AdoptionRepository;
use App\Repositories\AdoptionRepositoryInterface;
use App\Repositories\PetRepository;
use App\Repositories\PetRepositoryInterface;
use App\Services\AdoptionService;
use App\Services\AdoptionServiceInterface;
use App\Services\PetService;
use App\Services\PetServiceInterface;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        protected $listen = [\App\Events\PetAdded::class => [\App\Listeners\SendPetAddedNotification::class,],];

        $this->app->bind(PetServiceInterface::class, PetService::class);

        $this->app->bind(PetServiceInterface::class, PetService::class);
        $this->app->bind(AdoptionServiceInterface::class, AdoptionService::class);
        $this->app->bind(PetRepositoryInterface::class, PetRepository::class);
        $this->app->bind(AdoptionRepositoryInterface::class, AdoptionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
