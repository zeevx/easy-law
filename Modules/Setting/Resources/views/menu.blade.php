@if(permissionCheck('setting.index'))
    @php
        $lang = ['languages.index', 'languages.edit', 'languages.show', 'languages.create' , 'language.translate_view'];
        $nav = array_merge(['setting', 'modulemanager.index'],  ['setting.updatesystem'])
    @endphp

    <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">
        <a href="javascript:" class="has-arrow" aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
            <div class="nav_icon_small">

                <span class="fa fa-cog"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('setting.Settings') }}</span>
            </div>
        </a>
        <ul>
            <li>
                <a href="{{url('setting')}}"
                   class="{{ spn_active_link('setting', 'active') }}">  {{ __('setting.General Settings') }}</a>
            </li>
            @if(permissionCheck('modulemanager.index'))
                <li>
                    <a href="{{ route('modulemanager.index') }}"
                       class="{{ spn_active_link('modulemanager.index', 'active') }}">{{ __('common.Module Manager') }}</a>
                </li>
            @endif

            @if(permissionCheck('languages.index'))
                <li>
                    <a href="{{ route('languages.index') }}"
                       class="{{ spn_active_link($lang, 'active') }}">{{ __('common.Language') }}</a>
                </li>
            @endif

            @if(permissionCheck('setting.updatesystem'))
                <li>
                    <a href="{{ route('setting.updatesystem') }}"
                       class="{{ spn_active_link('setting.updatesystem', 'active') }}">{{ __('setting.Update') }}</a>
                </li>
            @endif

        </ul>
    </li>


@endif
@if(permissionCheck('utilities'))
    <li class="{{ spn_active_link('utilities', 'mm-active') }}">
        <a href="{{ route('utilities') }}">
            <div class="nav_icon_small">
                <span class="fas fa-store"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('setting.Utilities') }}</span>
            </div>
        </a>
    </li>
@endif


