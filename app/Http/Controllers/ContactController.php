<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactCategory;
use App\Traits\CustomFields;
use Illuminate\Http\Request;
use App\Jobs\WelcomeMailJob;
use Illuminate\Validation\ValidationException;
use Modules\CustomField\Services\CustomFieldService;

class ContactController extends Controller {
    use CustomFields;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Contact::all();
		return view('contact.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$contact_categories = ContactCategory::all()->pluck('name', 'id')->prepend(__('contact.Select Contact Category'), '');
		$fields = null;

		if (moduleStatusCheck('CustomField')){
		    $fields = getFieldByType('contact');
        }
        $quick_add = request()->quick_add;
        if (request()->ajax() and $quick_add == 1){
            return view('contact.create_modal', compact('contact_categories', 'fields'));
        }

		return view('contact.create', compact('contact_categories', 'fields'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return void
	 * @throws ValidationException
	 */
	public function store(Request $request) {
		if (!$request->json()) {
			abort(404);
		}

        $validate_rules = [
            'name' => 'required|max:191|string',
            'mobile_no' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|email',
            'contact_category_id' => 'sometimes|nullable|integer',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('contact'));
        }


        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Contact();
		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->email = $request->email;
		$model->contact_category_id = $request->contact_category_id;
		$model->description = $request->description;
		$model->save();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'contact');
        }

		if($model->email){
            dispatch(new WelcomeMailJob(['name' => $model->name, 'email' => $model->email]));
        }

		$response = [
			'model' => $model,
			'message' => __('contact.Contact Added Successfully'),
		];

        if ($request->quick_add == 1){
            $response['appendTo'] = '#contact_id';
        } else{
            $response['goto'] = route('contact.index');
        }
		return response()->json($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show($id) {
		$model = Contact::findOrFail($id);
		return view('contact.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Contact::findOrFail($id);
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $model = Contact::with('customFields')->findOrFail($id);
            $fields = getFieldByType('contact');
        }
		$contact_categories = ContactCategory::all()->pluck('name', 'id')->prepend(__('contact.Select Contact Category'), '');
		return view('contact.edit', compact('model', 'contact_categories', 'fields'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 * @throws ValidationException
	 */
	public function update(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}

        $validate_rules = [
            'name' => 'required|max:191|string',
            'mobile_no' => 'sometimes|nullable|string',
            'email' => 'sometimes|nullable|email',
            'contact_category_id' => 'sometimes|nullable|integer',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('contact'));
        }

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = Contact::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('contact.Contact Not Found')]);
		}

		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->email = $request->email;
		$model->contact_category_id = $request->contact_category_id;
		$model->description = $request->description;
		$model->save();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'contact');
        }

		$response = [
			'message' => __('contact.Contact Updated Successfully'),
			'goto' => route('contact.index'),
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
	public function destroy(Request $request, $id) {
		if (!$request->json()) {
			abort(404);
		}

		$model = Contact::with('appointments')->find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('contact.Contact Not Found')]);
		}

        if ($model->appointments->count()) {
            throw ValidationException::withMessages(['message' => __('contact.Contact is assigned to appointments')]);
        }

        if (moduleStatusCheck('CustomField')){
            $model->load('customFields');
            $model->customFields()->delete();
        }

		$model->delete();

		return response()->json(['message' => __('contact.Contact Deleted Successfully'), 'goto' => route('contact.index')]);
	}
}
