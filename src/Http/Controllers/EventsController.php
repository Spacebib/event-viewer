<?php

namespace Spacebib\EventViewer\Http\Controllers;

use Illuminate\Http\Request;
use Spacebib\EventViewer\Http\Resources\EventResource;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $columnsMap = $this->eventViewer->getConfig('columns');
        $isFilteringByAggregateRootId = false;
        $query = $this->eventViewer->queryBuilder();
        if ($agId = $request->query('filter')['search'] ?? null) {
            $isFilteringByAggregateRootId = true;
            $query->where($columnsMap['aggregate_root_id'], $agId);
        }
        if ($eventType = $request->query('filter')['event'] ?? null) {
            $query->where($columnsMap['event_type'], $eventType);
        }

        $sorts = empty($request->query('sort')) ? [] : explode(',', $request->query('sort'));

        foreach ($sorts as $property) {
            $descending = $property[0] === '-';
            $key = ltrim($property, '-');
            $query->orderBy($key, $descending ? 'desc' : 'asc');
        }
        if (empty($sorts)) {
            $query->latest('id');
        }

        if ($isFilteringByAggregateRootId) {
            $rows = $query->paginate(request('perPage', $this->eventViewer->getConfig('perPage')));
        } else {
            $rows = $query->cursorPaginate(request('perPage', $this->eventViewer->getConfig('perPage')));
        }

        return EventResource::collection($rows);
    }

    public function show(int $id, Request $request)
    {
        if (!$this->eventViewer->findByID($id)) {
            abort(404);
        }
        $event = $this->eventViewer->format($this->eventViewer->findByID($id));

        return EventResource::make($event);
    }

    public function eventTypes()
    {
        $columnsMap = $this->eventViewer->getConfig('columns');

        $eventTypes = $this->eventViewer->queryBuilder()
            ->distinct($columnsMap['event_type'])->pluck($columnsMap['event_type']);

        return response()->json([
            'data' => $eventTypes,
        ]);
    }
}
