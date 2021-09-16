<ul id="sidebar_menu">
    <li>
        <a class="{{ spn_active_link('client.my_dashboard') }}" href="{{ route('client.my_dashboard') }}">
            <div class="nav_icon_small">
                <span class="fas fa-th"></span>
            </div>
            <div class="nav_title">
                <span>{{__('dashboard.Dashboard')}}</span>
            </div>
        </a>
    </li>

    <li>
        <a class="{{ spn_active_link(['client.my_cases', 'client.case.show']) }}" href="{{ route('client.my_cases') }}">
            <div class="nav_icon_small">
                <span class="fas fa-list"></span>
            </div>
            <div class="nav_title">
                <span>{{__('client.my_cases')}}</span>
            </div>
        </a>
    </li>
    <li>
        <a class="{{ spn_active_link(['client.my_waiting_cases']) }}" href="{{ route('client.my_waiting_cases') }}">
            <div class="nav_icon_small">
                <span class="fas fa-list"></span>
            </div>
            <div class="nav_title">
                <span>{{__('client.my_waiting_cases')}}</span>
            </div>
        </a>
    </li>
    <li>
        <a class="{{ spn_active_link(['client.my_closed_cases']) }}" href="{{ route('client.my_closed_cases') }}">
            <div class="nav_icon_small">
                <span class="fas fa-list"></span>
            </div>
            <div class="nav_title">
                <span>{{__('client.my_closed_cases')}}</span>
            </div>
        </a>
    </li>
    <li>
        <a class="{{ spn_active_link(['client.my_judgement_cases']) }}" href="{{ route('client.my_judgement_cases') }}">
            <div class="nav_icon_small">
                <span class="fas fa-list"></span>
            </div>
            <div class="nav_title">
                <span>{{__('client.my_judgement_cases')}}</span>
            </div>
        </a>
    </li>

    <li>
        <a class="{{ spn_active_link(['client.my_profile']) }}" href="{{ route('client.my_profile') }}">
            <div class="nav_icon_small">
                <span class="fas fa-user"></span>
            </div>
            <div class="nav_title">
                <span>{{__('common.Profile')}}</span>
            </div>
        </a>
    </li>
    <li>
        <a class="{{ spn_active_link(['change_password']) }}" href="{{ route('change_password') }}">
            <div class="nav_icon_small">
                <span class="fas fa-key"></span>
            </div>
            <div class="nav_title">
                <span>{{__('common.Change Password')}}</span>
            </div>
        </a>
    </li>
</ul>
