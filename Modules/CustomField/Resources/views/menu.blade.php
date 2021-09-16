@if(permissionCheck('custom_fields.index'))

    @php
        $custom_fields = ['custom_fields.index', 'custom_fields.create', 'custom_fields.edit', 'custom_fields.show'];

    @endphp

    <li>
        <a  class="{{ spn_active_link($custom_fields) }}" href="{{ route('custom_fields.index') }}" >
            <div class="nav_icon_small">
                <span class="fas fa-th"></span>
            </div>
            <div class="nav_title">
                <span>{{__('custom_fields.custom_fields')}}</span>
            </div>
        </a>
    </li>
@endif
