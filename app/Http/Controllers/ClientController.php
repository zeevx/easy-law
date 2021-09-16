<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Traits\CustomFields;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    use CustomFields;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $models = Client::all();
        return view('client.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $countries = Country::all()->pluck('name', 'id')->prepend(__('client.Select country'), '');
        $states = State::where('country_id', config('configs')->where('key', 'country_id')->first()->value)->pluck('name', 'id')->prepend(__('client.Select state'), '');
        $client_categories = ClientCategory::all()->pluck('name', 'id')->prepend(__('client.Select Client Category'), '');
        $fields = null;

        if (moduleStatusCheck('CustomField')) {
            $fields = getFieldByType('client');
        }

        $enable_login = false;
        if (moduleStatusCheck('ClientLogin')) {
            $config = config('configs')->where('key', 'client_login')->first();
            $enable_login = $config ? $config->value : false;
        }

        $quick_add = request()->quick_add;
        $plaintiff = request()->plaintiff;
        if (request()->ajax() and $quick_add == 1){
            return view('client.create_modal', compact('countries', 'client_categories', 'states', 'fields', 'enable_login', 'plaintiff'));
        }

        return view('client.create', compact('countries', 'client_categories', 'states', 'fields', 'enable_login'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (!$request->json()) {
            abort(404);
        }
        $validate_rules = [
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'client_category_id' => 'sometimes|nullable|integer',

            'mobile' => 'sometimes|nullable|string|max:191',
            'gender' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'address' => 'sometimes|nullable|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];
        if (moduleStatusCheck('CustomField')) {
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('client'));
        }
        $enable_login = false;
        if (moduleStatusCheck('ClientLogin')) {
            $config = config('configs')->where('key', 'client_login')->first();
            $enable_login = $config && $config->value;
        }
        if ($enable_login) {
            $validate_rules = array_merge($validate_rules, [
                'email' => 'required|email|max:191|unique:users',
                'password' => 'required|string|min:8',
            ]);
        } else {
            $validate_rules = array_merge($validate_rules, [
                'email' => 'sometimes|nullable|email|max:191',
            ]);
        }

        $request->validate($validate_rules, validationMessage($validate_rules));

        $model = new Client();
        $model->country_id = $request->country_id;
        $model->state_id = $request->state_id;
        $model->city_id = $request->city_id;
        $model->client_category_id = $request->client_category_id;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->gender = $request->gender;
        $model->mobile = $request->mobile;
        $model->address = $request->address;
        $model->description = $request->description;
        $model->save();

        if (moduleStatusCheck('CustomField')) {
            $this->storeFields($model, $request->custom_field, 'client');
        }


        if ($enable_login) {
            $user = new User();
            $user->name = $model->name;
            $user->email = $model->email;
            $user->password = bcrypt($request->password);
//            $user->role_id = 4;

            $user->save();

            $model->user_id = $user->id;
            $model->save();
        }

        $response = [
            'model' => $model,
            'message' => __('client.Client Added Successfully'),
        ];

        if ($request->quick_add == 1){
            $plaintiff = $request->plaintiff;
            if ($plaintiff){
                $response['appendTo'] = '#plaintiff';
            } else{
                $response['appendTo'] = '#opposite';
            }

        } else{
            $response['goto'] = route('client.index');
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $model = Client::query();
        if (moduleStatusCheck('Finance')){
            $model->with('invoices', 'transactions');
        }

        $model = $model->findOrFail($id);
        return view('client.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $model = Client::with('user')->findOrFail($id);
        $countries = Country::all()->pluck('name', 'id')->prepend(__('client.Select country'), '');
        $states = State::where('country_id', $model->country_id)->pluck('name', 'id')->prepend(__('client.Select state'), '');
        $cities = City::where('state_id', $model->state_id)->pluck('name', 'id')->prepend(__('client.Select city'), '');
        $client_categories = ClientCategory::all()->pluck('name', 'id')->prepend(__('client.Select Client Category'), '');
        $fields = null;

        if (moduleStatusCheck('CustomField')) {
            $fields = getFieldByType('client');
        }

        $enable_login = false;
        if (moduleStatusCheck('ClientLogin')) {
            $config = config('configs')->where('key', 'client_login')->first();
            $enable_login = $config ? $config->value : false;
        }

        return view('client.edit', compact('model', 'countries', 'states', 'cities', 'client_categories', 'fields', 'enable_login'));
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
        $model = Client::find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('client.Client Not Found')]);
        }
        $validate_rules = [
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'client_category_id' => 'sometimes|nullable|integer',
            'email' => 'sometimes|nullable|email|max:191',
            'mobile' => 'sometimes|nullable|string|max:191',
            'gender' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'address' => 'sometimes|nullable|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
        ];

        if (moduleStatusCheck('CustomField')) {
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('client'));
        }

        $enable_login = false;
        if (moduleStatusCheck('ClientLogin')) {
            $config = config('configs')->where('key', 'client_login')->first();
            $enable_login = $config && $config->value;
        }
        if ($enable_login) {
            $validate_rules = array_merge($validate_rules, [
                'email' => 'required|email|max:191|unique:users,email,' .( $model->user ? $model->user->id : '')
            ]);
            if (!$model->user) {
                $validate_rules = array_merge($validate_rules, [
                    'password' => 'required|string|min:8',
                ]);
            } else {
                $validate_rules = array_merge($validate_rules, [
                    'password' => 'sometimes|nullable|string|min:8',
                ]);
            }
        } else {
            $validate_rules = array_merge($validate_rules, [
                'email' => 'sometimes|nullable|email|max:191',
            ]);
        }
        $request->validate($validate_rules, validationMessage($validate_rules));

        $model->country_id = $request->country_id;
        $model->state_id = $request->state_id;
        $model->city_id = $request->city_id;
        $model->client_category_id = $request->client_category_id;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->gender = $request->gender;
        $model->mobile = $request->mobile;
        $model->address = $request->address;
        $model->description = $request->description;
        $model->save();
        if (moduleStatusCheck('CustomField')) {
            $this->storeFields($model, $request->custom_field, 'client');
        }

        if ($enable_login) {
            $user = User::find($model->user_id);
            if (!$user) {
                $user = new User();
            }
            $user->name = $model->name;
            $user->email = $model->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            $model->user_id = $user->id;
            $model->save();
        }

        $response = [
            'message' => __('client.Client Updated Successfully'),
            'goto' => route('client.index'),
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

        $model = Client::with('plaintiffs', 'opposites')->find($id);

        if (!$model) {
            throw ValidationException::withMessages(['message' => __('client.Client Not Found')]);
        }

        if ($model->opposites()->count() or $model->plaintiffs()->count()){
            throw ValidationException::withMessages(['message' => __('client.Client is assign to cases.')]);
        }

        if (moduleStatusCheck('Finance')) {
            $model->load('invoices');
            if ($model->invoices()->count()){
                throw ValidationException::withMessages(['message' => __('client.Client has invoices.')]);
            }
        }

        if (moduleStatusCheck('CustomField')) {
            $model->load('customFields');
            $model->customFields()->delete();
        }


        $model->delete();

        return response()->json(['message' => __('client.Client Deleted Successfully'), 'goto' => route('client.index')]);
    }
}
