@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Edit Administrator'))

@section('content_header')
    <h1>@lang('Edit Administrator')</h1>
@stop

@section('content')
    <div class="card card-default">
        <div class="card-header">
            @lang('Edit Administrator')
            <a href="{{ URL::previous() }}" class="btn btn-primary float-right">@lang('Back')</a>
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 control-label">@lang('Name')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="@lang('Name')" value="{{ $admin->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 control-label">@lang('Email')</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="@lang('Email')" value="{{ $admin->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 control-label">@lang('Password')</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="@lang('Password')">
                    </div>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation"
                               placeholder="@lang('Password Confirmation')">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-sm-2 control-label">@lang('Roles')</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="roles" name="roles[]" multiple>
                            <option value="-1">-Select Role(s)-</option>
                            @foreach($Roles as $role)
                                <option value="{{ $role->name }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>{{ \Illuminate\Support\Str::studly($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">@lang('Save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
