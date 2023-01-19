<?php

namespace Spacebib\EventViewer\Http\Controllers;

class DashboardStatsController extends Controller
{
    public function index()
    {
        $columnsMap = $this->eventViewer->getConfig('columns');
        $query = $this->eventViewer->queryBuilder();
        return [
            'totalEvents' => $query->count(),
            'maxVersion' => $query->max($columnsMap['aggregate_version'] ?? 'aggregate_version'),
        ];
    }
}
