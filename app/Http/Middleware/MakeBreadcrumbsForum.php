<?php

namespace App\Http\Middleware;

use App\Page;
use Closure;
use Illuminate\Support\Facades\Session;

class MakeBreadcrumbsForum
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
       if (!isset($request['id'])) {
            $request['id'] = Page::where('title', '=', 'Форум')->first()->id;
        }
        $forum_page_id = $request['id'];
        $page = Page::where('id', '=', $forum_page_id)->first();
        $breadcrumb_titles[] = $page->title;
        $breadcrumb_links[] = "/forum?id=".$page->id;
        $parent_id = $page->parent_id;
        while ($parent_id != 0) {
            $page = Page::where('id', '=', $parent_id)->first();
            $parent_id = $page->parent_id;
            $breadcrumb_titles[] = $page->title;
            $breadcrumb_links[] = "/forum?id=".$page->id;
        }
        Session::put('breadcrumb_titles', array_reverse($breadcrumb_titles));
        Session::put('breadcrumb_links', array_reverse($breadcrumb_links));
        return $next($request);
    }
}
