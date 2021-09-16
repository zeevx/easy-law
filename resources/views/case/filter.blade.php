@extends('backEnd.master')

@section('mainContent')


    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('case.Filter Case')}} </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="white_box_50px box_shadow_white">

                        {!! Form::open(['route' => 'case.filter', 'method' => 'get']) !!}

                        <div class="row">
                            <div class="primary_input col-md-3">
                                {{Form::label('case_category_id', __('case.Case Category'))}}
                                {{Form::select('case_category_id', $case_categories, $case_category_id, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Case Category'),  'data-parsley-errors-container' => '#case_category_id_error'])}}
                                <span id="case_category_id_error"></span>
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('case_no', __('case.Case No'))}}
                                {{Form::text('case_no', $case_no, ['class' => 'primary_input_field', 'placeholder' => __('case.Case No')])}}
                            </div>
                            <div class="primary_input col-md-3">
                                {{Form::label('file_no', __('case.Case File No'))}}
                                {{Form::text('file_no', $file_no, ['class' => 'primary_input_field', 'placeholder' => __('case.Case File No')])}}
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('acts', __('case.Case Acts'))}}
                                {{Form::select('acts[]', $db_acts, $acts, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Acts'),  'data-parsley-errors-container' => '#act_error', 'multiple' => '', 'id' => 'acts'])}}
                                <span id="act_error"></span>
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('client_id', __('case.Client'))}}
                                {{Form::select('client_id', $clients->prepend(__('case.Select Client'), ''), $client_id, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Client'), 'data-parsley-errors-container' => '#client_id_error'])}}
                                <span id="client_id_error"></span>
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('court_id', __('case.Court'))}}
                                {{Form::select('court_id', $courts, $court_id, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Court'),  'data-parsley-errors-container' => '#court_id_error'])}}
                                <span id="court_id_error"></span>
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('stage_id', __('case.Case Stage'))}}
                                {{Form::select('stage_id', $stages, $stage_id, ['class' => 'primary_select', 'data-placeholder' => __('case.Select Case Stage'),  'data-parsley-errors-container' => '#stage_id_error'])}}
                                <span id="stage_id_error"></span>
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('receiving_date', __('case.Receiving Date'))}}
                                {{Form::text('receiving_date', $receiving_date, ['class' => 'primary_input_field primary-input date form-control date', "id"=>"receiving_date",'placeholder' => __('case.Date')])}}
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('filling_date', __('case.Filling Date'))}}
                                {{Form::text('filling_date', $filling_date, ['class' => 'primary_input_field primary-input date form-control date', "id"=>"filling_date",'placeholder' => __('case.Filling Date')])}}
                            </div>

                            <div class="primary_input col-md-3">
                                {{Form::label('hearing_date', __('case.Hearing Date'))}}
                                {{Form::text('hearing_date', $hearing_date, ['class' => 'primary_input_field primary-input date form-control date', "id"=>"hearing_date",'placeholder' => __('case.Hearing Date')])}}
                            </div>
                            <div class="primary_input col-md-3">
                                {{Form::label('judgement_date', __('case.Judgement Date'))}}
                                {{Form::text('judgement_date', $judgement_date, ['class' => 'primary_input_field primary-input date form-control date', "id"=>"judgement_date",'placeholder' => __('case.Judgement Date')])}}
                            </div>


                            <div class="col-md-3 mt-40">
                                <div class="primary_input mb-15 d-flex align-items-center justify-content-between gap_10">
                                    <button type="submit" class="primary-btn fix-gr-bg flex-grow-1 text-nowrap" id="submit" value="submit" ><i class="ti-search"></i>{{ __('case.Get List') }}</button>
                                    <a href="{{ route('case.filter') }}" class="primary-btn fix-gr-bg flex-grow-1 text-nowrap" ><i class="ti-back-left"></i>{{ __('case.Reset') }}</a>
                                </div>

                            </div>


                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('case.Filter Case List') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>

                                        <th scope="col">{{ __('common.SL') }}</th>
                                        <th>{{ __('case.Case') }}</th>
                                        <th>{{ __('case.Plaintiff') }}</th>
                                        <th>{{ __('case.Opposite') }}</th>
                                        <th>{{ __('case.Court') }}</th>
                                        <th>{{ __('case.Date') }}</th>
                                        <th>{{ __('case.Acts') }}</th>
                                        <th class="noprint">{{ __('common.Actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($models as $model)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <b>{{ __('case.Case No.') }}: </b> {{$model->case_category? $model->case_category->name : '' }}/{{$model->case_no}}, <br>
                                                <b>{{ __('case.File No.') }}: </b> {{$model->file_no}}, <br>
                                               <b>{{ __('case.Category') }}: </b> {{$model->case_category? $model->case_category->name : '' }},  <br>
                                                <b>{{ __('case.Title') }}: </b>{{ $model->title }},
                                                <br>
                                                <b>{{ __('case.Case Stage') }}: </b> {{ @$model->stage->name }},
                                            </td>
                                            <td>

                                                    <b>{{ __('case.Name') }}</b>: {{ @$model->plaintiff_client->name }} <br>
                                                    <b>{{ __('case.Mobile') }}: </b> {{ @$model->plaintiff_client->mobile }} <br>
                                                    <b>{{ __('case.Email') }}: </b> {{ @$model->plaintiff_client->email }} <br>
                                                    <b>{{ __('case.Address') }}: </b> {{ @$model->plaintiff_client->address }}
                                                    {{ @$model->plaintiff_client->district ? ', '. $model->plaintiff_client->district->name : '' }}
                                                    {{ @$model->plaintiff_client->division ? ', '. $model->plaintiff_client->division->name : '' }}

                                            </td>
                                            <td>
                                                <b>{{ __('case.Name') }}</b>: {{ @$model->opposite_client->name }} <br>
                                                <b>{{ __('case.Mobile') }}: </b> {{ @$model->opposite_client->mobile }} <br>
                                                <b>{{ __('case.Email') }}: </b> {{ @$model->opposite_client->email }} <br>
                                                <b>{{ __('case.Address') }}: </b> {{ @$model->opposite_client->address }}
                                                {{ @$model->opposite_client->district ? ', '. $model->opposite_client->district->name : '' }}
                                                {{ @$model->opposite_client->division ? ', '. $model->opposite_client->division->name : '' }}
                                            </td>
                                            <td>
                                                @if($model->court)
                                                   <b>{{ __('case.Court') }}</b>: {{ @$model->court->name}}<br>
                                                     <b>{{ __('case.Category') }}</b>: {{ @$model->court->court_category ? $model->court->court_category->name : '' }}<br>
                                                    <b>{{ __('case.Room No') }}: </b> {{ @$model->court->room_number }} <br>
                                                    <b>{{ __('case.Address') }}: </b> {{ @$model->court->location }}
                                                    {{ @$model->court->district ? ', '. $model->court->district->name : '' }}
                                                    {{ @$model->court->division ? ', '. $model->court->division->name : '' }}
                                                @endif
                                            </td>
                                            <td>
                                                <b>{{ __('case.Next Hearing Date') }}: </b> {{ formatDate($model->hearing_date) }} <br>
                                                <b>{{ __('case.Filing Date') }}: </b> {{ formatDate($model->filling_date) }},
                                                <br>
                                                <b>{{ __('case.Receiving Date') }}: </b> {{ formatDate($model->receiving_date) }},
                                                <br>
                                                <b>{{ __('case.Judgment Date') }}: </b> {{ formatDate($model->judgment_date) }},
                                            </td>
                                            <td>
                                                <b>{{ __('case.Acts') }}: </b>
                                                    @if ($model->acts)
                                                        @foreach ($model->acts as $act)
                                                            {{$act->act ? $act->act->name .', ': ''}}
                                                        @endforeach
                                                    @endif
                                            </td>

                                            <td>


                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">

                                                        <a href="{{ route('case.show', $model->id) }}" class="dropdown-item"><i class="icon-file-eye"></i> {{ __('common.View') }}</a>
                                                        @if(!$model->judgement)
                                                            <a href="{{route('case.edit', $model->id)}}" class="dropdown-item"><i class="icon-pencil mr-2"></i>{{ __('common.Edit') }}</a>
                                                            <a href="{{route('date.create', ['case' => $model->id])}}" class="dropdown-item"><i
                                                                    class="icon-calendar3 mr-2"></i>{{ __('case.New Date') }}</a>
                                                            <a href="{{route('putlist.create', ['case' => $model->id])}}" class="dropdown-item"><i
                                                                    class="icon-calendar3 mr-2"></i>{{ __('case.New Put Up Date') }}</a>
                                                            <a href="{{route('judgement.create', ['case' => $model->id])}}" class="dropdown-item"><i
                                                                    class="icon-calendar3 mr-2"></i>{{ __('case.New Judgement Date') }}</a>
                                                        @endif

                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@stop
@push('admin.scripts')

    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
