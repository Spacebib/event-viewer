<?php

namespace Spacebib\EventViewer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spacebib\EventViewer\EventViewer;
use Spacebib\EventViewer\Http\Middleware\Authenticate;

class EventViewerController extends Controller
{
    private $eventViewer;

    public function __construct(EventViewer $eventViewer)
    {
        $this->middleware(Authenticate::class);
        $this->eventViewer = $eventViewer;
    }

    public function index(Request $request)
    {
        return view('event-viewer::index');
    }

    public function show(int $id)
    {
        return view('event-viewer::index');
    }
}
