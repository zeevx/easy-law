<?php

namespace App\Http\Controllers;

use App\Traits\CustomFields;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Contact;
use App\Jobs\AppointmentMailJob;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    use CustomFields;
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Appointment::all();
		return view('appointment.index', compact('models'));
    }


    public function create()
    {
        $contacts = Contact::all()->pluck('name', 'id')->prepend(__('appointment.Select Contact'), '');
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('appointment');
        }
        return view('appointment.create', compact('contacts', 'fields'));
    }


    public function store(Request $request) {
		if (!$request->json()) {
			abort(404);
		}
		$validate_rules = [
			'title' => 'required|max:191|string',
			'contact_id' => 'required|integer',
			'motive' => 'required',
			'date' => 'required',
			'notes' => 'sometimes|nullable|max:1500|string',
		];
        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('appointment'));
        }

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Appointment();
		$model->title = $request->title;
		$model->contact_id = $request->contact_id;
		$model->motive = $request->motive;
		$model->date = $request->date;
		$model->notes = $request->notes;
		$model->save();
        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'appointment');
        }

		if ($model->contact->email) {
			dispatch(new AppointmentMailJob($model->contact, $model));
		}

		$response = [
			'model' => $model,
			'goto' => route('appointment.index'),
			'message' => __('appointment.Appointment Added Successfully'),
		];

		return response()->json($response);
    }


    public function show($id) {
		$model = Appointment::findOrFail($id);
		return view('appointment.show', compact('model'));
    }

    public function edit($id) {
		$model = Appointment::findOrFail($id);
		$contacts = Contact::all()->pluck('name', 'id')->prepend(__('appointment.Select Contact'), '');
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('appointment');
        }
		return view('appointment.edit', compact('model', 'contacts', 'fields'));
    }


    public function update(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}

        $validate_rules = [
            'title' => 'required|max:191|string',
            'contact_id' => 'required|integer',
            'motive' => 'required',
            'date' => 'required',
            'notes' => 'sometimes|nullable|max:1500|string',
        ];

        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('appointment'));
        }

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = Appointment::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('appointment.Appointment Not Found')]);
		}

		$model->title = $request->title;
		$model->contact_id = $request->contact_id;
		$model->motive = $request->motive;
		$model->date = $request->date;
		$model->notes = $request->notes;
		$model->save();
        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'appointment');
        }
		$response = [
			'message' => __('appointment.Appointment Updated Successfully'),
			'goto' => route('appointment.index'),
		];

		return response()->json($response);
    }

    public function destroy(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}

		$model = Appointment::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('appointment.Appointment Not Found')]);
		}

        if (moduleStatusCheck('CustomField')){
            $model->load('customFields');
            $model->customFields()->delete();
        }

		$model->delete();

		return response()->json(['message' => __('appointment.Appointment Deleted Successfully'), 'goto' => route('appointment.index')]);
	}




}
