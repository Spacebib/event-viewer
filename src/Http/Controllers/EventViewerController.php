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
        $headers = [
            'event_type' => 'Event Type',
            'aggregate_root_id' => 'Aggregate Root Id',
            'time_of_recording' => 'Date of recording',
        ];
        $columnsMap = $this->eventViewer->getConfig('columns');

        $query = $this->eventViewer->queryBuilder();

        $eventTypes = $query->distinct($columnsMap['event_type'])->pluck($columnsMap['event_type']);

        if ($agId = $request->query('aggregate_root_id')) {
            $query->where($columnsMap['aggregate_root_id'], $agId);
        }
        if ($eventType = $request->query('event_type')) {
            $query->where($columnsMap['event_type'], $eventType);
        }
        $rows = $query->orderByDesc($columnsMap['time_of_recording'])->paginate(10);

        return view('event-viewer::index', compact('headers', 'rows', 'columnsMap', 'eventTypes'));
    }

    public function show(string $aggregateId)
    {
        $event = $this->eventViewer->format($this->eventViewer->findByAggregateRootId($aggregateId));
        return view('event-viewer::show', compact('event'));
    }
}
