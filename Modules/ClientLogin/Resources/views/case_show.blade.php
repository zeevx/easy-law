@extends('layouts.master', ['title' => __('case.Case Details')])

@section('mainContent')



    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">{{ $model->title }}</h3>
                    </div>
                </div>

                <div class="col-lg-12 d-print-none">

                    <a class="primary-btn small fix-gr-bg print_window"
                       href="{{ route('client.case.show', [$model->id, 'print' => true]) }}" target="_blank"><i
                            class="ti-printer mr-2"></i>
                        {{ __('case.Print') }}
                    </a>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-8">


                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row mb-4">
                                <div class="col-lg-4 no-gutters">
                                    <div class="main-title">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">


                                    @foreach($model->hearing_dates as $date)

                                        @if($date->type == 'lobbying')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name mr-1">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Lobbying') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(moduleStatusCheck('CustomField') and $date->customFields)

                                                        @foreach($date->customFields as $field)
                                                            <div class="single-meta">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="name mr-1">
                                                                        {{ $field->field->title }} :
                                                                    </div>
                                                                    <div class="value">
                                                                        {!!  $field->show_value !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'lobbying'])


                                                </div>
                                            </div>
                                        @elseif($date->type == 'putlist')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Put up Date') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(moduleStatusCheck('CustomField') and $date->customFields)

                                                        @foreach($date->customFields as $field)
                                                            <div class="single-meta">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="name mr-1">
                                                                        {{ $field->field->title }} :
                                                                    </div>
                                                                    <div class="value">
                                                                        {!!  $field->show_value !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>
                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' =>'putlist'])

                                                </div>
                                            </div>
                                        @elseif($date->type == 'close')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Closed case') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(moduleStatusCheck('CustomField') and $date->customFields)

                                                        @foreach($date->customFields as $field)
                                                            <div class="single-meta">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="name mr-1">
                                                                        {{ $field->field->title }} :
                                                                    </div>
                                                                    <div class="value">
                                                                        {!!  $field->show_value !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>
                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])


                                                </div>
                                            </div>
                                        @elseif($date->type == 'reopen')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Re-open Case') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(moduleStatusCheck('CustomField') and $date->customFields)

                                                        @foreach($date->customFields as $field)
                                                            <div class="single-meta">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="name mr-1">
                                                                        {{ $field->field->title }} :
                                                                    </div>
                                                                    <div class="value">
                                                                        {!!  $field->show_value !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>
                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])

                                                </div>
                                            </div>
                                        @elseif($date->type == 'judgement')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Judgement Case') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(moduleStatusCheck('CustomField') and $date->customFields)

                                                        @foreach($date->customFields as $field)
                                                            <div class="single-meta">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="name mr-1">
                                                                        {{ $field->field->title }} :
                                                                    </div>
                                                                    <div class="value">
                                                                        {!!  $field->show_value !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'judgement' ])

                                                </div>
                                            </div>

                                        @elseif($date->type == 'court_change')
                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ __('case.Court Change') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])

                                                </div>
                                            </div>

                                        @else

                                            <div class="student-meta-box mb-20">
                                                <div class="white-box student-details pt-2 pb-3">
                                                    <div class="single-meta">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="name mr-1">
                                                                <h3 class="mb-0">{{ formatDate($date->date) }} </h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="single-meta">
                                                        <div class="d-flex align-items-center">
                                                            <div class="name mr-1">
                                                                {{ __('case.Case Type') }} :
                                                            </div>
                                                            <div class="value">
                                                                {{ @$date->case_stage->name }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(moduleStatusCheck('CustomField') and $date->customFields)

                                                        @foreach($date->customFields as $field)
                                                            <div class="single-meta">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="name mr-1">
                                                                        {{ $field->field->title }} :
                                                                    </div>
                                                                    <div class="value">
                                                                        {!!  $field->show_value !!}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <div class="single-meta">
                                                        <div class="text-left">
                                                            {!!$date->description!!}
                                                        </div>
                                                    </div>

                                                    @includeIf('case.file_show', ['files' => $date->files, 'type' => 'date'])


                                                </div>
                                            </div>
                                        @endif


                                    @endforeach

                                    <div class="student-meta-box mb-20">
                                        <div class="white-box student-details pt-2 pb-3">
                                            <div class="single-meta">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="name mr-1">

                                                    </div>
                                                    <div class="value">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-meta">
                                                <div class="d-flex align-items-center">
                                                    <div class="name mr-1">
                                                        {{ __('case.Description') }} :
                                                    </div>
                                                    <div class="value">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-meta">
                                                <div class="text-left">
                                                    {!!$model->description!!}
                                                </div>
                                            </div>

                                            @includeIf('case.file_show', ['files' => $model->files, 'type' => 'case'])


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-25">
                    <div class="student-meta-box sticky-details">
                        <div class="white-box student-details pt-3">
                            <div class="single-meta">
                                <h3 class="mb-0">{{__('case.Details')}} </h3>
                            </div>
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Case No.') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->case_category? $model->case_category->name : '' }}
                                        - {{$model->case_no}}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Category') }}:
                                    </div>
                                    <div class="value">
                                        @if($model->case_category)

                                                {{$model->case_category? $model->case_category->name : '' }}

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.File No') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->file_no}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Reference') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->ref_name}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Reference Mobile') }}:
                                    </div>
                                    <div class="value">
                                        {{$model->ref_mobile}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Next Hearing Date') }}:
                                    </div>
                                    <div class="value">
                                        {{ formatDate($model->hearing_date) }}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Filing Date') }}:
                                    </div>
                                    <div class="value">
                                        {{formatDate($model->filling_date)}}
                                    </div>
                                </div>
                            </div>


                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Case Stage') }}:
                                    </div>
                                    <div class="value">
                                        {!!$model->case_stage ?  $model->case_stage->name  : ''!!}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta mt-10">
                                <h3 class="mb-30">{{__('case.Client')}} </h3>
                            </div>


                            @if($model->client == 'Plaintiff' and $model->plaintiff_client)
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Name') }}:
                                        </div>
                                        <div class="value">

                                                {{ $model->plaintiff_client->name }}

                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Mobile') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->mobile }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Email') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Address') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->address }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Location') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->plaintiff_client->state ? $model->plaintiff_client->state->name.',' : '' }}
                                            {{ $model->plaintiff_client->city ? $model->plaintiff_client->city->name : '' }}
                                        </div>
                                    </div>
                                </div>

                            @elseif($model->client == 'Opposite' and $model->opposite_client)

                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Name') }}:
                                        </div>
                                        <div class="value">

                                                {{ $model->opposite_client->name }}

                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Mobile') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->mobile }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Email') }}:
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Address') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->address }}
                                        </div>
                                    </div>
                                </div>
                                <div class="single-meta">
                                    <div class="d-flex justify-content-between">
                                        <div class="name">
                                            {{ __('case.Location') }}
                                        </div>
                                        <div class="value">
                                            {{ $model->opposite_client->district ? ', '. $model->opposite_client->district->name : '' }}
                                            {{ $model->opposite_client->division ? ', '. $model->opposite_client->division->name : '' }}
                                        </div>
                                    </div>
                                </div>

                            @endif


                            <div class="single-meta mt-10">
                                <h3 class="mb-30">{{__('case.Court')}} </h3>

                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Name') }}
                                    </div>
                                    <div class="value">

                                            {{ $model->court->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Category') }}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Room No') }}
                                    </div>
                                    <div class="value">
                                        {{ $model->court->room_number }}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Address') }}
                                    </div>
                                    <div class="value">
                                        {{ $model->court->location }}
                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        {{ __('case.Location') }}
                                    </div>
                                    <div class="value">
                                        {{ $model->court->state ? $model->court->state->name.',' : '' }}
                                        {{ $model->court->city ? $model->court->city->name : '' }}
                                    </div>
                                </div>
                            </div>

                            <div class="single-meta mt-10">
                                <h3 class="mb-30">{{__('case.Acts')}} </h3>
                            </div>

                            <div class="single-meta mt-10">
                                @if ($model->acts)
                                    @foreach ($model->acts as $act)
                                        {{$act->act ? $act->act->name .', ': ''}}
                                    @endforeach
                                @endif
                            </div>

                            <div class="single-meta mt-10">
                                <h3 class="mb-2">{{__('case.Opposite Lawyer')}} </h3>
                            </div>
                            @if ($model->lawyers)
                                @foreach ($model->lawyers as $lawyer)
                                    <div class="single-meta">
                                        <div class="d-flex justify-content-between">

                                            @if($lawyer->pivot->deleted_at)
                                                <del data-toggle="tooltip" title="{{ __('common.removed_at'). ' '.formatDate($lawyer->pivot->deleted_at) }}">
                                                    @endif
                                                    <div class="name" @if(!$lawyer->pivot->deleted_at) data-toggle="tooltip" title="{{ __('common.added_on'). ' '.formatDate($lawyer->pivot->created_at) }}" @endif>
                                                        <a href="{{ route('lawyer.show', $lawyer->id) }}"> {{$lawyer->name}} </a>
                                                    </div>

                                                    @if($lawyer->pivot->deleted_at)
                                                </del>
                                            @endif



                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if(moduleStatusCheck('CustomField') and $model->customFields)
                                <div class="single-meta mt-10">
                                    <h3 class="mb-10">{{__('custom_fields.more_info')}} </h3>
                                </div>
                                @foreach($model->customFields as $field)
                                    <div class="single-meta">
                                        <div class="d-flex justify-content-between">
                                            <div class="name">
                                                {{ $field->field->title }}
                                            </div>
                                            <div class="value">
                                                {!!  $field->show_value !!}

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="single-meta mt-10">

                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade animated file_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog"
         aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
    </div>


@stop
@push('admin.scripts')

@endpush
