<!-- table-responsive -->
<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th scope="col">{{ __('common.Date') }}</th>
        <th scope="col">{{ __('finance.Income') }}</th>
        <th scope="col">{{ __('finance.Expense') }}</th>
        <th scope="col" >{{ __('finance.Profit') }}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
       <td>
           @if(!$data['start'] and !$data['end'])
               {{ __('finance.From The Beginning') }}
           @else
               {{ formatDate($data['start']) }} - {{ formatDate($data['end']) }}
           @endif
       </td>

        <td>
            {{ amountFormat($data['income']) }}
        </td>
        <td>
            {{ amountFormat($data['expense']) }}
        </td>
        <td>
            {{ amountFormat($data['income'] - $data['expense']) }}
        </td>


    </tr>

    </tbody>
</table>
