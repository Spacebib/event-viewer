<?php

namespace Spacebib\EventViewer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
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
        $headers = [
            'event_type' => 'Event Type',
            'aggregate_root_id' => 'Aggregate Root Id',
            'time_of_recording' => 'Date of recording',
        ];
        $columnsMap = $this->eventViewer->getConfig('columns');
        $eventTypes = $this->eventViewer->queryBuilder()->distinct($columnsMap['event_type'])->pluck($columnsMap['event_type']);

        $query = $this->eventViewer->queryBuilder();
        if ($agId = $request->query('aggregate_root_id')) {
            $query->where($columnsMap['aggregate_root_id'], $agId);
        }
        if ($eventType = $request->query('event_type')) {
            $query->where($columnsMap['event_type'], $eventType);
        }
        $rows = $query
            ->latest('id')
            ->paginate(request('perPage', $this->eventViewer->getConfig('perPage')));

        return view('event-viewer::index', compact('headers', 'rows', 'columnsMap', 'eventTypes'));
    }

    public function show(int $id)
    {
        $columns = Schema::getColumnListing($this->eventViewer->getConfig('table'));
        $columnsMap = $this->eventViewer->getConfig('columns');
        $event = $this->eventViewer->format($this->eventViewer->findByID($id));
        return view('event-viewer::show', compact('event', 'columnsMap', 'columns'));
    }
}
