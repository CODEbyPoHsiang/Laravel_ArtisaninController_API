<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Artisan;
use \Illuminate\Support\Facades\Route;

class ArtisanConsoleController extends Controller
{
    public function key_generate()
    {
        Artisan::call('key:generate');
        //去除掉 /n /r
        $key_generate_output =  trim(preg_replace('/\s+/', ' ', Artisan::output()));
        return response(['message'=> $key_generate_output]);
    }

    public function config_clear()
    {
        Artisan::call('config:clear');
        //去除掉 /n /r
        $clear_output =  trim(preg_replace('/\s+/', ' ', Artisan::output()));
        Artisan::call('config:cache');
        return response(['message'=> $clear_output]);
    }

    public function config_cache()
    {
        Artisan::call('config:cache');
        return response(['message'=>Artisan::output()]);
    }

    public function route_clear()
    {
        Artisan::call('route:clear');
        //去除掉 /n /r
        $clear_output =  trim(preg_replace('/\s+/', ' ', Artisan::output()));
        Artisan::call('route:cache');
        return response(['message'=> $clear_output]);
    }

    public function route_cache()
    {
        Artisan::call('route:cache');
        //去除掉 /n /r
        $cache_output =  trim(preg_replace('/\s+/', ' ', Artisan::output()));
        return response(['message'=> $cache_output]);
    }

    public function migrate()
    {
        Artisan::call('migrate');
        $migrate =  trim(preg_replace('/\s+/', ' ', Artisan::output()));
        return response(['message'=>$migrate]);
    }

    public function route_list()
    {
        $routeCollection = Route::getRoutes();
        $route_list = [];
        foreach ($routeCollection as $value) {
            if (strpos($value->uri, 'api') !== false) {
                $route_list[] = [
                    'HTTP Method'=>$value->methods()[0],
                    'Route'=>$value->uri(),
                    'Name' =>$value->getName(),
                    'Corresponding Action'=>$value->getActionName(),
                ];
            }
        }
        return $route_list;
    }
}