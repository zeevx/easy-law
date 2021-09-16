<?php

namespace Modules\ClientLogin\Http\Controllers;

use App\Models\Cases;
use App\Models\City;
use App\Models\Client;
use App\Models\Country;
use App\Models\State;
use App\Traits\CustomFields;
use App\Traits\ImageStore;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    use CustomFields, ImageStore;
    public function my_dashboard()
    {
        $data = [
            'upcommingdate' => Cases::where(function($q){
                return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
            })->where(['status' => 'Open'])->where('hearing_date','>=', date('Y-m-d'))->orderBy('hearing_date', 'asc')->take(10)->get()
        ];
        return view('clientlogin::index', $data);
    }

    public function my_cases (Request $request)
    {
        $models = Cases::where(function($q){
            return $q->where('status', 'Open')->orWhereIn('judgement_status',['Open','Reopen']);
        })->where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->get();
        $from = 'my_cases';
        return view('clientlogin::my_case', compact('models', 'from'));
    }
    public function my_closed_cases(Request $request)
    {
        $models = Cases::where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->where('judgement_status', 'Close')->get();
        $from = 'my_closed_cases';
        return view('clientlogin::my_case', compact('models', 'from'));
    }
    public function my_waiting_cases (Request $request)
    {
        $models = Cases::where(function($q){
            return $q->where('status', 'Open')->orWhereIn('judgement_status',['Open','Reopen']);
        })->where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->where('hearing_date', '>', date('Y-m-d'))->get();
        $from = 'my_waiting_cases';
        return view('clientlogin::my_case', compact('models', 'from'));
    }

    public function my_judgement_cases (Request $request)
    {
        $models = Cases::where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->where('status', 'Judgement')->where('judgement_status', '=', 'Judgement')->get();
        $from = 'my_judgement_cases';
        return view('clientlogin::my_case', compact('models', 'from'));
    }

    public function my_cases_show ($case_id){
        $model = Cases::with('acts', 'hearing_dates')->where(function($q){
            return $q->where('plaintiff', auth()->user()->client->id)->orWhere('opposite', auth()->user()->client->id);
        })->findOrFail($case_id);

        if (request()->print){
            return view('clientlogin::case_print', compact('model'));
        }
        return view('clientlogin::case_show', compact('model'));
    }

    public function my_profile()
    {
        $user = Client::findOrFail(auth()->user()->client->id);
        $countries = Country::all()->pluck('name', 'id')->prepend(__('client.Select country'), '');
        $states = State::where('country_id', $user->country_id)->pluck('name', 'id')->prepend(__('client.Select state'), '');
        $cities = City::where('state_id', $user->state_id)->pluck('name', 'id')->prepend(__('client.Select city'), '');
        $fields = null;

        if (moduleStatusCheck('CustomField')) {
            $fields = getFieldByType('client');
        }
        return view('clientlogin::profile', compact('user', 'countries', 'states', 'cities', 'fields'));
    }

    public function post_my_profile(Request $request)
    {
        if (!$request->json()) {
            abort(404);
        }
        $model = Client::find(auth()->user()->client->id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('client.Client Not Found')]);
        }
        $validate_rules = [
            'country_id' => 'sometimes|nullable|integer',
            'state_id' => 'sometimes|nullable|integer',
            'city_id' => 'sometimes|nullable|integer',
            'email' => 'sometimes|nullable|email|max:191',
            'mobile' => 'sometimes|nullable|string|max:191',
            'gender' => 'sometimes|nullable|string|max:191',
            'name' => 'required|max:191|string',
            'address' => 'sometimes|nullable|max:191|string',
            'description' => 'sometimes|nullable|max:1500|string',
            'email' => 'required|email|max:191|unique:users,email,' .( $model->user ? $model->user->id : '')
        ];

        if (moduleStatusCheck('CustomField')) {
            $validate_rules = array_merge($validate_rules, $this->generateValidateRules('client'));
        }

        $request->validate($validate_rules, validationMessage($validate_rules));

        if ($request->file) {
            if (File::exists($model->avatar)) {
                File::delete($model->avatar);
            }
            $model->avatar =  $this->saveAvatar($request->file);
        }

        $model->country_id = $request->country_id;
        $model->state_id = $request->state_id;
        $model->city_id = $request->city_id;
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


            $user = User::find($model->user_id);

            $user->name = $model->name;
            $user->email = $model->email;
            $user->avatar = $model->avatar;

            $user->save();



        $response = [
            'message' => __('client.Profile Updated Successfully'),
            'reload' => true,
        ];

        return response()->json($response);
    }
}
