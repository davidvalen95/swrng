<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //

//        include_once ("app/Helper/HelperFunction.php");
//        include_once ("app/Helper/Constant.php");

        $this->requireAll("app/Helper/",0);
//        debug();
    }

    protected function requireAll($dir, $depth=0) {
        if ($depth > 10) {
            return;
        }
        // require all php files
        $scan = glob("$dir/*");
        foreach ($scan as $path) {
            if (preg_match('/\.php$/', $path)) {
                require_once $path;
            }
            elseif (is_dir($path)) {
                $this->requireAll($path, $depth+1);
            }
        }
    }



}
