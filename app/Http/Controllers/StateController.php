<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StateController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $country_id = request()->country_id;
        if (!$country_id){
            $country_id = config('configs')->where('key','country_id')->first()->value;
        }
        $models = State::where('country_id', $country_id)->get();
        $countries = Country::all()->pluck('name', 'id')->prepend(__('setting.Select Country'), '');
        return view('state.index', compact('models', 'countries', 'country_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $country_id = request()->country_id;
        if (!$country_id){
            $country_id = config('configs')->where('key','country_id')->first()->value;
        }
        $countries = Country::all()->pluck('name', 'id')->prepend(__('setting.Select Country'), '');
        return view('state.create', compact('countries', 'country_id'));
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
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'name' => 'required|max:191|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        $model = new State();
        $model->name = $request->name;
        $model->country_id = $request->country_id;
        $model->save();

        $response = [
            'model' => $model,
            'message' => __('setting.State Added Successfully'),
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $model = State::findOrFail($id);
        return view('state.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $model = State::findOrFail($id);
        $countries = Country::all()->pluck('name', 'id')->prepend(__('setting.Select Country'), '');
        return view('state.edit', compact('model', 'countries'));
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
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'name' => 'required|max:191|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));


        $model = State::find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('setting.State Not Found')]);
        }

        $model->name = $request->name;
        $model->country_id = $request->country_id;
        $model->save();

        $response = [
            'message' => __('setting.State Updated Successfully'),
            'goto' => route('setup.state.index', ['country_id' => $model->country_id]),
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

        $model = State::with('cities', 'courts', 'clients')->find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('setting.State Not Found')]);
        }

        if ($model->cities->count()) {
            throw ValidationException::withMessages(['message' => __('setting.State Has Cities. For delete state, first delete city')]);
        }

        if ($model->courts->count()) {
            throw ValidationException::withMessages(['message' => __('setting.State is assigned with courts')]);
        }

        if ($model->clients->count()) {
            throw ValidationException::withMessages(['message' => __('setting.State is assigned with clients')]);
        }

        $model->delete();

        return response()->json(['message' => __('setting.State Deleted Successfully'), 'goto' => route('setup.state.index')]);
    }
}
