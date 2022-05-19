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

namespace Systha\EssencesSite\Commands;

use Systha\Student\App\Models\Model\Menu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;

/**
 * Uninstalls the package
 * Do all the opposites of install command
 *
 */
class UninstallCommand extends Command {

    protected $name = "EssencesSite:uninstall";
    protected $desciption ="Uninstall clothes";

    protected function getOptions(){
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in productionn', null]
        ];
    }

    public function handle(){

        if($this->confirm(
            'Are you sure you want to uninstall this package?'
        )){
            $this->handleAssets();
            $this->handleViews();
            $this->handleSeeds();
            $this->info("EssencesSite Uninstalled successfully.\t-".now());
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('config:cache');
            $this->makeLog('Uninstalled');
        }
    }

    protected function handleAssets(){
        if(File::exists(resource_path("assets/EssencesSite"))) {
            File::deleteDirectory(resource_path("views/frontend/EssencesSite/"));
        }
        $this->info("Removed EssencesSiteAssets\t-".now());

    }

    protected function handleViews(){
        if(File::exists(resource_path("assets/EssencesSite"))) {
            File::deleteDirectory(resource_path("views/frontend/EssencesSite/"));
        }
        $this->info("Removed EssencesSite Views\t-".now());

    }

    protected function handleSeeds(){
        $this->removeMenu();
    }

    protected function removeMenu(){
        Menu::whereIn('name',[
            'EssencesSite',
            'New page'
        ])->delete();

        $this->info("Removed EssencesSite Menus\t-".now());

    }

    public function makeLog($title){
        $path = resource_path('assets/packages/package.log');

        if(!File::exists($path)){
            File::put($path,"## Logs from package[".now()."] ##\n");
        }
        File::put($path,File::get($path)."[".now()."]\t ".$title." from -Systha/EssencesSite \n");
    }
}
