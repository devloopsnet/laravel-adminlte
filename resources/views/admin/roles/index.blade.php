@extends('adminlte::page')

@section('title', env('APP_NAME').' | '.__('Roles'))

@section('content_header')
    <h1>@lang('Roles')</h1>
@stop

@section('content')
    <div>
        <div class="card card-default">
            <div class="card-header">@lang('Roles')</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('ID')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Permissions')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td width="40%">
                                    @if($role->name!=='super-admin')
                                        @php
                                            $Permissions = [];
                                            foreach($role->permissions as $permission){
                                            $Permissions[] = ucwords(str_replace(['-','_'],' ',$permission->name));
                                            }
                                        @endphp
                                        {{ implode(',',$Permissions) }}
                                    @else
                                        All Permissions
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @allow('edit-roles')
                                        <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-info"
                                           style="padding: 5px;">
                                            <i class="fa fa-fw fa-edit "></i>
                                            <span>@lang('Edit')</span>
                                        </a>
                                        @endallow
                                        @allow('delete-roles')
                                        <a href="{{ route('admin.roles.delete',$role->id) }}" class="btn btn-danger"
                                           style="padding: 5px;"
                                           onclick="return confirm('Are you sure you want to delete this role?')">
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
                {!! $Roles->links() !!}
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
