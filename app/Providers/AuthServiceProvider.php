<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Realm' => 'App\Policies\RealmPolicy',
        'App\Models\Continent' => 'App\Policies\ContinentPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Landscape' => 'App\Policies\LandscapePolicy',
        'App\Models\City' => 'App\Policies\CityPolicy',
        'App\Models\River' => 'App\Policies\RiverPolicy',
        'App\Models\Lake' => 'App\Policies\LakePolicy',
        'App\Models\Biome' => 'App\Policies\BiomePolicy',
        'App\Models\Landmark' => 'App\Policies\LandmarkPolicy',
        'App\Models\Mountain' => 'App\Policies\MountainPolicy',
        'App\Models\Ocean' => 'App\Policies\OceanPolicy',
        'App\Models\Sea' => 'App\Policies\SeaPolicy',
        'App\Models\Island' => 'App\Policies\IslandPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* VIEW GATES */
        Gate::define('view-realms', function($user){
            return $user->rank->id <= 2; //admin and mods can see realms
        });

        Gate::define('view-users', function($user){
            return $user->rank->id <= 2; //admin and mods can see users
        });

        /* EDIT GATES */
        Gate::define('edit-realm', function ($user, $realm) {
            return $user->id == $realm[0]->gamemaster->id || $user->isAdmin;
        });

        Gate::define('edit-continent', function ($oUser, $oContinent) {
            return $oUser->id == $oContinent[0]->realm[0]->gamemaster->id || $oUser->isAdmin;
        });
    }
}
