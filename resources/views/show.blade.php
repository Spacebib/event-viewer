@extends('event-viewer::layouts.app')

@section('content')
    <div class="page-header mb-4">
        <h1>@lang('Event')</h1>
    </div>

    <div class="card">
        <div class="card-header">
            Event Details
        </div>
        <div class="card-body">
            @foreach($columns as $column)
                @if($column === $columnsMap['payload']) @continue @endif
                <div class="d-flex">
                    <div class="p-2" style="flex: 0 0 200px">{{ $column }}</div>
                    <div class="p-2 flex-shrink-0">
                        @if($column === $columnsMap['aggregate_root_id'])
                            <span>{{ $event->{$column} }}</span>
                            <button class="btn btn-link btn-clipboard" data-toggle="tooltip" data-placement="top" title="Copy to Clipboard" data-clipboard-text="{{ $event->{$column} }}"><i class="fa fa-clipboard"></i></button>
                        @else
                            {{ $event->{$column} }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Payload
        </div>
        <div class="card-body">
            <pre><code class="language-json" id="ev-json">{{ $event->{$columnsMap['payload']} }}</code></pre>
        </div>
    </div>
@endsection