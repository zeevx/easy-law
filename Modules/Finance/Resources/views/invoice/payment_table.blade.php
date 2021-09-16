<div class="QA_section QA_section_heading_custom check_box_table">
    <div class="QA_table ">
        <table class="table table-sm {{ $dataTable ?? '' }}">
            <thead>
            <tr>
                <th>{{ __('finance.Sl') }}</th>
                <th>{{ __('finance.Date') }}</th>
                <th>{{ __('finance.Title') }}</th>
                <th>{{ __('finance.Method') }}</th>
                <th class="text-right">{{ __('finance.Amount') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $payment_total = 0;
            @endphp

            @foreach($model->transactions as $transaction)
                @php
                    if (($model->invoice_type == 'income' and $transaction->type == 'in') or ($model->invoice_type == 'expense' and $transaction->type == 'out')){
                        $payment_total += $transaction->amount;
                    } else {
                        $payment_total -= $transaction->amount;
                    }
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ formatDate($transaction->transaction_date) }}</td>
                    <td>{{ $transaction->title }}</td>
                    <td>
                        {{ $transaction->payment_method_display }}
                    </td>
                    <td class="text-right">
                        @if(($model->invoice_type == 'income' and $transaction->type == 'out') or ($model->invoice_type == 'expense' and $transaction->type == 'in'))
                            (-)
                        @endif
                        {{ amountFormat($transaction->amount) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4" class="text-right"> {{ __('finance.Total') }}</td>
                <td class="text-right"> {{ amountFormat($payment_total) }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
