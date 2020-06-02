@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Edit Role'))

@section('content_header')
    <h1>@lang('Edit Role')</h1>
@stop

@section('content')
    <div class="card card-default">
        <div class="card-header">
            @lang('Edit Role')
            <a href="{{ URL::previous() }}" class="btn btn-primary float-right">@lang('Back')</a>
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="form-group row">
                    <label for="role_name" class="col-sm-2 control-label">@lang('Role Name')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="role_name" name="role_name"
                               value="{{ $role->name }}"
                               placeholder="@lang('Role Name')">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-10">
                        <label for="select_all" class="control-label">@lang('Select All')</label>
                        <input type="checkbox" id="select_all" name="select_all"
                               onclick="$(document.getElementById('all-permissions').getElementsByTagName('input')).prop('checked',$('#select_all').is(':checked'))">
                    </div>
                </div>
                <div id="all-permissions" class="col-sm-10 offset-sm-2 row">
                    @foreach($Permissions as $group => $permissions)
                        <div class="col-sm-4 form-group row">
                            <label for="{{ $group }}"
                                   class="col-sm-4 control-label">{{ ucwords(implode(' ',preg_split('/(?=[A-Z])/', $group, -1, PREG_SPLIT_NO_EMPTY))) }}</label>
                            <br/>
                            <div class="col-sm-8">
                                <div class="checkbox" id="{{ $group }}">
                                    @foreach($permissions as $permission)
                                        <label class="checkbox-inline">
                                            <input name="permissions[]" type="checkbox"
                                                   value="{{ $permission }}" {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}> {{ ucwords(str_replace(['-','_'],' ',$permission)) }}
                                        </label>
                                        <br/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">@lang('Update')</button>
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
