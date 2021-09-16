<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\CaseAct;
use App\Models\CaseCategory;
use App\Models\CaseCategoryLog;
use App\Models\CaseCourt;
use App\Models\Cases;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Court;
use App\Models\CourtCategory;
use App\Models\HearingDate;
use App\Models\Lawyer;
use App\Models\Stage;
use App\Traits\CustomFields;
use App\Traits\ImageStore;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Brian2694\Toastr\Facades\Toastr;
use Modules\EmailtoCL\Jobs\SendMailToLawyerJob;

class CaseController extends Controller
{
    use ImageStore, CustomFields;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $models = Cases::all();
        $page_title = 'All';
        if ($request->status and $request->status == 'Archieved') {
            $models = Cases::where('judgement_status', 'Judgement')->get();
            $page_title = 'Archieved';
        } else if ($request->status and $request->status == 'Waiting') {
            $models = Cases::where('status', 'Open')->where('hearing_date', '<', date('Y-m-d'))->get();
            $page_title = 'Waiting';
        } else if ($request->status and $request->status == 'Running') {
            $models = Cases::where('status', 'Open')->orWhereIn('judgement_status', ['Open', 'Reopen'])->get();
            $page_title = 'Running';
        }

        return view('case.index', compact('models', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['clients'] = Client::all()->pluck('name', 'id');
        $data['client_categories'] = ClientCategory::all()->pluck('name', 'id')->prepend(__('case.Select Client Category'), '');
        $data['stages'] = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');
        $data['case_categories'] = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Categories'), '');
        $data['court_categories'] = CourtCategory::all()->pluck('name', 'id')->prepend(__('case.Select Court Categories'), '');
        $data['lawyers'] = Lawyer::all()->pluck('name', 'id');
        $data['acts'] = Act::all()->pluck('name', 'id');
        $data['courts'] = ['' => __('case.Select Court')];

        $fields = null;

        if (moduleStatusCheck('CustomField')) {
            $fields = getFieldByType('case');
        }

        return view('case.create', compact('data', 'fields'));
    }


    public function store(Request $request)
    {
        if (!$request->json()) {
            abort(404);
        }


        $validate_rules = [
            'case_category_id' => 'required|integer',
            'case_no' => 'sometimes|nullable|string',
            'file_no' => 'sometimes|nullable|string|max:20',
            'acts*' => 'required|integer',
            'plaintiff' => 'required|integer',
            'opposite' => 'required|integer',
            'client_category_id' => 'required|integer',
            'court_category_id' => 'required|integer',
            'court_id' => 'required|integer',
            'lawyer_id*' => 'sometimes|nullable|integer',
            'stage_id' => 'sometimes|nullable|integer',
            'case_charge' => 'sometimes|nullable|numeric',
            'receiving_date' => 'sometimes|nullable|date',
            'filling_date' => 'sometimes|nullable|date',
            'hearing_date' => 'sometimes|nullable|date',
            'judgement_date' => 'sometimes|nullable|date',
            'description' => 'sometimes|nullable|string',
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ];

        if (moduleStatusCheck('CustomField')) {
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('case'));
        }

        $request->validate($validate_rules, validationMessage($validate_rules));
        $judgement_date = Null;
        if ($request->judgement_date_yes) {

            $judgement_date = date_format(date_create($request->judgement_date), 'Y-m-d H:i:s');
            $judgement = $request->judgement;

            if (!$judgement) {
                throw ValidationException::withMessages(['judgement' => __('case.Judgment field is required ')]);
            }
        }
        if ($request->plaintiff == $request->opposite) {
            throw ValidationException::withMessages(['plaintiff' => __('case.Plaintiff can not be opposite')]);
        }

        try {

            $hearing_date = Null;
            $filling_date = Null;

            $receiving_date = Null;
            $judgement = Null;

            if ($request->hearing_date_yes) {
                $hearing_date = date_format(date_create($request->hearing_date), 'Y-m-d H:i:s');
            }
            if ($request->filling_date_yes) {
                $filling_date = date_format(date_create($request->filling_date), 'Y-m-d H:i:s');
            }

            if ($request->receiving_date_yes) {
                $receiving_date = date_format(date_create($request->receiving_date), 'Y-m-d H:i:s');
            }


            $plaintiff = Client::find($request->plaintiff);
            $opposite = Client::find($request->opposite);
            $title = $plaintiff->name . ' v/s ' . $opposite->name;
            $client_category = ClientCategory::find($request->client_category_id);
            $client = $client_category->plaintiff ? 'Plaintiff' : 'Opposite';
            $model = new Cases();
            $model->title = $title;
            $model->client = $client;
            if($request->judgement_date_yes){
                $model->judgement_status = 'Judgement';
                $model->status = 'Judgement';
                $model->judgement_date = $judgement_date;
                $model->judgement = $judgement;
            } else{
                $model->status = 'Open';
            }

            $model->case_category_id = $request->case_category_id;
            $model->case_no = $request->case_no;
            $model->file_no = $request->file_no;
            $model->plaintiff = $request->plaintiff;
            $model->case_charge = $request->case_charge;
            $model->opposite = $request->opposite;
            $model->client_category_id = $request->client_category_id;
            $model->court_category_id = $request->court_category_id;
            $model->court_id = $request->court_id;
            $model->ref_name = $request->ref_name;
            $model->ref_mobile = $request->ref_mobile;
            $model->stage_id = $request->stage_id;
            $model->receiving_date = $receiving_date;
            $model->filling_date = $filling_date;
            $model->hearing_date = $hearing_date;
            $model->description = $request->description;
            $model->save();

            if (moduleStatusCheck('CustomField')) {
                $this->storeFields($model, $request->custom_field, 'case');
            }

            if (!$request->file_no) {
                $file_no = str_pad($model->id, 4, '0', STR_PAD_LEFT);
                $model->file_no = $file_no;
                $model->save();
            }

            if ($request->acts and count($request->acts) > 0) {
                foreach ($request->acts as $value) {
                    $act = new CaseAct();
                    $act->acts_id = $value;
                    $act->cases_id = $model->id;
                    $act->save();
                }
            }

            if ($request->lawyer_id and count($request->lawyer_id) > 0) {
                foreach ($request->lawyer_id as $lawyer) {
                    $lawyer = Lawyer::find($lawyer);
                    if ($lawyer) {
                        DB::table('cases_lawyer')
                            ->insert([
                                'cases_id' => $model->id,
                                'lawyer_id' => $lawyer->id,
                                'created_at' => Carbon::now(),
                            ]);

                        if ($lawyer->email and $request->send_email_to_lawyer and moduleStatusCheck('EmailtoCL')) {
                            dispatch(new SendMailToLawyerJob($lawyer, $model));
                        }
                    }

                }
            }

            if ($request->hearing_date_yes) {
                $date = new HearingDate();
                $date->cases_id = $model->id;
                $date->stage_id = $request->stage_id;
                $date->date = $hearing_date;
                $date->description = $request->description;
                $date->save();
            }

            if ($request->judgement_date_yes) {
                $date = new HearingDate();
                $date->cases_id = $model->id;
                $date->date = $judgement_date;
                $date->description = $judgement;
                $date->type = 'judgement';
                $date->save();
            }

            if ($request->file) {
                foreach ($request->file as $file) {
                    $this->storeFile($file, $model->id);
                }
            }

            $response = [
                'goto' => route('case.show', $model->id),
                'model' => $model,
                'message' => __('case.Case Added Successfully'),
            ];

            return response()->json($response);

        } catch (Exception $e) {
            throw ValidationException::withMessages(['message' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $model = Cases::with('acts', 'hearing_dates');
        if (moduleStatusCheck('Finance')) {
            $model->with('transactions', 'invoices');
        }

        $model = $model->findOrFail($id);

        if (request()->print) {
            return view('case.print', compact('model'));
        }
        return view('case.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $model = Cases::with('acts')->findOrFail($id);
        $data['clients'] = Client::all()->pluck('name', 'id');
        $data['client_categories'] = ClientCategory::all()->pluck('name', 'id')->prepend(__('case.Select Client Category'), '');
        $data['stages'] = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');
        $data['case_categories'] = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Categories'), '');
        $data['court_categories'] = CourtCategory::all()->pluck('name', 'id')->prepend(__('case.Select Court Categories'), '');
        $data['lawyers'] = Lawyer::all()->pluck('name', 'id')->prepend(__('case.Select Lawyer'), '');
        $data['courts'] = Court::where('court_category_id', $model->court_category_id)->pluck('name', 'id')->prepend(__('case.Select Court'), '');
        $data['acts'] = Act::all()->pluck('name', 'id');
        $data['selected_acts'] = $model->acts()->pluck('acts_id');

        $fields = null;

        if (moduleStatusCheck('CustomField')) {
            $fields = getFieldByType('case');
        }

        return view('case.edit', compact('model', 'data', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        if (!$request->json()) {
            abort(404);
        }
        $validate_rules = [
            'case_category_id' => 'required|integer',
            'case_no' => 'sometimes|nullable|string',
            'file_no' => 'sometimes|nullable|string|max:20',
            'acts*' => 'required|integer',
            'plaintiff' => 'required|integer',
            'opposite' => 'required|integer',
            'client_category_id' => 'required|integer',
            'court_category_id' => 'required|integer',
            'court_id' => 'required|integer',
            'stage_id' => 'sometimes|nullable|integer',
            'case_charge' => 'sometimes|nullable|numeric',
            'receiving_date' => 'sometimes|nullable|date',
            'filling_date' => 'sometimes|nullable|date',
            'hearing_date' => 'sometimes|nullable|date',
            'judgement_date' => 'sometimes|nullable|date',
            'description' => 'sometimes|nullable|string',
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ];

        if (moduleStatusCheck('CustomField')) {
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('case'));
        }
        $request->validate($validate_rules, validationMessage($validate_rules));

        $filling_date = Null;
        $receiving_date = Null;


        if ($request->filling_date_yes) {
            $filling_date = date_format(date_create($request->filling_date), 'Y-m-d H:i:s');
        }

        if ($request->plaintiff == $request->opposite) {
            Toastr::error(__('case.Plaintiff can not be opposite'));
            throw ValidationException::withMessages(['plaintiff' => __('case.Plaintiff can not be opposite')]);
        }
        if ($request->receiving_date_yes) {
            $receiving_date = date_format(date_create($request->receiving_date), 'Y-m-d H:i:s');
        }


        $model = Cases::findOrFail($id);
        $plaintiff = Client::find($request->plaintiff);
        $opposite = Client::find($request->opposite);
        $title = $plaintiff->name . ' v/s ' . $opposite->name;
        $client_category = ClientCategory::find($request->client_category_id);
        $client = $client_category->plaintiff ? 'Plaintiff' : 'Opposite';

        $model->title = $title;
        $model->client = $client;
        $model->case_category_id = $request->case_category_id;
        $model->case_no = $request->case_no;
        $model->file_no = $request->file_no;
        $model->plaintiff = $request->plaintiff;
        $model->case_charge = $request->case_charge;
        $model->opposite = $request->opposite;
        $model->client_category_id = $request->client_category_id;
        $model->court_category_id = $request->court_category_id;
        $model->court_id = $request->court_id;
        $model->ref_name = $request->ref_name;
        $model->ref_mobile = $request->ref_mobile;
        $model->stage_id = $request->stage_id;
        $model->receiving_date = $receiving_date;
        $model->filling_date = $filling_date;
        $model->description = $request->description;
        $model->save();

        if (moduleStatusCheck('CustomField')) {
            $this->storeFields($model, $request->custom_field, 'case');
        }

        if ($request->acts and count($request->acts) > 0) {
            CaseAct::where('cases_id', $model->id)->delete();
            foreach ($request->acts as $value) {
                $act = new CaseAct();
                $act->acts_id = $value;
                $act->cases_id = $model->id;
                $act->save();
            }
        }

        $response = [
            'message' => __('case.Case Updated Successfully'),
            'goto' => route('case.show', $model->id),
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->json()) {
            abort(404);
        }

        $model = Cases::with('tasks')->find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('case.Case Not Found')]);
        }

        if ($model->tasks->count()) {
            throw ValidationException::withMessages(['message' => __('case.Case is assigned with tasks')]);
        }

        if (moduleStatusCheck('CustomField')) {
            $model->load('invoices');
            if ($model->invoices->count()) {
                throw ValidationException::withMessages(['message' => __('case.Case is assigned with invoices')]);
            }
        }

        if (moduleStatusCheck('CustomField')) {
            $model->load('customFields');
            $model->customFields()->delete();
        }


        $model->delete();

        return response()->json(['message' => __('case.Case Deleted Successfully'), 'goto' => route('case.index')]);
    }

    public function causelist(Request $request)
    {
        $data['models'] =  Cases::where(['status' => 'Open'])->orWhereIn('judgement_status', ['Open', 'Reopen']);
        if ($request->start_date) {
            $data['start_date'] = getFormatedDate($request->start_date, true);
            $data['models'] = $data['models']->whereDate('hearing_date', '>=', $data['start_date']);
        }


        if ($request->end_date) {
            $data['end_date'] = getFormatedDate($request->end_date, true);
            $data['models'] = $data['models']->whereDate('hearing_date', '<=', $data['end_date']);
        }


        $data['models'] = $data['models']->get();


        if ($request->ajax()) {
            return view('case.causelist_data', $data);
        }


        return view('case.causelist', $data);
    }


    public function category_change($id)
    {
        $model = Cases::FindOrFail($id);
        $category = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Category'), '');
        return view('case.category-change', compact('model', 'category'));
    }

    public function category_store(Request $request)
    {
        $model = Cases::FindOrFail($request->id);
        $category = CaseCategory::FindOrFail($model->case_category_id);
        $old_category = $category->name;
        $n_category = CaseCategory::FindOrFail($request->category);
        $new_category = $n_category->name;
        $model->case_category_id = $request->category;
        $model->save();

        $user = new CaseCategoryLog();
        $user->date = $request->date;
        $user->case_id = $request->id;
        $user->category_id = $request->category;
        $user->save();

        $description = 'Court Category Change: Form (' . $old_category . ") To (" . $new_category . ")";
        $date = new HearingDate();
        $date->cases_id = $model->id;
        $date->date = $request->date;
        $date->description = $description;
        $date->type = 'court_category_change';
        $date->save();

        $response = [
            'goto' => route('case.show', $model->id),
            'message' => __('case.Case Category Updated'),
        ];

        return response()->json($response);
    }


    public function court_change($id)
    {
        $model = Cases::FindOrFail($id);
        $court = Court::all()->pluck('name', 'id')->prepend(__('case.Select Court'), '');
        return view('case.court-change', compact('model', 'court'));
    }

    public function court_store(Request $request)
    {
        $this->validate($request, [
            'file.*' => 'sometimes|nullable|mimes:jpg,bmp,png,doc,docx,pdf,jpeg,txt',
        ]);

        $model = Cases::FindOrFail($request->id);
        $court = Court::FindOrFail($model->court_id);
        $old_court = $court->name;
        $n_court = Court::FindOrFail($request->court);
        $court_category_id = $n_court->court_category_id;
        $new_court = $n_court->name;
        $model->court_id = $request->court;
        $model->court_category_id = $court_category_id;
        $model->save();

        $user = new CaseCourt();
        $user->date = $request->date;
        $user->case_id = $request->id;
        $user->court_id = $request->court;
        $user->save();

        $description = 'Court Change: Form (' . $old_court . ") To (" . $new_court . ")";
        $date = new HearingDate();
        $date->cases_id = $model->id;
        $date->type = 'court_change';
        $date->date = $request->date;
        $date->description = $description;
        $date->type = 'court_change';
        $date->save();

        if ($request->file) {
            foreach ($request->file as $file) {
                $this->storeFile($file, $model->cases_id, $date->id);
            }
        }

        $response = [
            'goto' => route('case.show', $model->id),
            'message' => __('case.Case Court Updated'),
        ];

        return response()->json($response);
    }

    public function remove_lawyer($case_id, $lawyer_id)
    {
        $case = Cases::find($case_id);
        if ($case) {
            DB::table('cases_lawyer')
                ->where('cases_id', $case_id)
                ->where('lawyer_id', $lawyer_id)
                ->update(array('deleted_at' => DB::raw('NOW()')));
        }

        $response = [
            'goto' => route('case.show', $case_id),
            'message' => __('case.Lawyer removed from case.'),
        ];

        return response()->json($response);
    }

    public function add_lawyer($case_id)
    {
        $data['case'] = Cases::with('lawyers')->find($case_id);
        $previous_lawyer_ids = $data['case']->lawyers()->whereNull('deleted_at')->pluck('lawyer_id');

        $data['lawyers'] = Lawyer::whereNotIn('id', $previous_lawyer_ids)->pluck('name', 'id');
        return view('case.add_lawyer', $data);
    }

    public function post_lawyer(Request $request, $case_id)
    {
        $case = Cases::with('lawyers')->find($case_id);
        if ($case) {
            $sync = [];
            foreach ($request->lawyer_id as $lawyer) {
                DB::table('cases_lawyer')
                    ->insert([
                        'cases_id' => $case_id,
                        'lawyer_id' => $lawyer,
                        'created_at' => $request->date,
                    ]);
            }
        }
        $response = [
            'goto' => route('case.show', $case_id),
            'message' => __('case.Lawyer added to case.'),
        ];

        return response()->json($response);

    }

    public function filter(Request $request)
    {
        $data = [];
        $data['models'] = Cases::query();
        $data['clients'] = Client::all()->pluck('name', 'id');
        $data['client_id'] = $request->client_id;
        $data['stages'] = Stage::all()->pluck('name', 'id')->prepend(__('case.Select Case Stage'), '');
        $data['stage_id'] = $request->stage_id;
        $data['case_categories'] = CaseCategory::all()->pluck('name', 'id')->prepend(__('case.Select Case Categories'), '');
        $data['case_category_id'] = $request->case_category_id;
        $data['hearing_date'] = $request->hearing_date;
        $data['courts'] = Court::all()->pluck('name', 'id')->prepend(__('case.Select Court'), '');
        $data['court_id'] = $request->court_id;
        $data['judgement_status'] = $request->judgement_status;
        $data['status'] = $request->status;
        $data['filling_date'] = $request->filling_date;
        $data['receiving_date'] = $request->receiving_date;
        $data['judgement_date'] = $request->judgement_date;
        $data['case_no'] = $request->case_no;
        $data['file_no'] = $request->file_no;
        $data['db_acts'] = Act::all()->pluck('name', 'id');
        $data['acts'] = $request->acts;

        if ($request->client_id) {
            $data['models']->where(function ($q) use ($request) {
                return $q->where('plaintiff', $request->client_id)->orWhere('opposite', $request->client_id);
            });
        }

        if ($request->acts) {
            $data['models']->whereHas('acts', function ($q) use ($request) {
                return $q->whereIn('acts_id', $request->acts);
            });
        }

        if ($request->stage_id) {
            $data['models']->where('stage_id', $request->stage_id);
        }

        if ($request->case_no) {
            $data['models']->where('case_no', 'like', '%' . $request->case_no . '%');
        }

        if ($request->file_no) {
            $data['models']->where('file_no', 'like', '%' . $request->file_no . '%');
        }

        if ($request->case_category_id) {
            $data['models']->where('case_category_id', $request->case_category_id);
        }

        if ($request->hearing_date) {
            $data['models']->whereDate('hearing_date', $request->hearing_date);
        }
        if ($request->filling_date) {
            $data['models']->whereDate('filling_date', $request->filling_date);
        }
        if ($request->judgement_date) {
            $data['models']->whereDate('judgement_date', $request->judgement_date);
        }
        if ($request->receiving_date) {
            $data['models']->whereDate('receiving_date', $request->receiving_date);
        }
        if ($request->court_id) {
            $data['models']->where(['court_id' => $request->court_id]);
        }

        if ($request->status) {
            $data['models']->where(['status' => $request->status]);
        }
        if ($request->judgement_status) {
            $data['models']->where(['judgement_status' => $request->judgement_status]);
        }

        $data['models'] = $data['models']->orderBy('hearing_date', 'asc')->get();


        return view('case.filter', $data);
    }
}
