@extends('adminlte::page')

@section('title', env('APP_NAME').' | Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to {{ env('APP_NAME') }} card.</p>
    <div class="col-md-12">

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <style>

        .widget-flat {
            position: relative;
            overflow: hidden;

        @media (min-width: 1200px) and (max-width: 1500px) {
            i.widget-icon {
                display: none;
            }
        }

        }
        .widget-icon {
            color: #727cf5;
            font-size: 20px;
            background-color: rgba(114, 124, 245, .25);
            height: 40px;
            width: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 3px;
            display: inline-block;
        }

        .text-muted {
            color: #98a6ad !important;
        }

        .font-weight-normal {
            font-weight: 400 !important;
        }

        .mt-0, .my-0 {
            margin-top: 0 !important;
        }

        .text-muted {
            color: #98a6ad !important;
        }

        .mb-3, .my-3 {
            margin-bottom: 1.5rem !important;
        }

        .mt-3, .my-3 {
            margin-top: 1.5rem !important;
        }

        .text-nowrap {
            white-space: nowrap !important;
        }

        .mr-2, .mx-2 {
            margin-right: .75rem !important;
        }

        .widget-icon {
            color: $primary;
            font-size: 20px;
            background-color: rgba($ primary, 0.25);
            height: 40px;
            width: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 3px;
            display: inline-block;
        }

    </style>
@stop

@section('js')
    <script src="{{ asset('js/utils.js') }}" type="text/javascript"></script>
    <script> console.log('Hi!'); </script>
@stop
