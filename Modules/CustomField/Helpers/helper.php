<?php


use Illuminate\Support\Facades\File;

if (!function_exists('generate_custom_field_normal_translated_select_option')) {
    function generate_custom_field_normal_translated_select_option($data): array
    {
        $options = array();
        foreach ($data as $key => $value) {
            $options[$value] = trans('list.' . $value);
        }
        return $options;
    }
}

if (!function_exists('get_custom_field_var')) {
    function get_custom_field_var($list): array
    {
        $file = module_path('CustomField', 'Resources/var/' . $list . '.json');
        return File::exists($file) ? json_decode(file_get_contents($file), true) : [];
    }
}

if (!function_exists('populate_status')) {
    function populate_status($status): string
    {
        if ($status){
            return '<span class="badge_1">'.__('common.Active').'</span>';
        } else {
            return '<span class="badge_2">'.__('common.inactive').'</span>';
        }
    }
}


if (!function_exists('gv')) {

    function gv($params, $key, $default = null)
    {
        return (isset($params[$key]) && $params[$key]) ? $params[$key] : $default;
    }
}

if (!function_exists('gbv')) {
    function gbv($params, $key)
    {
        return (isset($params[$key]) && $params[$key]) ? 1 : 0;
    }
}


function getFieldByType($form){
    return \Modules\CustomField\Entities\CustomField::with('childs', 'parent')->where('form_name', $form)->where('status', 1)->whereNull('controlled_field')->get();
}

