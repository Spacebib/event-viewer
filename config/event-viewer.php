<?php

return [
    'connection' => null,
    'table' => 'stored_events',
    'columns' => [
        'aggregate_root_id' => 'aggregate_uuid',
        'event_type' => 'event_class',
        'time_of_recording' => 'created_at',
        'payload' => 'event_properties',
    ],
    'path' => 'event-viewer',
    'accessEmails' => [],
    'perPage' => 20,
];
