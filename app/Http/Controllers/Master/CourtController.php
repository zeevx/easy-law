<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\CourtCategory;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Traits\CustomFields;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourtController extends Controller {

    use CustomFields;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$models = Court::all();
		return view('master.court.index', compact('models'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$countries = Country::all()->pluck('name', 'id')->prepend(__('Select country'), '');
		$states = State::where('country_id', config('configs')->where('key','country_id')->first()->value)->pluck('name', 'id')->prepend(__('court.Select state'), '');
		$court_categories = CourtCategory::all()->pluck('name', 'id')->prepend(__('court.Select Court Category'), '');
        $fields = null;

        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('court');
        }
        $quick_add = request()->quick_add;
        if (request()->ajax() and $quick_add == 1){
            $court_category_id = \request()->depend;
            return view('master.court.create_modal', compact('countries', 'court_categories','states', 'fields', 'court_category_id'));
        }
		return view('master.court.create', compact('countries', 'court_categories','states', 'fields'));
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
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'court_category_id' => 'sometimes|nullable|integer',
            'location' => 'sometimes|nullable|max:191|string',
            'name' => 'required|max:191|string',
            'room_number' => 'sometimes|nullable|max:15|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        if(moduleStatusCheck('EmailtoCL')){
            $validate_rules['email'] = 'sometimes|nullable|email|max:191';
        }

        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('court'));
        }

        $request->validate($validate_rules, validationMessage($validate_rules));

		if ($request->court_category_id) {
			$court_category = CourtCategory::where('id', $request->court_category_id)->first();
			if (!$court_category) {
				throw ValidationException::withMessages(['court_category_id' => __('Court Category Not Found')]);
			}
		}

		$model = new Court();
		$model->country_id = $request->country_id;
		$model->state_id = $request->state_id;
		$model->city_id = $request->city_id;
		$model->court_category_id = $request->court_category_id;
		$model->location = $request->location;
		$model->name = $request->name;
		$model->room_number = $request->room_number;
		$model->description = $request->description;
        if(moduleStatusCheck('EmailtoCL')){
            $model->email = $request->email;
        }
		$model->save();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'court');
        }

		$response = [
			'model' => $model,
			'message' => __('court.Court Added Successfully'),
		];

        if ($request->quick_add == 1){
            $response['appendTo'] = '#court_id';
        } else{
            $response['goto'] = route('master.court.index');
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
		$model = Court::findOrFail($id);
		return view('master.court.show', compact('model'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit($id) {
		$model = Court::findOrFail($id);
		$countries = Country::all()->pluck('name', 'id')->prepend(__('Select country'), '');
		$states = State::where('country_id', $model->country_id)->pluck('name', 'id')->prepend(__('Select state'), '');
		$cities =  City::where('state_id', $model->state_id)->pluck('name', 'id')->prepend(__('Select city'), '');
		$court_categories = CourtCategory::all()->pluck('name', 'id')->prepend(__('Select Court Category'), '');
        $fields = [];
        if (moduleStatusCheck('CustomField')){
            $fields = getFieldByType('court');
        }

		return view('master.court.edit', compact('model', 'countries', 'states', 'cities','court_categories', 'fields'));
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

		if (!$request->json()) {
			abort(404);
		}
        $validate_rules = [
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'court_category_id' => 'sometimes|nullable|integer',
            'location' => 'sometimes|nullable|max:191|string',
            'name' => 'required|max:191|string',
            'room_number' => 'sometimes|nullable|max:15|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        if(moduleStatusCheck('EmailtoCL')){
            $validate_rules['email'] = 'sometimes|nullable|email|max:191';
        }
        if (moduleStatusCheck('CustomField')){
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('court'));
        }
        $request->validate($validate_rules, validationMessage($validate_rules));


        if ($request->court_category_id) {
            $court_category = CourtCategory::where('id', $request->court_category_id)->first();
            if (!$court_category) {
                throw ValidationException::withMessages(['court_category_id' => __('Court Category Not Found')]);
            }
        }

		$model = Court::find($id);
		if (!$model) {
			throw ValidationException::withMessages(['message' => __('Court Not Found')]);
		}

		$model->country_id = $request->country_id;
		$model->state_id = $request->state_id;
		$model->city_id = $request->city_id;
		$model->court_category_id = $request->court_category_id;
		$model->location = $request->location;
		$model->name = $request->name;
		$model->room_number = $request->room_number;
		$model->description = $request->description;
        if(moduleStatusCheck('EmailtoCL')){
            $model->email = $request->email;
        }
		$model->save();

        if (moduleStatusCheck('CustomField')){
            $this->storeFields($model, $request->custom_field, 'court');
        }

		$response = [
			'message' => __('court.Court Updated Successfully'),
			'goto' => route('master.court.index'),
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

		$model = Court::with('cases')->find($id);

		if (!$model) {
			throw ValidationException::withMessages(['message' => __('court.Court Not Found')]);
		}

		if ($model->cases()->count()) {
			throw ValidationException::withMessages(['message' => __('court.Court is assign to case')]);
		}

        if (moduleStatusCheck('CustomField')){
            $model->load('customFields');
            $model->customFields()->delete();
        }

		$model->delete();

		return response()->json(['message' => __('Court Deleted Successfully'), 'goto' => route('master.court.index')]);
	}
}
