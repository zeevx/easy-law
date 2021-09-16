@extends('layouts.master')

@section('mainContent')
    <div id="contact_settings">
        <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30">{{ __('common.Settings') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="white_box_50px box_shadow_white">
                            <!-- Prefix  -->
                            <form action="{{ route('client.settings') }}" method="POST" id="content_form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3 d-flex">
                                                <p class="text-uppercase fw-500 mb-10">{{__('common.Login Permission')}} </p>
                                            </div>
                                            <div class="col-lg-9">

                                                <div class="radio-btn-flex ml-20">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="">
                                                                <input type="radio" name="client_login" id="enable" value="1" class="common-radio relationButton" {{ (config('configs')->where('key','client_login')->first()->value) ? 'checked' : ''}} >
                                                                <label for="enable">{{__('common.Enable')}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="">
                                                                <input type="radio" name="client_login" id="disable" value="0" {{ (config('configs')->where('key','client_login')->first()->value) ? '' : 'checked'}} class="common-radio relationButton" >
                                                                <label for="disable">{{__('common.Disable')}}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 text-center">
                                                            <button class="primary-btn fix-gr-bg" id="_submit_btn_admission">
                                                                <span class="ti-check"></span>
                                                                {{__('common.Save')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop

@push('admin.scripts')
    <script>
        _formValidation();
    </script>
    @endpush
