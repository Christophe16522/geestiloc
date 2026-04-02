<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\Document;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Tenant;
use App\Policies\ContractPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\MaintenancePolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PropertyPolicy;
use App\Policies\TenantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Property::class    => PropertyPolicy::class,
        Tenant::class      => TenantPolicy::class,
        Contract::class    => ContractPolicy::class,
        Payment::class     => PaymentPolicy::class,
        Document::class    => DocumentPolicy::class,
        Maintenance::class => MaintenancePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
