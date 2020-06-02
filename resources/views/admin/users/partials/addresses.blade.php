<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">@lang('ID')</th>
            <th scope="col">@lang('Name')</th>
            <th scope="col">@lang('St Name')</th>
            <th scope="col">@lang('Building No.')</th>
            <th scope="col">@lang('City')</th>
            <th scope="col">@lang('Country')</th>
            <th scope="col">@lang('Lat & Lng')</th>
            <th scope="col">@lang('Distance From Warehouse')</th>
            <th scope="col">@lang('Updated At')</th>
            <th scope="col">@lang('Created At')</th>
            <th scope="col">@lang('Action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->user_addresses as $userAddress)
            <tr>
                <td>{{ $userAddress->id }}</td>
                <td>{{ $userAddress->name }}</td>
                <td>{{ $userAddress->st_name }}</td>
                <td>{{ $userAddress->building_no }}</td>
                <td>{{ $userAddress->city }}</td>
                <td>{{ $userAddress->country }}</td>
                <td>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $userAddress->lat.','.$userAddress->lng }}"
                       target="_blank">@lang('View')</a></td>
                <td>{{ $userAddress->distance }}</td>
                <td>{{ $userAddress->updated_at->format('Y-m-d H:i') }}</td>
                <td>{{ $userAddress->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    @allow('delete-addresses-users')
                    <a href="{{ route('admin.users.addresses.delete',['user'=>$userAddress->user_id,'user_address'=>$userAddress->id]) }}"
                       class="alert-danger dropdown-item"
                       style="padding: 5px;"
                       onclick="return confirm('Are you sure you want to delete this addresse?')">
                        <i class="fa fa-fw fa-times "></i>
                        <span>@lang('Delete')</span>
                    </a>
                    @endallow
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>