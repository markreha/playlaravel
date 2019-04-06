<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Cache;

class MyTestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Creating Middlware is easy in Laravel:
        //      Step 1: Run the artisan make:middleware [Middleware Name]
        //      Step 2: Register your Middleware in /App/Http/Kernel.php
        //      Step 3: Implement your Middleware Logic BEFORE the $next() or AFTER the $next() below.
        MyLogger2::info("Entering My Test Middleware in handle()");

        // Using a Data Cache is easy in Laravel:
        //      Step 1: Get an instance of one of the Caches (in this case the File Based Cache)
        //      Step 2: Get a value from the Cache and if not in the Cache put a value in the Cache for a specified number of minutes
        if($request->username != null)
        {
            $value = Cache::store("file")->get("mydata");
            if ($value == null)
            {
                MyLogger2::info("Caching first time Username for  " . $request->username);
                Cache::store("file")->put("mydata", $request->username, 1);
            }
        }
        else
        {
            $value = Cache::store("file")->get("mydata");
            if ($value != null)
                MyLogger2::info("Getting Username from cache  " . $value);
            else
                MyLogger2::info("Could not get Username from cache (data is older than 1 minute)");
        }

        return $next($request);
    }
}
