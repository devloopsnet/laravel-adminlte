@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Update User'))

@section('content_header')
    <h1>@lang('Update User')</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">
                @lang('Update User')
                <a href="{{ URL::previous() }}" class="btn btn-primary float-right">@lang('Back')</a>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group row">
                        <label for="brand_name" class="col-sm-2 control-label">@lang('Name')</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                   placeholder="@lang('First Name')" value="{{ old('first_name',$user->first_name) }}">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                   placeholder="@lang('Last Name')" value="{{ old('last_name',$user->last_name) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 control-label">@lang('Phone Number')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                   placeholder="@lang('Phone Number 962781234567')"
                                   value="{{ old('phone_number',$user->phone_number) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 control-label">@lang('Email')</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="@lang('Email')" value="{{ old('email',$user->email) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 control-label">@lang('Gender')</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="gender" name="gender">
                                <option value="male" {{ $user->gender===\App\Enums\Gender::MALE ? 'select' : '' }}>@lang('Male')</option>
                                <option value="female" {{ $user->gender===\App\Enums\Gender::FEMALE ? 'select' : '' }}>@lang('Female')</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wallet_balance" class="col-sm-2 control-label">@lang('Wallet Balance')</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="wallet_balance" name="wallet_balance"
                                   placeholder="@lang('Wallet Balance')"
                                   value="{{ old('wallet_balance',$user->wallet) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reward_points" class="col-sm-2 control-label">@lang('Reward Points')</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="reward_points" name="reward_points"
                                   placeholder="@lang('Reward Points')"
                                   value="{{ old('reward_points',$user->points) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 control-label">@lang('Status')</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status"
                                           value="0" {{ $user->isInactive() ? 'checked' : '' }}>
                                    @lang('Inactive')
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status"
                                           value="1" {{ $user->isActive() ? 'checked' : '' }}>
                                    @lang('Active')
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="status" id="status"
                                           value="2" {{ $user->isBlocked() ? 'checked' : '' }}>
                                    @lang('Block')
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 control-label">@lang('Password')</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="@lang('Password')">
                        </div>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="password"
                                   name="password_confirmation"
                                   placeholder="@lang('Password Confirmation')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">@lang('Update User')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .select2.select2-container.select2-container--default,
        .select2.select2-container.select2-container--default.select2-container--focus,
        .select2.select2-container.select2-container--default.select2-container--open {
            width: 100% !important;
        }
    </style>
@stop

@section('js')

@stop
