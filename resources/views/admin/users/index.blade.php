@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Users'))

@section('content_header')
    <h1>@lang('Users')</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">@lang('Users')</div>
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
                            {{--<th>@lang('Gender')</th>--}}
                            <th>@lang('Status')</th>
                            <th>@lang('Last Login')</th>
                            <th>@lang('Via Facebook')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{ route('admin.users.view',$user->id) }}">{{ $user->full_name }}</a></td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->wallet }}</td>
                                <td>{{ $user->points }}</td>
                                {{--<td>{{ \App\Enums\Gender::parse($user->gender) }}</td>--}}
                                <td>{{ \App\Enums\UserStatus::reverseParse($user->status) }}</td>
                                <td>{{ $user->last_login ? $user->last_login->format('Y-m-d H:i') : __('Never Logged.') }}</td>
                                <td>{{ $user->fb_id!==NULL ? __('Yes') : __('No') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @lang('Action')
                                        </button>
                                        <div class="dropdown-menu">
                                            @allow('view-users')
                                            <a href="{{ route('admin.users.view',$user->id) }}"
                                               class="alert-warning dropdown-item"
                                               style="padding: 5px;">
                                                <i class="fa fa-fw fa-eye "></i>
                                                <span>@lang('View')</span>
                                            </a>
                                            @endallow
                                            @allow('edit-users')
                                            <a href="{{ route('admin.users.edit',$user->id) }}"
                                               class="alert-info dropdown-item"
                                               style="padding: 5px;">
                                                <i class="fa fa-fw fa-edit "></i>
                                                <span>@lang('Edit')</span>
                                            </a>
                                            @endallow
                                            @allow('delete-users')
                                            <a href="{{ route('admin.users.delete',$user->id) }}"
                                               class="alert-danger dropdown-item"
                                               style="padding: 5px;"
                                               onclick="return confirm('Are you sure you want to delete this customer?')">
                                                <i class="fa fa-fw fa-times "></i>
                                                <span>@lang('Delete')</span>
                                            </a>
                                            @endallow
                                        </div>
                                    </div>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
