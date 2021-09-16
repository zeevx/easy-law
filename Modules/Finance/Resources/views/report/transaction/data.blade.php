<!-- table-responsive -->
<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col">{{ __('common.Date') }}</th>
        <th scope="col">{{ __('common.Title') }}</th>
        <th scope="col">{{ __('finance.Method') }}</th>
        <th scope="col">{{ __('finance.Income') }}</th>
        <th scope="col">{{ __('finance.Expense') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>
                {{ formatDate($transaction->transaction_date) }}
            </td>
            <td>
                {{ $transaction->title }}
            </td>

            <td>
                {{ $transaction->payment_method_display }}
            </td>


            <td>
                @if($transaction->type == 'in')
                    {{ amountFormat($transaction->amount) }}
                @endif
            </td>

            <td>
                @if($transaction->type == 'out')
                    {{ amountFormat($transaction->amount) }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td>{{ trans('common.Total') }}</td>
        <td></td>
        <td></td>
        <td>{{ amountFormat($transactions->where('type','in')->sum('amount')) }}</td>
        <td>{{ amountFormat($transactions->where('type','out')->sum('amount')) }}</td>
    </tr>
    </tfoot>
</table>
