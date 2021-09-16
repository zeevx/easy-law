<?php

if (!function_exists('generate_finance_normal_translated_select_option')) {
    function generate_finance_normal_translated_select_option($data): array
    {
        $options = array();
        foreach ($data as $key => $value) {
            $options[$value] = trans('list.' . $value);
        }
        return $options;
    }
}

if (!function_exists('get_finance_var')) {
    function get_finance_var($list): array
    {
        $file = module_path('Finance', 'Resources/var/' . $list . '.json');
        return File::exists($file) ? json_decode(file_get_contents($file), true) : [];
    }
}

if (!function_exists('formatInvoiceNumber')) {
    function formatInvoiceNumber($number, $invoice_type): string
    {
        $prefix = getConfig($invoice_type.'_invoice_prefix', 'IA-'. ucfirst($invoice_type));
        $invoice_format = getConfig('invoice_format', 'IA-'. ucfirst($invoice_type));
        $separator = getConfig('invoice_number_separator', '-');
        $number = str_pad($number, getConfig('invoice_number_padding', 4), 0, STR_PAD_LEFT);
        $formatted = $number;
        if ($invoice_format == 2){
            $formatted = date('Y').$separator.$number;
        } elseif($invoice_format == 3){
            $formatted = $number. $separator .date('y');
        } elseif($invoice_format == 4){
            $formatted = $number. $separator .date('m'.$separator.'y');
        }

        return $prefix.$separator.$formatted;
    }
}


