<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age = 20;
        \Log::info('This is some useful information.');
        echo "Age is: " . $age . "<br>";

        if ($age < 18) {
            $request->request->age = "kid";
        } else
            $request->request->age = "adult";

        return $next($request);
    }
}
