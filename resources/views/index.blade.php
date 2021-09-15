@extends('event-viewer::layouts.app')

@section('content')
    <div class="page-header mb-4">
        <h1>@lang('Events')</h1>
    </div>

    <form method="GET">
        <div class="row">
            <div class="col">
                <div class="input-group position-relative">
                    <input type="text" class="form-control mb-2 mr-sm-2"
                           name="aggregate_root_id"
                           placeholder="AGGREGATE ROOT ID"
                           value="{{ request('aggregate_root_id') }}"
                    >
                    <span class="form-clear d-none"><i class="fa fa-times"></i></span>
                </div>

            </div>
            <div class="col">
                <select class="custom-select" name="event_type">
                    <option value="">Event Type</option>
                    @foreach($eventTypes as $type)
                        <option @if($type === request('event_type')) selected @endif value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary mb-2">Filter</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-sm table-hover">
            <thead>
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="text-left text-uppercase">
                        {{ $header }}
                    </th>
                @endforeach
                <th scope="col" class="text-left text-uppercase">
                    @lang('view')
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($headers as $key => $value)
                        <td class="text-left">
                            <span class="badge">{{ $row->{$columnsMap[$key]} }}</span>
                            @if($key === 'aggregate_root_id' )
                                <a href="{{ url()->current().'?aggregate_root_id='.$row->{$columnsMap[$key]} }}" class="btn btn-link" data-toggle="tooltip" data-placement="right" title="Filter by this aggregate uuid">
                                    <i class="fa fa-filter" aria-hidden="true"></i>
                                </a>
                            @endif
                        </td>
                    @endforeach
                    <td class="text-left">
                        <a href="{{ route('event-viewer.show', $row->id) }}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <span class="badge badge-secondary">@lang('The list of events is empty!')</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $rows->appends(request()->except('page'))->links() }}
@endsection