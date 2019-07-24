<?php

namespace App\Providers;

use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(255);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if(app('defender')->hasRoles('Administrador'))
                $menu = config('adminlte.menu_admin');
            else
                $menu = config('adminlte.menu2');
            
            foreach ($menu as $item)
                $event->menu->add($item);
 
        });
    }

    /**d
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    


}
