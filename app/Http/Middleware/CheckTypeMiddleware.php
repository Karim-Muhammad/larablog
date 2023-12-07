<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->request->age == "kid") {
            // \Log::info('This is some useful information.');
            $output = new \Symfony\Component\Console\Output\ConsoleOutput();
            $output->writeln("<info>my message</info>");
            return redirect()->route("posts.index");
        }

        // \Log::info('This is some useful information.');
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln("<info>my message</info>");
        return $next($request);
    }
}
