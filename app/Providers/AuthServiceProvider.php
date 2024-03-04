<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Api\v1\Customer;
use App\Models\Api\v1\Medicine;
use App\Policies\Api\v1\CustomerPolicy;
use App\Policies\Api\v1\MedicinePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Medicine::class => MedicinePolicy::class,
        Customer::class => CustomerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        //  $this->registerPolicies();
    }
}
