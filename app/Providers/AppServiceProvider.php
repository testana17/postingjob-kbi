<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Repositories\Auth\Login\LoginRepository;
use App\Repositories\Auth\Login\LoginRepositoryImplement;
use App\Services\Auth\Login\LoginService;
use App\Services\Auth\Login\LoginServiceImplement;
use App\Repositories\Auth\Register\RegisterRepository;
use App\Repositories\Auth\Register\RegisterRepositoryImplement;
use App\Services\Auth\Register\RegisterService;
use App\Services\Auth\Register\RegisterServiceImplement;
use App\Repositories\Job\JobRepository;
use App\Repositories\Job\JobRepositoryImplement;
use App\Services\Job\JobService;
use App\Services\Job\JobServiceImplement;
use App\Repositories\User\ApplicationRepository;
use App\Repositories\User\ApplicationRepositoryImplement;
use App\Services\User\ApplicationService;
use App\Services\User\ApplicationServiceImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginRepository::class, LoginRepositoryImplement::class);
        $this->app->bind(LoginService::class, LoginServiceImplement::class);
        $this->app->bind(RegisterRepository::class, RegisterRepositoryImplement::class);
        $this->app->bind(RegisterService::class, RegisterServiceImplement::class);
        $this->app->bind(JobRepository::class, JobRepositoryImplement::class);
        $this->app->bind(JobService::class, JobServiceImplement::class);
        $this->app->bind(ApplicationRepository::class, ApplicationRepositoryImplement::class);
        $this->app->bind(ApplicationService::class, ApplicationServiceImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
