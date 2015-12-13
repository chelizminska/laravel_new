<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ClearBreadcrumbs
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
        if (Session::has('breadcrumb_titles')) {
            Session::forget('breadcrumb_titles');
        }
        if (Session::has('breadcrumb_links')) {
            Session::forget('breadcrumb_links');
        }
        return $next($request);
    }
}
