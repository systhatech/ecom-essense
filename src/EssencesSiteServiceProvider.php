<?php 

 /**
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2020
 * SYSTHA TECH LLC. ALL RIGHT RESERVED
 * -----------------------------------------------------------
 * SALES@SYSTHATECH.COM 
 * 512 903 2202
 * WWW.SYSTHATECH.COM
 * -----------------------------------------------------------
*/

namespace Systha\EssencesSite; 

use Illuminate\Support\ServiceProvider; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Relations\Relation;
use Systha\EssencesSite\Commands\{InstallCommand, UninstallCommand};

class EssencesSiteServiceProvider extends ServiceProvider {
    
    public function register(){

        /* 
        * Registers package configs 
        * 
        * Example: config('sandbox.<key>') 
        */
        // $this->mergeConfigFrom(__DIR__.'/config/config.php', "sandbox");

    }

    public function boot(){
    
        $this->mapRelations()
            ->publishAssets()
            ->publishPublic()
            ->publishViews()
            ->loadSandboxRoutes()
            ->loadSandboxMigrations()
            ->loadSandBoxCommands();    
            
            $this->loadviews();    
    }    

    protected function mapRelations(){
        Relation::morphMap([
            // Sample 
           //  'accounts' => 'Systha\Crm\Models\Account',
            
        ]);
        return $this;
    }

    /**
     * Publishes assets with Vendor tag
     * 
     * Example: 
     * $this->publishes([
     *      __DIR__.'/..Publishable/views' => resource_path('views/sandbox')
     *   ]);
     *
     * @return $this
     */
    public function publishAssets(){
        $this->publishes(
            array_merge(
                $this->assets(),[]
            ),
            "systha-EssencesSite"
        );
        return $this;
    }

    public function publishPublic(){
        $this->publishes(
            array_merge(
                $this->public(),[]
            ),
            "systha-EssencesSite"
        );
        return $this;
    }

    /**
     * Get all the assets files
     * @param- NULL
     * @return - All Asset file path | type : Array
     */
    public function assets(){
 
        $assestDirectories = File::directories(__DIR__."/../Publishable/assets");
        $publishables = [];
        foreach($assestDirectories as $assetDir){
            $publishables[$assetDir] = __DIR__."assets/EssencesSite".basename($assetDir);
        }
        return $publishables;
    }

    /**
     * Loads routes into the Laravel project using : loadViewsFrom('path_to_view',NAMESPACE)
     * 
     * USE :  view('Namespace:view.blade.php')
     * @return $this
     */
    public function publishViews(){
        $views = File::directories(__DIR__."/../Publishable/views");
        $publishables = [];
        foreach($views as $view){
            $publishables[$view] = __DIR__."views/frontend/EssencesSite/".basename($view);
        }        

        $this->publishes(
            $publishables,
            "systha-EssencesSite"
        );
        return $this;
    }

     /**
     * Get all the Public assets files
     * @param- NULL
     * @return - All Asset file path | type : Array
     */
    public function public(){
        $assestDirectories = File::directories(__DIR__."/../Publishable/public");
        $publishables = [];
        foreach($assestDirectories as $assetDir){
            $publishables[$assetDir] = __DIR__."public/EssencesSite".basename($assetDir);
        }
        return $publishables;
    }



    protected function loadviews(){
        $this->loadViewsFrom(__DIR__.'/../resources/views','EssencesSite');;
    } 

    /**
     * Load Routes to the Laravel Package
     * Auto-load route to Laravel Project once app booted
     * 
     * @syntax $this->loadRoutesFrom($location)
     * @return $this
     */
    protected function loadSandboxRoutes(){
        Route::group([
            'middleware' => ['web', 'bindings'] ,
            'namespace' => "Systha\EssencesSite\Http\Controllers"
            ], function () {
            foreach($this->getRoutes() as $routes){
                $this->loadRoutesFrom($routes);
            }
        });
        return $this;
    }

    /**
     * Get all routes from specified route_path
     * @param- NULL
     * @return - All routes path from routes folder | type : Array
     */
    public function getRoutes(){
        $routes = File::allFiles(__DIR__."/routes");
        return array_map(function($route){
            return $route->getPathName();
        }, $routes);
    }

    /**
     * Load migrations
     * 
     * @syntax $this->loadMigrationsFrom($location)
     * @return $this
     */
    protected function loadSandboxMigrations(){
        $this->loadMigrationsFrom(__DIR__.'database/migrations');
        return $this;
    }

    /**
     * Load Package command into laravel Project
     * 
     * @return $this
     */
    public function loadSandBoxCommands(){
        $this->commands([
            InstallCommand::class,
            UninstallCommand::class,
        ]);
        return $this;
    }

}