<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan([
            'view-users' => 'View user details',
            'manage-users' => 'Manage user accounts',
        ]);

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
        // Tambahkan Passport route registrations secara manual jika `::routes()` tidak didukung
        Passport::loadKeysFrom(base_path('oauth'));
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
