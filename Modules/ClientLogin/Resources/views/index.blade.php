@extends('backEnd.master')


@section('mainContent')
    <div class="container-fluid p-0">


        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h3 class="mb-0">{{__('dashboard.Quick Summery')}} </h3>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-4 col-md-6">
                <a href="{{route('client.my_cases')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Running Cases')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Running Cases')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Cases::where(function($q){
            return $q->where('status', 'Open')->orWhereIn('judgement_status',['Open','Reopen']);
        })->where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="{{route('client.my_waiting_cases')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Waiting Cases')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Waiting Cases')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Cases::where(function($q){
            return $q->where('status', 'Open')->orWhereIn('judgement_status',['Open','Reopen']);
        })->where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->where('hearing_date', '>', date('Y-m-d'))->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="{{route('client.my_closed_cases')}}" class="d-block">
                    <div class="white-box single-summery">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>{{__('dashboard.Closed Cases')}}</h3>
                                <p class="mb-0">{{__('dashboard.Total Closed Cases')}}</p>
                            </div>
                            <h1 class="gradient-color2">{{App\Models\Cases::where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->where('judgement_status', 'Close')->count()}}
                            </h1>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="row mt-40">


            <div class="col-lg-12 col-md-12">

                <div class="white_box_30px mb_30">
                    <div class="box_header common_table_header ">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{__('dashboard.Upcomming Date')}}</h3>
                        </div>
                    </div>


                    <div class="QA_section3 QA_section_heading_custom th_padding_l0 ">
                        <div class="QA_table">
                            <!-- table-responsive -->
                            <div class="table-responsive">
                                <table class="table pt-0 shadow_none pb-0 ">
                                    <tbody>
                                    <tr>
                                        <th>{{__('dashboard.Case Name')}}</th>
                                        <th>{{__('dashboard.Date')}}</th>
                                    </tr>
                                    @forelse($upcommingdate as $date)
                                        <tr>
                                            <td><a href="{{ route('client.case.show', $date->id) }}">{{ $date->title }}</a>
                                            </td>
                                            <td>{{ formatDate($date->date) }}</td>
                                        </tr>
                                        @empty
                                        <tr class="text-center">
                                            <td colspan="2">{{ __('common.no_case_found') }}</a></td>

                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
