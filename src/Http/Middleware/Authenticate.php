<?php

namespace Spacebib\EventViewer\Http\Middleware;

use Spacebib\EventViewer\EventViewer;

class Authenticate
{
    public function handle($request, $next)
    {
        return EventViewer::check($request) ? $next($request) : abort(403);
    }
}
