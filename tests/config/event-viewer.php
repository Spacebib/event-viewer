<?php

return [
    'connection' => null,
    'table' => 'stored_events',
    'columns' => [
        'aggregate_root_id' => 'aggregate_uuid',
        'event_type' => 'event_class',
        'time_of_recording' => 'created_at',
        'pay_load' => 'event_properties',
    ],
    'path' => 'event-viewer',
    'accessEmails' => ['admin@event-viewer.com'],
];
