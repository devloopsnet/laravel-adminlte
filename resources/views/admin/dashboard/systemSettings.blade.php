@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('System Settings'))

@section('content_header')
    <!--suppress JSUnresolvedLibraryURL -->
    <h1>@lang('System Settings')</h1>
@stop

@section('content')
    <div class="card card-default">
        <div class="card-header">@lang('System Settings')</div>
        <div class="card-body">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                <!--<li role="presentation">
                        <a href="#system-settings" aria-controls="system-settings" role="tab"
                           data-toggle="tab">@lang('System Settings')</a>
                    </li>-->
                    <li role="presentation" class="nav-item">
                        <a class="nav-link active" href="#app-settings" aria-controls="app-settings" role="tab"
                           data-toggle="tab">@lang('App Settings')</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                <!--<div role="tabcard" class="tab-pane active" id="system-settings">
                        <div class="card card-default">
                            <div class="card-body">
                                <form action="{{ route('admin.dashboard.saveSystemSettings') }}" method="post">
                                    {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="user_percentage">@lang('UserPercentage %')</label>
                                        <input type="text" class="form-control" name="user_percentage"
                                               id="user_percentage"
                                               value="{{ \App\Models\Setting::get('user_percentage') }}"
                                               placeholder="@lang('UserPercentage %, Ex : 1 or 2.5')">
                                    </div>
                                    <div class="form-group">
                                        <label for="cash_out_threshold">@lang('Cash Out Threshold')</label>
                                        <input type=number class="form-control" name="cash_out_threshold"
                                               id="cash_out_threshold"
                                               value="{{ \App\Models\Setting::get('cash_out_threshold',1) }}"
                                               placeholder="@lang('Cash Out Threshold')"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="minimum_order_weight">@lang('Minimum Order Weight')</label>
                                        <input type=number class="form-control" name="minimum_order_weight"
                                               id="minimum_order_weight"
                                               value="{{ \App\Models\Setting::get('minimum_order_weight',1) }}"
                                               placeholder="@lang('Minimum Order Weight')"/>
                                    </div>
                                    <button type="submit" class="btn btn-default">@lang('Save')</button>
                                </form>
                            </div>
                        </div>
                    </div>-->
                    <div role="tabcard" class="tab-pane fade show active" id="app-settings">
                        <div class="card card-default">
                            <div class="card-body">
                                <form action="{{ route('admin.dashboard.saveAppSettings') }}" method="post"
                                      enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="support_email">@lang('Support Email')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input type="text" class="form-control" name="support_email"
                                                   id="support_email"
                                                   value="{{ \App\Models\Setting::get('support_email') }}"
                                                   placeholder="@lang('Support Email Ex : support@devloops.net')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_phone">@lang('Mobile Phone')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="mobile_phone"
                                                   id="mobile_phone"
                                                   value="{{ \App\Models\Setting::get('mobile_phone') }}"
                                                   placeholder="@lang('Mobile Phone Ex : 078XXXXXXX')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="land_line">@lang('Land Line')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="land_line"
                                                   id="land_line"
                                                   value="{{ \App\Models\Setting::get('land_line') }}"
                                                   placeholder="@lang('Land Line Ex : 06XXXXXXX')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ios_app_url">@lang('iOS App URL')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fab fa-app-store-ios"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="ios_app_url"
                                                   id="ios_app_url"
                                                   value="{{ \App\Models\Setting::get('ios_app_url') }}"
                                                   placeholder="@lang('iOS App URL Ex : https://play.google.com/store/apps/details?id=xxx.xxx.xx')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="android_app_url">@lang('Android App URL')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-android"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="android_app_url"
                                                   id="android_app_url"
                                                   value="{{ \App\Models\Setting::get('android_app_url') }}"
                                                   placeholder="@lang('Android App URL Ex : https://apps.apple.com/us/app/globaledit/id398197276')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="twitter_account">@lang('Twitter Account')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="twitter_account"
                                                   id="twitter_account"
                                                   value="{{ \App\Models\Setting::get('twitter_account') }}"
                                                   placeholder="@lang('Twitter Account Ex : https://twitter.com/DevloopsAdminLTE')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="linkedin_account">@lang('LinkedIn Account')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="linkedin_account"
                                                   id="linkedin_account"
                                                   value="{{ \App\Models\Setting::get('linkedin_account') }}"
                                                   placeholder="@lang('LinkedIn Account Ex : https://linkedin.com/DevloopsAdminLTE')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="youtube_account">@lang('Youtube Account')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="youtube_account"
                                                   id="youtube_account"
                                                   value="{{ \App\Models\Setting::get('youtube_account') }}"
                                                   placeholder="@lang('Youtube Account Ex : https://youtube.com/DevloopsAdminLTE')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="facebook_account">@lang('Facebook Account')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fab fa-facebook"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="facebook_account"
                                                   id="facebook_account"
                                                   value="{{ \App\Models\Setting::get('facebook_account') }}"
                                                   placeholder="@lang('Facebook Account Ex : https://fb.com/DevloopsAdminLTE')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="instagram_account">@lang('Instagram Account')</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                            class="fab fa-instagram"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="instagram_account"
                                                   id="instagram_account"
                                                   value="{{ \App\Models\Setting::get('instagram_account') }}"
                                                   placeholder="@lang('Instagram Account Ex : https://instagram.com/DevloopsAdminLTE')">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="privacy_policy">
                                            @lang('Privacy Policy')
                                            @if(\App\Models\Setting::get('privacy_policy')!==null)
                                                <a target="_blank"
                                                   href="{{ \Illuminate\Support\Facades\Storage::url(\App\Models\Setting::get('privacy_policy')) }}">Current
                                                    Value</a>
                                            @endif
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" class="form-control" name="privacy_policy"
                                                   id="privacy_policy">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="terms_conditions">
                                            @lang('Terms & Conditions')
                                            @if(\App\Models\Setting::get('terms_conditions')!==null)
                                                <a target="_blank"
                                                   href="{{ \Illuminate\Support\Facades\Storage::url(\App\Models\Setting::get('terms_conditions')) }}">Current
                                                    Value</a>
                                            @endif
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                                            </div>
                                            <input type="file" class="form-control" name="terms_conditions"
                                                   id="terms_conditions">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="brief" class="col-sm-2 control-label">@lang('Brief')</label>
                                        <div class="col-sm-5" id="brief">
                                            <textarea class="form-control" id="brief" name="brief"
                                                      placeholder="@lang('Brief')"
                                                      rows="4">{{ \App\Models\Setting::get('brief') }}</textarea>
                                        </div>
                                        <div class="col-sm-5" id="brief_ar">
                                            <textarea class="form-control" id="brief_ar" name="brief_ar"
                                                      placeholder="@lang('Brief Arabic')"
                                                      rows="4">{{ \App\Models\Setting::get('brief_ar') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-sm-2 control-label">@lang('Address')</label>
                                        <div class="col-sm-5" id="address">
                                            <textarea class="form-control" id="address" name="address"
                                                      placeholder="@lang('Address')"
                                                      rows="4">{{ \App\Models\Setting::get('address') }}</textarea>
                                        </div>
                                        <div class="col-sm-5" id="address_ar">
                                            <textarea class="form-control" id="address_ar" name="address_ar"
                                                      placeholder="@lang('Address Arabic')"
                                                      rows="4">{{ \App\Models\Setting::get('address_ar') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="faq" class="col-sm-2 control-label">@lang('FAQ')</label>
                                        <div class="col-sm-5" id="faq">
                                            <textarea class="form-control" id="faq" name="faq"
                                                      placeholder="@lang('FAQ')"
                                                      rows="4">{{ \App\Models\Setting::get('faq') }}</textarea>
                                        </div>
                                        <div class="col-sm-5" id="faq_ar">
                                            <textarea class="form-control" id="faq_ar" name="faq_ar"
                                                      placeholder="@lang('FAQ Arabic')"
                                                      rows="4">{{ \App\Models\Setting::get('faq_ar') }}</textarea>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-default">@lang('Save')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <!--suppress VueDuplicateTag -->
    <script
            src="https://cdn.tiny.cloud/1/p5yignc6uwiy0hlocpuexpqlt3rtna7cona6qtvk43suc2p3/tinymce/5/tinymce.min.js"></script>
    <!--suppress VueDuplicateTag -->
    <script>
        tinymce.init({
            selector: 'textarea.form-control',
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop
