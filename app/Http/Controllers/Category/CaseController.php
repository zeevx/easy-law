<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\CaseCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CaseController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = CaseCategory::all();
		return view('category.case.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
        $quick_add = request()->quick_add;
        if (request()->ajax() and $quick_add == 1){
            return view('category.case.create_modal');
        }
		return view('category.case.create');
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
			'description' => 'sometimes|nullable|max:1500|string',
		];

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = new CaseCategory();
		$model->name = $request->name;
		$model->description = $request->description;
		$model->save();

		$response = [
			'model' => $model,
			'message' => __('case.Case Category Added Successfully'),
		];

        if ($request->quick_add == 1){
            $response['appendTo'] = '#case_category_id';
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
		$model = CaseCategory::findOrFail($id);
		return view('category.case.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = CaseCategory::findOrFail($id);
		return view('category.case.edit', compact('model'));
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
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        $request->validate($validate_rules, validationMessage($validate_rules));

		$model = CaseCategory::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('case.Case Category Not Found')]);
		}

		$model->name = $request->name;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('case.Case Category Updated Successfully'),
			'goto' => route('category.case.index'),
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

		$model = CaseCategory::with('cases')->find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('case.Case Category Not Found')]);
		}

        if ($model->cases->count()) {
            throw ValidationException::withMessages(['message' => __('case.Case Category is assign to cases.')]);
        }

		//Check Case

		$model->delete();

		return response()->json(['message' => __('case.Case Category Deleted Successfully'), 'goto' => route('category.case.index')]);
	}
}
