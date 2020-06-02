@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('User :name Profile',['name'=>$user->full_name]))

@section('content_header')
    <h1>@lang('User :name Profile',['name'=>$user->full_name])</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">
                @lang('User :name Profile',['name'=>$user->full_name])
                <div class="btn-group float-right" role="group">
                    @allow('edit-users')
                    <a href="{{ route('admin.users.edit',$user->id) }}"
                       class="btn btn-info"
                       style="padding: 5px;">
                        <i class="fa fa-fw fa-edit "></i>
                        <span>@lang('Edit')</span>
                    </a>
                    @endallow
                    @allow('delete-users')
                    <a href="{{ route('admin.users.delete',$user->id) }}"
                       class="btn btn-danger"
                       style="padding: 5px;"
                       onclick="return confirm('Are you sure you want to delete this customer?')">
                        <i class="fa fa-fw fa-times "></i>
                        <span>@lang('Delete')</span>
                    </a>
                    @endallow
                    <a href="{{ URL::previous() }}" class="btn btn-primary">@lang('Back')</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td>@lang('Name')</td>
                        <td>{{ $user->full_name }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Phone Number')</td>
                        <td>{{ $user->phone_number }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Email')</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Gender')</td>
                        <td>{{ \App\Enums\Gender::parse($user->gender) }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Wallet Balance')</td>
                        <td>{{ $user->wallet }} {{ \App\Models\Country::getDefault()->currency }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Status')</td>
                        <td>{{ \App\Enums\UserStatus::reverseParse($user->status) }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Last Login')</td>
                        <td>{{ $user->last_login ? $user->last_login->format('Y-m-d H:i') : __('Never Logged IN') }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Updated At')</td>
                        <td>{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                    </tr>
                    <tr>
                        <td>@lang('Created At')</td>
                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                </table>
                <hr/>
                <div class="card card-green">
                    <div class="card-header">@lang('UserData')</div>
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="userDataTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                                   aria-controls="orders" aria-selected="true">@lang('Orders')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="user_addresses-tab" data-toggle="tab" href="#user_addresses"
                                   role="tab"
                                   aria-controls="user_addresses" aria-selected="false">@lang('UserAddresses')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="user_credit_cards-tab" data-toggle="tab"
                                   href="#user_credit_cards" role="tab"
                                   aria-controls="user_credit_cards"
                                   aria-selected="false">@lang('UserCredit Cards')</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="userDataTabsContent">
                            <div class="tab-pane fade show active" id="orders" role="tabpanel"
                                 aria-labelledby="orders-tab">
                                <hr/>
                                @include('admin.users.partials.orders')
                            </div>
                            <div class="tab-pane fade" id="user_addresses" role="tabpanel"
                                 aria-labelledby="user_addresses-tab">
                                <hr/>
                                @include('admin.users.partials.addresses')
                            </div>
                            <div class="tab-pane fade" id="user_credit_cards" role="tabpanel"
                                 aria-labelledby="user_credit_cards-tab">
                                <hr/>
                                @include('admin.users.partials.credit_cards')
                            </div>
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
