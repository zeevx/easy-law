<!doctype html>
@if(rtl())
    <html dir="rtl" class="rtl">
    @else
        <html>
        @endif
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
            <link rel="icon" href="{{ asset('public/uploads/settings/favicon.png')}}" type="image/png"/>
            <title>{{ isset($title) ? $title .' | '. config('configs')->where('key','site_title')->first()->value :  config('configs')->where('key','site_title')->first()->value }}</title>
            @if(rtl())
                <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/bootstrap.min.css')}}"/>
            @else
                <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
            @endif
            <link rel="stylesheet" href="{{ asset('public/login-asset/css/style.css') }}">
            <link rel="stylesheet" href="{{ asset('public/login-asset/css/login.css') }}">
            <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/toastr.min.css"/>
            <link rel="stylesheet" href="{{asset('public/css/parsley.css')}}">

            @stack('css')

        </head>


        <body class="login-resistration-area">
        <!-- main-login-area-start -->
        <div class="main-login-area login-res-v2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-xl-7 offset-xl-5">

                        @yield('content')


                    </div>
                </div>
            </div>
        </div>
        </body>

        <script src="{{ asset('public/backEnd/vendors/js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ route('assets.lang.js') }}"></script>
        <script src="{{ asset('public/backEnd/vendors/js/loadah.min.js') }}"></script>
        <script>
            function trans(string, args){
                let value = _.get(window.jsi18n, string);

                _.eachRight(args, (paramVal, paramKey) => {
                    value = paramVal.replace(`:${paramKey}`, value);
                });

                if(typeof value == 'undefined'){
                    return string;
                }

                return value;
            }
        </script>
        <script src="{{ asset('public/js/parsley.min.js') }}"></script>
        <script src="{{ asset('/backEnd/js/parsley_i18n/'.session()->get('locale', Config::get('app.locale')).'.js') }}"></script>
        <script src="{{ asset('public/backEnd/vendors/js/toastr.min.js')}}"></script>

        <script>
            // submit btn protect
            $(document).ready(function () {


                function ajax_error(data) {

                    if (data.status === 404) {
                        toastr.error(trans('js.What you are looking is not found'), trans('js.Opps'));
                        return;
                    } else if (data.status === 500) {
                        toastr.error(trans('js.Something went wrong. If you are seeing this message multiple times, please contact Spondon IT authors.'), trans('js.Opps'));
                        return;
                    } else if (data.status === 200) {
                        toastr.error(trans('js.Something is not right'), trans('js.Error'));
                        return;
                    }
                    let jsonValue = $.parseJSON(data.responseText);
                    let errors = jsonValue.errors;
                    if (errors) {
                        let i = 0;
                        $.each(errors, function(key, value) {
                            let first_item = Object.keys(errors)[i];
                            let error_el_id = $('#' + first_item);
                            if (error_el_id.length > 0) {
                                error_el_id.parsley().addError('ajax', {
                                    message: value,
                                    updateClass: true
                                });
                            }

                            toastr.error(value, trans('js.Validation Error'));
                            i++;
                        });
                    } else {
                        toastr.error(jsonValue.message, trans('js.Opps'));
                    }
                }

                function _formValidation(form_id = 'content_form', modal = false, modal_id = 'content_modal', ajax_table = null) {

                    const form = $('#' + form_id);

                    if (!form.length) {
                        return;
                    }

                    form.parsley().on('field:validated', function () {
                        $('.parsley-ajax').remove();
                        const ok = $('.parsley-error').length === 0;
                        $('.bs-callout-info').toggleClass('hidden', !ok);
                        $('.bs-callout-warning').toggleClass('hidden', ok);
                    });
                    form.on('submit', function (e) {
                        e.preventDefault();
                        $('.parsley-ajax').remove();
                        form.find('.submit').hide();
                        form.find('.submitting').show();
                        const submit_url = form.attr('action');
                        const method = form.attr('method');
                        //Start Ajax
                        const formData = new FormData(form[0]);
                        $.ajax({
                            url: submit_url,
                            type: method,
                            data: formData,
                            contentType: false, // The content type used when sending data to the server.
                            cache: false, // To unable request pages to be cached
                            processData: false,
                            dataType: 'JSON',
                            success: function (data) {
                                form.trigger("reset");
                                form.find("input:text:visible:first").focus();
                                toastr.success(data.message, trans('js.Success'));
                                if (modal) {
                                    $("." + modal_id).modal('hide');
                                }
                                if (ajax_table) {
                                    ajax_table.ajax.reload();
                                }

                                if (data.goto) {
                                    window.location.href = data.goto;
                                }

                                form.find('.submit').show();
                                form.find('.submitting').hide();

                            },
                            error: function (data) {
                                ajax_error(data);
                                form.find('.submit').show();
                                form.find('.submitting').hide();
                            }
                        });
                    });
                }

                _formValidation();
                _formValidation('content_form1');
                _formValidation('content_form2');
                _formValidation('content_form3');

            });

        </script>
        </html>
