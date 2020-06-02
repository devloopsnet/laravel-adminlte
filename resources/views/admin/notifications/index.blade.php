@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Notifications'))

@section('content_header')
    <h1>@lang('Notifications')</h1>
@stop

@section('content')
    <div>
        @allow('create-notifications')
        <br/>
        <a href="{{ route('admin.notifications.create') }}"
           class="btn btn-primary float-right">@lang('Send Notification')</a>
        <div class="clearfix"></div>
        <br/>
        @endallow
        <div class="card card-default">
            <div class="card-header">@lang('Notifications')</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Sent by')</th>
                            <th>@lang('Title English')</th>
                            <th>@lang('Title Arabic')</th>
                            <th>@lang('Body English')</th>
                            <th>@lang('Body Arabic')</th>
                            <th>@lang('Created')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Notifications as $notification)
                            <tr>
                                <td>{{ $notification->id }}</td>
                                <td>{{ $notification->admin->name }}</td>
                                <td>{{ $notification->title_en }}</td>
                                <td>{{ $notification->title_ar }}</td>
                                <td>{{ $notification->body_en }}</td>
                                <td>{{ $notification->body_ar }}</td>
                                <td>{{ $notification->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    @allow('view-notifications')
                                    <a href="{{ route('admin.notifications.view',$notification->id) }}"
                                       class="alert-warning"
                                       style="padding: 5px;">
                                        <i class="fa fa-fw fa-eye "></i>
                                        <span>@lang('View')</span>
                                    </a>
                                    @endallow
                                    @allow('delete-notifications')
                                    <a href="{{ route('admin.notifications.delete',$notification->id) }}"
                                       class="alert-danger"
                                       style="padding: 5px;"
                                       onclick="return confirm('Are you sure you want to delete this notification?')">
                                        <i class="fa fa-fw fa-times "></i>
                                        <span>@lang('Delete')</span>
                                    </a>
                                    @endallow
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Sent by')</th>
                            <th>@lang('Title English')</th>
                            <th>@lang('Title Arabic')</th>
                            <th>@lang('Body English')</th>
                            <th>@lang('Body Arabic')</th>
                            <th>@lang('Created')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                {!! $Notifications->links() !!}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css',true) }}?{{ rand() }}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
