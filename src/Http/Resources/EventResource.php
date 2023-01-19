<?php

namespace Spacebib\EventViewer\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Spacebib\EventViewer\EventViewer;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        $eventViewer = app()->get(EventViewer::class);
        $columnsMap = $eventViewer->getConfig('columns');

        return [
            'id' => $this->id,
            'aggregateUuid' => $this->{$columnsMap['aggregate_root_id']},
            'aggregateVersion' => $this->{$columnsMap['aggregate_version'] ?? 'aggregate_version'},
            'eventType' => $this->{$columnsMap['event_type']},
            'payload' => $this->{$columnsMap['payload']},
            'timeOfRecording' => $this->{$columnsMap['time_of_recording']},
        ];
    }
}
