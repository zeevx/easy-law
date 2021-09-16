@extends('layouts.master', ['title' => __('case.Cause List')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('case.Cause List')}} @isset($start_date) | {{ __('case.Date')}} :{{formatDate($start_date) }} @endisset</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="white_box_50px box_shadow_white">

                        {!! Form::open(['route' => 'causelist.index', 'method' => 'get', 'id' => 'content_form']) !!}

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="primary_input mb-15">
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    {{ Form::text('date_range', null, ['class' => 'primary_input_field primary-input form-control', 'required', 'placeholder' => __('common.select_criteria'),  'data-parsley-errors-container' => '#date_range_error', 'id' => 'date_range', 'readonly']) }}

                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                        <span id="date_range_error"></span>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" id="start">
                            <input type="hidden" id="end">
                            <div class="col-lg-6 mt-10">
                                <button type="submit" class="primary-btn small fix-gr-bg submit">
                                    <span class="ti-search pr-2"></span>
                                    {{ __('common.Search') }}</button>
                            </div>
                        </div>
                            {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-12">
                        <div class="box_header common_table_header">
                            <div class="main-title d-md-flex">
                                <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('case.Cause List') }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-center" id="loader">
                            <img src="{{ asset('public/backEnd/img/demo_wait.gif') }}" alt="">
                        </div>

                        <div class="QA_section QA_section_heading_custom check_box_table">
                            <div class="QA_table" id="report_data">

                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </section>



@stop
@push('admin.scripts')

<script>
    $('input[name="date_range"]').daterangepicker({
        ranges: {
            {!! json_encode(__('calender.Today')) !!}: [moment(), moment()],
            {!! json_encode(__('calender.Yesterday')) !!}: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            {!! json_encode(__('calender.Last 7 Days')) !!}: [moment().subtract(6, 'days'), moment()],
            {!! json_encode(__('calender.Last 30 Days')) !!}: [moment().subtract(29, 'days'), moment()],
            {!! json_encode(__('calender.This Month')) !!}: [moment().startOf('month'), moment().endOf('month')],
            {!! json_encode(__('calender.Last Month')) !!}: [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "separator": {!! json_encode(__('calender.separator')) !!},
            "applyLabel": {!! json_encode(__('calender.applyLabel')) !!},
            "cancelLabel": {!! json_encode(__('calender.cancelLabel')) !!},
            "fromLabel": {!! json_encode(__('calender.fromLabel')) !!},
            "toLabel": {!! json_encode(__('calender.toLabel')) !!},
            "customRangeLabel": {!! json_encode(__('calender.customRangeLabel')) !!},
            "weekLabel": {!! json_encode(__('calender.weekLabel')) !!},
            "daysOfWeek": {!! json_encode(__('calender.daysMin')) !!},
            "monthNames": {!! json_encode(__('calender.months')) !!}
        },
        "startDate": moment().subtract(7, 'days'),
        "endDate": moment()
    }, function (start, end, label) {
        $('#start').val(start.format('YYYY-MM-DD'))
        $('#end').val(end.format('YYYY-MM-DD'))
        get_filter_data({
            start_date: start.format('YYYY-MM-DD'),
            end_date: end.format('YYYY-MM-DD')
        });
    });

    $(document).ready(function(){
        let start_date = moment().subtract(7, 'days').format('YYYY-MM-DD');
        let end_date = moment().format('YYYY-MM-DD');
        $('#start').val(start_date)
        $('#end').val(end_date);
        get_filter_data({
            start_date: start_date,
            end_date: end_date
        })
    });

    $(document).on('submit', '#content_form', function(e){
        e.preventDefault();
        get_filter_data({
            start_date: $('#start').val(),
            end_date: $('#end').val()
        })
    })

    function get_filter_data(data) {
        var form = $('#content_form');
        $('#report_data').hide();
        $('#loader').show();

        const submit_url = form.attr('action');
        const method = form.attr('method');
        $.ajax({
            url: submit_url,
            type: method,
            data: data,
            dataType: 'html',
            success: function (data) {
                $('#report_data').html(data);
                startDatatable();
                $('#report_data').show();
                $('#loader').hide();

            },
            error: function (data) {
                ajax_error(data);
                $('#report_data').show();
                $('#loader').hide();
            }
        })
    }
</script>
@endpush
