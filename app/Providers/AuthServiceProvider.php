<?php

namespace App\Providers;

use Laravel\Passport\Token;
use Laravel\Passport\Client;
use Laravel\Passport\AuthCode;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\PersonalAccessClient;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // if (!$this->app->routesAreCached()) {
        //     passport::routes();
        // }
        //
        // Passport::routes();
        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    }
}
