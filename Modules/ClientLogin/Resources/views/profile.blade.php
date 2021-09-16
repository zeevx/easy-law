@extends('layouts.master')

@section('mainContent')
    <section class="mb-40 student-details">
        @if(session()->has('message-success'))
            <div class="alert alert-success">
                {{ session()->get('message-success') }}
            </div>
        @elseif(session()->has('message-danger'))
            <div class="alert alert-danger">
                {{ session()->get('message-danger') }}
            </div>
        @endif
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Start Student Meta Information -->
                    <div class="main-title">
                        <h3 class="mb-20">@lang('client.Client Details')</h3>
                    </div>
                    <div class="student-meta-box">
                        <div class="student-meta-top"></div>
                        <img class="student-meta-img img-100"
                             src="{{ file_exists($user->avatar) ? asset($user->avatar) : asset('public\backEnd/img/staff.jpg') }}"
                             alt="">
                        <div class="white-box">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Name') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($user)){{@$user->name}}@endif
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Mobile') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($user)){{@$user->mobile}}@endif
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('client.Email') }}
                                    </div>
                                    <div class="value">
                                        @if(isset($user)){{@$user->email}}@endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Student Meta Information -->
                </div>
                <!-- Start Student Details -->
                <div class="col-lg-9 staff-details">
                    <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#studentProfile" role="tab"
                               data-toggle="tab">{{ __('client.Profile') }}</a>
                        </li>

                        <li class="nav-item edit-button">
                            <a href="#" class="primary-btn small fix-gr-bg"
                               data-toggle="modal" data-target="#profileEditForm">{{ __('common.Edit') }}
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Start Profile Tab -->
                        <div role="tabpanel" class="tab-pane fade show active" id="studentProfile">
                            <div class="white-box">
                                <h4 class="stu-sub-head">{{ __('client.Client Info') }}</h4>
                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Name') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($user)){{$user->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Mobile') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($user)){{$user->mobile}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Email') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($user)){{$user->email}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Client Category') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($user->category)){{@$user->category->name}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Address') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($user)){{$user->address}}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Country') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                {{ $user->country ? $user->country->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.State') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                {{ $user->state ? $user->state->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.City') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                {{ $user->city ? $user->city->name : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="single-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5">
                                            <div class="">
                                                {{ __('client.Description') }}
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-6">
                                            <div class="">
                                                @if(isset($user)){!! $user->description !!}@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(moduleStatusCheck('CustomField') and $user->customFields)
                                    @foreach($user->customFields as $field)
                                        <div class="single-info">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5">
                                                    <div class="">
                                                        {{ $field->field->title }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-7 col-md-6">
                                                    <div class="">

                                                        {!!  $field->show_value !!}

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="edit_form">

    </div>

    <div class="modal fade admin-query" id="profileEditForm">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('common.Edit Profile') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close "></i>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($user, ['route' => 'client.my_profile', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => false, 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="primary_input col-md-6">
                            {{Form::label('name', __('client.Client Name'), ['class' => 'required'])}}
                            {{Form::text('name', null, ['required' => '', 'class' => 'primary_input_field', 'placeholder' => __('client.Client Name')])}}
                        </div>
                        <div class="primary_input col-md-6">
                            {{Form::label('mobile', __('client.Client Mobile'))}}
                            {{Form::text('mobile', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Client Mobile')])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="primary_input col-md-6">
                            {{Form::label('email', __('client.Client Email'), ['class' => 'required'])}}
                            {{Form::email('email', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Client Email'), 'required' ])}}
                        </div>

                        <div class="primary_input col-md-6">
                            {{Form::label('gender', __('client.Gender'))}}
                            {{Form::select('gender', ['Male' => 'Male', 'FeMale' => 'FeMale'], null, ['class' => 'primary_select', 'data-placeholder' => __('client.Select Gender'), 'data-parsley-errors-container' => '#gender_error'])}}
                            <span id="gender_error"></span>
                        </div>

                    </div>

                    <div class="row">

                        <div class="primary_input col-md-4">
                            {{Form::label('country_id', __('client.Country'))}}
                            {{Form::select('country_id', $countries, config('configs')->where('key','country_id')->first()->value, ['class' => 'primary_select', 'id' => 'country_id', 'data-placeholder' => __('client.Select country'),  'data-parsley-errors-container' => '#country_id_error'])}}
                            <span id="country_id_error"></span>
                        </div>

                        <div class="primary_input col-md-4">
                            {{Form::label('state_id', __('client.State'))}}
                            {{Form::select('state_id', $states, null, ['class' => 'primary_select','id' => 'state_id', 'data-placeholder' => __('client.Select state'), 'data-parsley-errors-container' => '#state_id_error'])}}
                            <span id="state_id_error"></span>
                        </div>

                        <div class="primary_input col-md-4">
                            {{Form::label('city_id', __('client.City'))}}
                            {{Form::select('city_id', $cities, null, ['class' => 'primary_select','id' => 'city_id', 'data-placeholder' => __('client.Select city'), 'data-parsley-errors-container' => '#city_id_error'])}}
                            <span id="city_id_error"></span>
                        </div>

                    </div>


                    <div class="primary_input">
                        {{Form::label('address', __('client.Client Address'))}}
                        {{Form::textarea('address', null, ['class' => 'primary_input_field', 'placeholder' => __('client.Client Address'), 'rows' => 3])}}
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label" for="">{{ __('common.Avatar') }}</label>
                                <div class="primary_file_uploader">
                                    <input class="primary-input" type="text" id="placeholderFileTwoName" placeholder="{{ __('common.Browse file') }}" readonly="">
                                    <button class="" type="button">
                                        <label class="primary-btn small fix-gr-bg" for="document_file_2">{{ __('common.Browse') }}</label>
                                        <input type="file" class="d-none" name="file" id="document_file_2">
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    @includeIf('customfield::fields', ['fields' => $fields, 'model' => null])
                    <div class="text-center mt-3">
                        <button class="primary_btn_large submit" type="submit"><i
                                class="ti-check"></i>{{ __('common.Create') }}
                        </button>

                        <button class="primary_btn_large submitting" type="submit" disabled style="display: none;">
                            <i class="ti-check"></i>{{ __('common.Creating') . '...' }}
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin.scripts')
    <script>
        _formValidation();
        _componentAjaxChildLoad('#content_form', '#country_id', '#state_id', 'state')
        _componentAjaxChildLoad('#content_form', '#state_id', '#city_id', 'city')
    </script>
@endpush
