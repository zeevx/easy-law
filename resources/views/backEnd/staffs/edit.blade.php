@extends('layouts.master', ['title' => __('Edit Staff')])
@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header">
                        <div class="main-title d-flex">
                            <h3 class="mb-0 mr-30">{{ __('common.Edit Staff Info') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <form action="{{ route('staffs.update', $staff->user->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="user_id" value="{{$staff->user_id}}">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-0 mr-30">{{ __('common.Basic Info') }}</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label required"
                                               for="">{{ __('common.Name') }}</label>
                                        <input name="name" class="primary_input_field name"
                                               placeholder="{{ __('common.Name') }}" value="{{ @$staff->user->name }}"
                                               type="text" required>
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label required"
                                               for="">{{ __('common.Email') }}</label>
                                        <input name="email" class="primary_input_field name"
                                               placeholder="{{ __('common.Email') }}" value="{{ @$staff->user->email }}"
                                               type="email">
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Phone') }}</label>
                                        <input type="number" class="primary_input_field user_id name"
                                               placeholder="{{ __('common.Phone') }}" name="phone"
                                               value="{{ @$staff->phone }}">
                                        <span class="text-danger">{{$errors->first('phone')}}</span>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="password">{{__('common.Password')}}</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i style="cursor:pointer;" class="fas fa-eye-slash eye toggle-password"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control primary_input_field"
                                                   id="password" name="password"
                                                   placeholder="{{__('common.Minimum 8 characters')}}" {{$errors->first('password') ? 'autofocus' : ''}}>
                                        </div>
                                        <span class="text-danger">{{$errors->first('password')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="password_confirmation">{{__('common.Confirm Password')}}</label>

                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i style="cursor:pointer;" class="fas fa-eye-slash eye toggle-password"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control primary_input_field"
                                                   id="password_confirmation" name="password_confirmation"
                                                   placeholder="{{__('common.Confirm Password')}}" {{$errors->first('password_confirmation') ? 'autofocus' : ''}}>
                                        </div>
                                        <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                                    </div>
                                </div>



                                @if($staff->user->role_id != 1)
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label requried" for="">{{ __('role.Role') }}</label>
                                        <select class="primary_select mb-25" name="role_id" id="role_id" required
                                                onchange="getRoleField()">
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role->id }}-{{ $role->type }}"
                                                        @if ($role->id == $staff->user->role_id) selected @endif>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{$errors->first('role_id')}}</span>
                                    </div>
                                </div>
                                @endif

                                <div class="col-xl-6 date_of_birth_div">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label requried"
                                               for="">{{ __('common.Date of Birth') }}</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{ __('common.Date') }}"
                                                               class="primary_input_field primary-input date form-control"
                                                               id="date_of_birth" type="text" name="date_of_birth"
                                                               value="{{ $staff->date_of_birth??date('Y-m-d') }}"
                                                               autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6 current_address_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Current Address') }}</label>
                                        <input name="current_address" id="current_address"
                                               class="primary_input_field name"
                                               placeholder="{{ __('common.Current Address') }}"
                                               value="{{ $staff->current_address }}" type="text">
                                        <span class="text-danger">{{$errors->first('current_address')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6 permanent_address_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Permanent Address') }}</label>
                                        <input name="permanent_address" id="permanent_address"
                                               class="primary_input_field name"
                                               placeholder="{{ __('common.Permanent Address') }}"
                                               value="{{ $staff->permanent_address }}" type="text">
                                        <span class="text-danger">{{$errors->first('permanent_address')}}</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{ __('common.Avatar') }}</label>
                                        <div class="primary_file_uploader">
                                            <input class="primary-input" type="text" id="placeholderPhoto"
                                                   placeholder="{{ __('common.Browse file') }}" readonly="">
                                            <button class="" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                       for="photo">{{ __('common.Browse') }}</label>
                                                <input type="file" class="d-none" name="photo" id="photo">
                                            </button>
                                        </div>
                                        <span class="text-danger">{{$errors->first('photo')}}</span>


                                    </div>
                                </div>

                                @if($staff->user->role_id != 1)
                                <div class="col-xl-12 mt-5 bank_info_div">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-0 mr-30">{{ __('common.Bank Info') }}</h3>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-xl-6 bank_name_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Bank Name') }}</label>
                                        <input name="bank_name" id="bank_name" class="primary_input_field name"
                                               placeholder="{{ __('common.Bank Name') }}"
                                               value="{{ $staff->bank_name }}" type="text">
                                        <span class="text-danger">{{$errors->first('bank_name')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6 bank_branch_name_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Bank Branch Name') }}</label>
                                        <input name="bank_branch_name" id="bank_branch_name"
                                               class="primary_input_field name"
                                               placeholder="{{ __('common.Bank Branch Name') }}"
                                               value="{{ $staff->bank_branch_name }}" type="text">
                                        <span class="text-danger">{{$errors->first('bank_branch_name')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6 bank_account_name_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Account Name') }}</label>
                                        <input name="bank_account_name" id="bank_account_name"
                                               class="primary_input_field name"
                                               placeholder="{{ __('common.Account Name') }}"
                                               value="{{ $staff->bank_account_name }}" type="text">
                                        <span class="text-danger">{{$errors->first('bank_account_name')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6 bank_account_no_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Bank Account Number') }}</label>
                                        <input name="bank_account_no" id="bank_account_no"
                                               class="primary_input_field name"
                                               placeholder="{{ __('common.Bank Account Number') }}"
                                               value="{{ $staff->bank_account_no }}" type="text">
                                        <span class="text-danger">{{$errors->first('bank_account_no')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-12 mt-5 payroll_info_div">
                                    <div class="main-title d-flex">
                                        <h3 class="mb-0 mr-30">{{ __('common.Payroll Info') }}</h3>
                                    </div>
                                </div>
                                <hr>

                                <div class="col-xl-6 date_of_joining_div">
                                    <div class="primary_input mb-15">
                                        <label class="primary_input_label" for="">{{ __('common.Date of Joining') }}
                                            *</label>
                                        <div class="primary_datepicker_input">
                                            <div class="no-gutters input-right-icon">
                                                <div class="col">
                                                    <div class="">
                                                        <input placeholder="{{ __('common.Date') }}"
                                                               class="primary_input_field primary-input date form-control"
                                                               id="date_of_joining" type="text" name="date_of_joining"
                                                               value="{{ $staff->date_of_joining??date('Y-m-d') }}"
                                                               autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <button class="" type="button">
                                                    <i class="ti-calendar" id="start-date-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('date_of_joining')}}</span>
                                    </div>
                                </div>
                                <div class="col-xl-6 basic_salary_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Basic Salary') }}</label>
                                        <input name="basic_salary" id="basic_salary" class="primary_input_field name"
                                               placeholder="{{ __('common.Basic Salary') }}" type="number"
                                               value="{{ $staff->basic_salary }}" required>
                                        <span class="text-danger">{{$errors->first('basic_salary')}}</span>
                                    </div>
                                </div>

                                <div class="col-xl-6 employee_type_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label"
                                               for="">{{ __('common.Employment Type') }}</label>
                                        <select class="primary_select mb-25" name="employment_type" id="employment_type"
                                                onchange="getField()">
                                            <option value="">{{ __('common.Select One') }}</option>
                                            <option value="Provision"
                                                    @if ($staff->employment_type == "Provision") selected @endif>{{ __('common.Provision') }}</option>
                                            <option value="Contract"
                                                    @if ($staff->employment_type == "Contract") selected @endif>{{ __('common.Contract') }}</option>
                                            <option value="Permanent"
                                                    @if ($staff->employment_type == "Permanent") selected @endif>{{ __('common.Permanent') }}</option>
                                        </select>
                                        <span class="text-danger">{{$errors->first('employment_type')}}</span>
                                    </div>
                                </div>
                                <div class="col-xl-6 provisional_time_div">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.Provision Time') }}
                                            <small>({{ __('common.In Months') }})</small> </label>
                                        <input name="provisional_months" id="provisional_time"
                                               class="primary_input_field name" placeholder="0" type="number"
                                               value="{{ $staff->provisional_months }}" required>
                                        <span class="text-danger">{{$errors->first('provisional_months')}}</span>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="d-block">

                                @includeIf('customfield::fields', ['fields' => $fields, 'model' => $staff])

                                <div class="col-lg-12 text-center">
                                    <div class="d-flex justify-content-center pt_20">
                                        <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                                id="save_button_parent"><i
                                                class="ti-check"></i>{{ __('common.Update') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            getField();
            getRoleField();
            $(document).on('keyup', '#password', function () {
                if ($(this).val()) {
                    $('#password_confirmation').attr('required', true);
                    $("label[for='password_confirmation']").addClass('required');
                } else {
                    $('#password_confirmation').attr('required', false);
                    $("label[for='password_confirmation']").removeClass('required');
                }
            })
        });

        function getField() {
            var employment_type = $('#employment_type').val();
            if (employment_type == "Provision") {
                $("#provisional_time").removeAttr("disabled");
            } else if (employment_type == "Contract") {
                $("#provisional_time").attr('disabled', true);
            } else {
                $("#bank_name").attr('Permanent', true);
                $("#provisional_time").attr('disabled', true);
            }
        }

        function getRoleField() {
            var role_id = $('#role_id').val().split('-');
            if (role_id[1] == "system_user") {
                $("#employee_id").attr('disabled', true);
                $("#date_of_birth").attr('disabled', true);
                $("#bank_name").attr('disabled', true);
                $("#bank_branch_name").attr('disabled', true);
                $("#bank_account_name").attr('disabled', true);
                $("#bank_account_no").attr('disabled', true);
                $("#date_of_joining").attr('disabled', true);
                $("#basic_salary").attr('disabled', true);
                $("#provisional_time").attr('disabled', true);
                $("#current_address").attr('disabled', true);
                $("#permanent_address").attr('disabled', true);
                $(".employee_type_div").hide();
                $(".date_of_birth_div").hide();
                $(".bank_name_div").hide();
                $(".bank_branch_name_div").hide();
                $(".bank_account_name_div").hide();
                $(".bank_account_no_div").hide();
                $(".date_of_joining_div").hide();
                $(".basic_salary_div").hide();
                $(".provisional_time_div").hide();
                $(".current_address_div").hide();
                $(".permanent_address_div").hide();
                $(".bank_info_div").hide();
                $(".payroll_info_div").hide();
                $(".opening_balance_div").hide();
            } else {
                $("#employee_id").removeAttr("disabled");
                $("#employee_id").removeAttr("disabled");
                $("#date_of_birth").removeAttr("disabled");
                $("#bank_name").removeAttr("disabled");
                $("#bank_branch_name").removeAttr("disabled");
                $("#bank_account_name").removeAttr("disabled");
                $("#bank_account_no").removeAttr("disabled");
                $("#date_of_joining").removeAttr("disabled");
                $("#basic_salary").removeAttr("disabled");
                $("#provisional_time").removeAttr("disabled");
                $("#current_address").removeAttr("disabled");
                $("#permanent_address").removeAttr("disabled");
                $(".employee_type_div").show();
                $(".employee_type_div").show();
                $(".date_of_birth_div").show();
                $(".bank_name_div").show();
                $(".bank_branch_name_div").show();
                $(".bank_account_name_div").show();
                $(".bank_account_no_div").show();
                $(".date_of_joining_div").show();
                $(".basic_salary_div").show();
                $(".provisional_time_div").show();
                $(".current_address_div").show();
                $(".permanent_address_div").show();
                $(".bank_info_div").show();
                $(".payroll_info_div").show();
                $(".opening_balance_div").show();
            }
        }
    </script>
@endpush
