@extends('event-viewer::layouts.app')

@section('content')
    <div class="page-header mb-4">
        <h1>@lang('Events')</h1>
    </div>

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