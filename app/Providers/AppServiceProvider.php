<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        $this->createDefaultRole();
    }
    /**
     * Startup custom function
     */
    private function createDefaultRole(){
        $role = Role::where('name', 'ساده')->count();
        if (!$role) {
            $role = new role;
            $role->id = 1;
            $role->name = 'ساده' ;
            $role->over_payment = 0;
            $role->save();
        }
    }

}

