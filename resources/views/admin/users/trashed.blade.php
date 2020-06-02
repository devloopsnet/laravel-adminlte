@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Deleted Users'))

@section('content_header')
    <h1>@lang('Deleted Users')</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">@lang('Deleted Users')</div>
            <div class="card-body">
                <div class="card card-default">
                    <div class="card-header">@lang('Search Users')</div>
                    <div class="card-body">
                        <form class="form">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="search_name" class="control-label">@lang('Name')</label>
                                        <input type="text" id="search_name" name="search[name]" class="form-control"
                                               placeholder="@lang('Name')" value="{{ request('search.name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="search_phone_number"
                                               class="control-label">@lang('Phone Number')</label>
                                        <input type="text" id="search_phone_number" name="search[phone_number]"
                                               class="form-control"
                                               placeholder="@lang('Phone Number')"
                                               value="{{ request('search.phone_number') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="search_email" class="control-label">@lang('Email')</label>
                                        <input type="text" id="search_email" name="search[email]" class="form-control"
                                               placeholder="@lang('Email')" value="{{ request('search.email') }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">@lang('Search')</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Phone Number')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Wallet Balance')</th>
                            <th>@lang('Reward Points')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Last Login')</th>
                            {{--<th>@lang('Updated')</th>--}}
                            {{--<th>@lang('Created')</th>--}}
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->wallet }}</td>
                                <td>{{ $user->points }}</td>
                                <td>{{ \App\Enums\UserStatus::reverseParse($user->status) }}</td>
                                <td>{{ $user->last_login ? $user->last_login->format('Y-m-d H:i') : __('Never Logged.') }}</td>
                                {{--<td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>--}}
                                {{--<td>{{ $user->created_at->format('Y-m-d H:i') }}</td>--}}
                                <td>
                                    @allow('restore-users')
                                    <a href="{{ route('admin.users.restore',$user->id) }}" class="alert-success"
                                       style="padding: 5px;">
                                        <i class="fa fa-fw fa-recycle "></i>
                                        <span>@lang('Restore')</span>
                                    </a>
                                    @endallow
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $Users->links() !!}
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
