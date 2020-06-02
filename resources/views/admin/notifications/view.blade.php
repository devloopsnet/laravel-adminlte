@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('View Notification #:notification_id',['notification_id'=>$system_notification->id]))

@section('content_header')
    <h1>@lang('View Notification #:notification_id',['notification_id'=>$system_notification->id])</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">
                @lang('View Notification #:notification_id',['notification_id'=>$system_notification->id])
                <a href="{{ URL::previous() }}" class="btn btn-primary float-right">@lang('Back')</a>
            </div>
            <div class="card-body">
                <div class="card card-default">
                    <div class="card-header bg-aqua">@lang('Notification Details')</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>@lang('Sent by')</td>
                                <td>{{ $system_notification->admin->name }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Title English')</td>
                                <td>{{ $system_notification->title_en }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Title Arabic')</td>
                                <td>{{ $system_notification->title_ar }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Body English')</td>
                                <td>{{ $system_notification->body_en }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Body Arabic')</td>
                                <td>{{ $system_notification->body_ar }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Sent on')</td>
                                <td>{{ $system_notification->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="card card-default">
                    <div class="card-header bg-orange">@lang('Users Notification Sent to')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('ID')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Phone Number')</th>
                                    <th>@lang('Email')</th>
                                </tr>
                                @foreach($Users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ \App\Enums\UserType::parse($user->user_type) }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>@lang('ID')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Phone Number')</th>
                                    <th>@lang('Email')</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card card-default">
                    <div class="card-header bg-green">@lang('Drivers Notification Sent to')</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>@lang('ID')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Phone Number')</th>
                                    <th>@lang('Email')</th>
                                </tr>
                                @foreach($Drivers as $driver)
                                    <tr>
                                        <td>{{ $driver->id }}</td>
                                        <td>{{ $driver->name }}</td>
                                        <td>{{ $driver->phone_number }}</td>
                                        <td>{{ $driver->email }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th>@lang('ID')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Phone Number')</th>
                                    <th>@lang('Email')</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
