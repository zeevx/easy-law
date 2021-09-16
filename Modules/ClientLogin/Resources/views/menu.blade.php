@if(permissionCheck('client.settings'))
    <li>
        <a href="{{route('client.settings')}}"  class="{{ spn_active_link('client.settings') }}"> {{__('common.Setting')}} </a>
    </li>
@endif
