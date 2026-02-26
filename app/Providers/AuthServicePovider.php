<?php

namespace App\Providers;

use App\Models\School;
use App\Policies\SchoolPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        School::class => SchoolPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
