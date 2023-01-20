<?php

namespace Spacebib\EventViewer\Http\Controllers;

use Illuminate\Http\Request;

class EventViewerController extends Controller
{
    public function index(Request $request)
    {
        return view('event-viewer::index');
    }
}
