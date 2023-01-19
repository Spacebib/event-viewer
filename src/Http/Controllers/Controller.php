<?php

namespace Spacebib\EventViewer\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Spacebib\EventViewer\EventViewer;
use Spacebib\EventViewer\Http\Middleware\Authenticate;

class Controller extends BaseController
{
    protected $eventViewer;

    public function __construct(EventViewer $eventViewer)
    {
        $this->middleware(Authenticate::class);
        $this->eventViewer = $eventViewer;
    }
}
