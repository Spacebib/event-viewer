@extends('event-viewer::layouts.app')

@section('content')
    <div class="page-header mb-4">
        <h1>@lang('Events')</h1>
    </div>

    <form method="GET">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control mb-2 mr-sm-2" name="aggregate_root_id" placeholder="AGGREGATE ROOT ID">
            </div>
            <div class="col">
                <select class="custom-select" name="event_type">
                    <option value="">Event Type</option>
                    @foreach($eventTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
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
                        </td>
                    @endforeach
                    <td class="text-left">
                        <a href="{{ route('event-viewer.show', $row->{$columnsMap['aggregate_root_id']}) }}"><i class="fa fa-eye"></i></a>
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

    {{ $rows->links() }}
@endsection