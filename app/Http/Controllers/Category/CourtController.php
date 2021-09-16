<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\CourtCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CourtController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = CourtCategory::with('courts')->get();
		return view('category.court.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {

        $quick_add = request()->quick_add;
        if (request()->ajax() and $quick_add == 1){
            return view('category.court.create_modal');
        }
		return view('category.court.create');
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

		$model = new CourtCategory();
		$model->name = $request->name;
		$model->description = $request->description;
		$model->save();

		$response = [
			'model' => $model,
			'message' => __('court.Court Category Added Successfully'),
		];

        if ($request->quick_add == 1){
            $response['appendTo'] = '#court_category_id';
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
		$model = CourtCategory::findOrFail($id);
		return view('category.court.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = CourtCategory::findOrFail($id);
		return view('category.court.edit', compact('model'));
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

		$model = CourtCategory::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('court.Court Category Not Found')]);
		}

		$model->name = $request->name;
		$model->description = $request->description;
		$model->save();

		$response = [
			'message' => __('court.Court Category Updated Successfully'),
			'goto' => route('category.court.index'),
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

		$model = CourtCategory::with('courts')->find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('court.Court Category Not Found')]);
		}
		if ($model->courts->count()) {
			throw ValidationException::withMessages(['message' => __('court.Court Category Assign To Court.')]);
		}
		$model->delete();

		return response()->json(['message' => __('court.Court Category Deleted Successfully'), 'goto' => route('category.court.index')]);
	}
}
