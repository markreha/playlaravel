<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Utility\MyLogger2;

class MySecurityMiddleware
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
        // Step 1: You can use the following to get the route URI $request->path() OR you can also use the $request->is();
        $path = $request->path();
        MyLogger2::info("Entering My Security Middleware in handle() at path: " . $path);

        // Step 2: Run the business rules that check for all URI's that you do not need to secure
        $secureCheck = true;
        if ($request->is('/') || $request->is('login6') || $request->is('dologin6') ||  $request->is('usersrest') || $request->is('usersrest/*') || $request->is('loggingservice') || $request->is('restclient'))
            $secureCheck = false;
        MyLogger2::info($secureCheck ? "Security Middleware in handle().....Needs Security" : "Security Middleware in handle().....No Security Required");

        // Step 3: If entering a secure URI with no security token then do a redirect to the root URI or Login page (note $enable variable is to easily disable security)
        //  NOTE: if you get here with secureCheck true then you are requesting a page that needs to be secured.
        //  NOTE: You will need to add additional logic to actually determine if the user is authenticated or authorized to access the requested page.
        $enable = false;
        if($enable && $secureCheck)
        {
            MyLogger2::info("Leaving My Security Middleware in handle() doing a redirect back to login");
            return redirect('/login6');
        }

        // Proceed as normal to next Middleware in the chain
        return $next($request);
    }
}
