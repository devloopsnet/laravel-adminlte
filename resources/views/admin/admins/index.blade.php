@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Administrators'))

@section('content_header')
    <h1>@lang('Administrators')</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">@lang('Administrators')</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Role')</th>
                            <th>@lang('Email')</th>
                            <th>@lang('Last Login')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ implode(',',$admin->roles->pluck('name')->toArray()) }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->last_login ? $admin->last_login->format('Y-m-d H:i') : 'Never logged' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @allow('edit-administrators')
                                        <a href="{{ route('admin.admins.edit',$admin->id) }}" class="btn btn-info"
                                           style="padding: 5px;">
                                            <i class="fa fa-fw fa-edit "></i>
                                            <span>@lang('Edit')</span>
                                        </a>
                                        @endallow
                                        @allow('delete-administrators')
                                        <a href="{{ route('admin.admins.delete',$admin->id) }}" class="btn btn-danger"
                                           style="padding: 5px;"
                                           onclick="return confirm('Are you sure you want to delete this admin?')">
                                            <i class="fa fa-fw fa-times "></i>
                                            <span>@lang('Delete')</span>
                                        </a>
                                        @endallow
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $Admins->links() !!}
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
