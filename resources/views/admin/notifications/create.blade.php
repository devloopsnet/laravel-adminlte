@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Create Notifications'))

@section('content_header')
    <h1>@lang('Create Notifications')</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">
                @lang('Create Notifications')
                <a href="{{ URL::previous() }}" class="btn btn-primary float-right">@lang('Back')</a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group row">
                        <label for="send_to" class="col-sm-2 control-label">@lang('Send to')</label>
                        <div class="col-sm-10">
                            <select name="send_to" id="send_to" class="form-control">
                                <option value="">@lang('-Select one-')</option>
                                <option value="all">@lang('All')</option>
                                <option value="users">@lang('User(s)')</option>
                            </select>
                        </div>
                    </div>
                    <div id="users-box" class="form-group row d-none">
                        <label for="users" class="col-sm-2 control-label">@lang('User(s)')</label>
                        <div class="col-sm-10">
                            <select name="users[]" id="users" class="form-control" multiple>
                                <option value="-1">@lang('-Select User-')</option>
                                <option value="0">@lang('All')</option>
                                @foreach($Users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="shoppers-box" class="form-group row d-none">
                        <label for="shoppers" class="col-sm-2 control-label">@lang('Shopper(s)')</label>
                        <div class="col-sm-10">
                            <select name="shoppers[]" id="shoppers" class="form-control" multiple>
                                <option value="-1">@lang('-Select Shopper-')</option>
                                <option value="0">@lang('All')</option>
                                @foreach($Shoppers as $shopper)
                                    <option value="{{ $shopper->id }}">{{ $shopper->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title_en" class="col-sm-2 control-label">@lang('Title')</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="title_en" name="title_en"
                                   placeholder="@lang('Title English')">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="title_ar" name="title_ar"
                                   placeholder="@lang('Title Arabic')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 control-label">@lang('Body')</label>
                        <div class="col-sm-5">
                            <textarea id="body_en" name="body_en" class="form-control"
                                      placeholder="@lang('Body English')"></textarea>
                        </div>
                        <div class="col-sm-5">
                            <textarea id="body_ar" name="body_ar" class="form-control"
                                      placeholder="@lang('Body Arabic')"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">@lang('Send')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
