<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">@lang('ID')</th>
            <th scope="col">@lang('Last 4 Digits')</th>
            <th scope="col">@lang('Expiry')</th>
            <th scope="col">@lang('CVV')</th>
            <th scope="col">@lang('Type')</th>
            <th scope="col">@lang('Updated At')</th>
            <th scope="col">@lang('Created At')</th>
            <th scope="col">@lang('Action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->user_credit_cards as $usercreditCard)
            <tr>
                <td>{{ $usercreditCard->id }}</td>
                <td>**** **** **** {{ $usercreditCard->last_4 }}</td>
                <td>{{ $usercreditCard->expiry }}</td>
                <td>{{ $usercreditCard->cvv }}</td>
                <td>{{ \App\Enums\CreditCard::parse($usercreditCard->type) }}</td>
                <td>{{ $usercreditCard->updated_at->format('Y-m-d H:i') }}</td>
                <td>{{ $usercreditCard->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    @allow('delete-creditCards-users')
                    <a href="{{ route('admin.users.creditCards.delete',['user'=>$usercreditCard->user_id,'user_credit_card'=>$usercreditCard->id]) }}"
                       class="alert-danger dropdown-item"
                       style="padding: 5px;"
                       onclick="return confirm('Are you sure you want to delete this credit card?')">
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