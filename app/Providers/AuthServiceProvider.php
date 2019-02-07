<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //$gate->define('itemList', function ($user, $item) { return true; });
        //$gate->define('itemCreate', function ($user, $item) { return true; });
        //$gate->define('itemUpdate', function ($user, $item) { return $user->id == $item->user_id; });
        //$gate->define('itemDelete', function ($user, $item) { return $user->id == $item->user_id; });
    }
}
