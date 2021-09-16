<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use App\Traits\CustomFields;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LawyerController extends Controller {
use CustomFields;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Lawyer::all();
		return view('lawyer.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('opposite_lawyer');
        }

        $quick_add = request()->quick_add;
        if (request()->ajax() and $quick_add == 1){
            return view('lawyer.create_modal', compact('fields'));
        }

		return view('lawyer.create', compact('fields'));
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
            'mobile_no' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        if(moduleStatusCheck('EmailtoCL')){
            $validate_rules['email'] = 'sometimes|nullable|email|max:191';
        }
        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('opposite_lawyer'));
        }
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new Lawyer();
		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
        if(moduleStatusCheck('EmailtoCL')){
            $model->email = $request->email;
        }
		$model->description = $request->description;
		$model->save();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'opposite_lawyer');
        }

		$response = [
			'model' => $model,
			'message' => __('lawyer.Lawyer Added Successfully'),
		];

        if ($request->quick_add == 1){
            $response['appendTo'] = '#lawyer_id';
        } else{
            $response['goto'] = route('lawyer.index');
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
		$model = Lawyer::findOrFail($id);
		return view('lawyer.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Lawyer::findOrFail($id);
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('opposite_lawyer');
        }
		return view('lawyer.edit', compact('model', 'fields'));
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
            'mobile_no' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('opposite_lawyer'));
        }

        if(moduleStatusCheck('EmailtoCL')){
            $validate_rules['email'] = 'sometimes|nullable|email|max:191';
        }
        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = Lawyer::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('lawyer.Lawyer Not Found')]);
		}

		$model->name = $request->name;
		$model->mobile_no = $request->mobile_no;
		$model->description = $request->description;

        if(moduleStatusCheck('EmailtoCL')){
            $model->email = $request->email;
        }
		$model->save();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'opposite_lawyer');
        }

		$response = [
			'message' => __('lawyer.Lawyer Updated Successfully'),
			'goto' => route('lawyer.index'),
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

		$model = Lawyer::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('lawyer.Lawyer Not Found')]);
		}

        if (moduleStatusCheck('CustomField')){
            $model->load('customFields');
            $model->customFields()->delete();
        }

		$model->delete();

		return response()->json(['message' => __('lawyer.Lawyer Deleted Successfully'), 'goto' => route('lawyer.index')]);
	}
}
