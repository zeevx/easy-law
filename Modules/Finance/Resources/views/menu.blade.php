@if(permissionCheck('vendors.index'))
    <li class="{{ spn_active_link(['vendors.index', 'vendors.create', 'vendors.edit', 'vendors.show'], 'mm-active') }}">
        <a href="{{ route('vendors.index') }}">
            <div class="nav_icon_small">
                <span class="fas fa-store"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('vendor.Vendor') }}</span>
            </div>
        </a>
    </li>
@endif


@if(permissionCheck('services.index'))

    <li class="{{ spn_active_link(['services.index', 'services.create', 'services.edit', 'services.show'], 'mm-active') }}">
        <a href="{{ route('services.index') }}">
            <div class="nav_icon_small">
                <span class="fas fa-store"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('finance.Service') }}</span>
            </div>
        </a>
    </li>
@endif

@if(permissionCheck('finance.index'))
    @php
        $income_type = ['income_types.index', 'income_types.edit', 'income_types.show', 'income_types.create'];
        $expense_type = ['expense_types.index', 'expense_types.edit', 'expense_types.show', 'expense_types.create'];
        $bank_account = ['bank_accounts.index', 'bank_accounts.edit', 'bank_accounts.show', 'bank_accounts.create'];
        $tax = ['taxes.index', 'taxes.edit', 'taxes.show', 'taxes.create'];
        $income = ['incomes.index', 'incomes.edit', 'incomes.show', 'incomes.create'];
        $expense = ['expenses.index', 'expenses.edit', 'expenses.show', 'expenses.create'];

        $nav = array_merge($income_type, $expense_type, $bank_account, $tax, $income, $expense, ['report.profit', 'report.transaction', 'report.statement'])
    @endphp

    <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">

        <a href="javascript:" class="has-arrow" aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
            <div class="nav_icon_small">

                <span class="fas fa-dollar"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('finance.Finance') }}</span>
            </div>
        </a>
        <ul>
            @if(permissionCheck('income_types.index'))
                <li>
                    <a href="{{route('income_types.index')}}"
                       class="{{ spn_active_link($income_type) }}">  {{ __('finance.Income Type List') }}</a>
                </li>
            @endif
            @if(permissionCheck('expense_types.index'))
                <li>
                    <a href="{{route('expense_types.index')}}"
                       class="{{ spn_active_link($expense_type) }}">  {{ __('finance.Expense Type List') }}</a>
                </li>
            @endif

            @if(permissionCheck('bank_accounts.index'))
                <li>
                    <a href="{{route('bank_accounts.index')}}"
                       class="{{ spn_active_link($bank_account) }}">  {{ __('finance.Bank Account List') }}</a>
                </li>
            @endif

            @if(permissionCheck('taxes.index'))
                <li>
                    <a href="{{route('taxes.index')}}"
                       class="{{ spn_active_link($tax) }}">  {{ __('finance.Tax List') }}</a>
                </li>
            @endif

            @if(permissionCheck('incomes.index'))
                <li>
                    <a href="{{route('incomes.index')}}"
                       class="{{ spn_active_link($income) }}">  {{ __('finance.Income List') }}</a>
                </li>
            @endif

            @if(permissionCheck('expenses.index'))
                <li>
                    <a href="{{route('expenses.index')}}"
                       class="{{ spn_active_link($expense) }}">  {{ __('finance.Expense List') }}</a>
                </li>
            @endif

            @if (permissionCheck('report.profit'))
                <li>
                    <a href="{{ route('report.profit') }}" class="{{ spn_active_link('report.profit') }}"
                       class="">
                        {{ __('finance.Profit') }}
                    </a>
                </li>
            @endif

            @if (permissionCheck('report.transaction'))
                <li>
                    <a href="{{ route('report.transaction') }}"
                       class="{{ spn_active_link('report.transaction') }}"
                       class="">
                        {{ __('finance.Transactions') }}
                    </a>
                </li>
            @endif

            @if (permissionCheck('report.statement'))
                <li>
                    <a href="{{ route('report.statement') }}" class="{{ spn_active_link('report.statement') }}"
                       class="">
                        {{ __('finance.Statements') }}
                    </a>
                </li>
            @endif


        </ul>
    </li>
@endif

@if(permissionCheck('invoice.index'))
    @php
        $income = ['invoice.incomes.index', 'invoice.incomes.edit', 'invoice.incomes.show', 'invoice.incomes.create'];
        $expense = ['invoice.expenses.index', 'invoice.expenses.edit', 'invoice.expenses.show', 'invoice.expenses.create'];

        $nav = array_merge($income, $expense, ['invoice.settings'])
    @endphp

    <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">

        <a href="javascript:" class="has-arrow" aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
            <div class="nav_icon_small">

                <span class="fas fa-clipboard"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('finance.Invoices') }}</span>
            </div>
        </a>
        <ul>
            @if(permissionCheck('invoice.incomes.index'))
                <li>
                    <a href="{{route('invoice.incomes.index')}}"
                       class="{{ spn_active_link($income) }}">  {{ __('finance.Income Invoice List') }}</a>
                </li>
            @endif

            @if(permissionCheck('invoice.expenses.index'))
                <li>
                    <a href="{{route('invoice.expenses.index')}}"
                       class="{{ spn_active_link($expense) }}">  {{ __('finance.Expense Invoice List') }}</a>
                </li>
            @endif

            @if(permissionCheck('invoice.settings'))
                <li>
                    <a href="{{ route('invoice.settings') }}"
                       class="{{ spn_active_link(['invoice.settings']) }}">  {{ __('finance.Invoice Settings') }}</a>
                </li>
            @endif
        </ul>
    </li>
@endif



