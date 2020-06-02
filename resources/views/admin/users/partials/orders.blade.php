<a href="{{ route('admin.orders.create') }}?user_id={{ $user->id }}"
   class="btn btn-primary float-right">@lang('Create Order')</a>
<div class="clearfix"></div>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered table-head-fixed">
        <thead>
        <tr>
            <th scope="col">@lang('ID')</th>
            <th scope="col">@lang('Order #')</th>
            <th scope="col">@lang('Customer')</th>
            <th scope="col">@lang('Shopper')</th>
            <th scope="col">@lang('Total')</th>
            <th scope="col">@lang('Status')</th>
            <th scope="col">@lang('Created')</th>
            <th scope="col">@lang('Actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>
                    <a href="{{ route('admin.orders.view',$order->id) }}">
                        {{ $order->order_no }}
                    </a>
                </td>
                <td>
                    {{ $order->user->full_name }}
                </td>
                <td>{!! $order->shopper!==NULL ? '<a target="_blank" href="'.route('admin.shoppers.view',$order->shopper->id).'">'.$order->shopper->full_name.'</a>' : __('Order not assigned.') !!}</td>
                <td>{{ $order->total }} {{ \App\Models\Country::getDefault()->currency }}</td>
                <td>{{ $order->last_status }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('Actions')
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            @allow('view-orders')
                            <a href="{{ route('admin.orders.view',$order->id) }}"
                               class="alert-warning dropdown-item"
                               style="padding: 5px;">
                                <i class="fa fa-fw fa-eye "></i>
                                <span>@lang('View')</span>
                            </a>
                            @endallow
                            @allow('edit-orders')
                            <a href="{{ route('admin.orders.edit',$order->id) }}"
                               class="alert-info dropdown-item"
                               style="padding: 5px;">
                                <i class="fa fa-fw fa-edit "></i>
                                <span>@lang('Edit')</span>
                            </a>
                            @endallow
                            @allow('delete-orders')
                            <a href="{{ route('admin.orders.delete',$order->id) }}"
                               class="alert-danger dropdown-item"
                               style="padding: 5px;"
                               onclick="return confirm('Are you sure you want to delete this order?')">
                                <i class="fa fa-fw fa-times "></i>
                                <span>@lang('Delete')</span>
                            </a>
                            @endallow
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>