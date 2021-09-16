<?php


namespace Modules\Finance\Services;


use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Traits\CustomFields;
use Modules\Finance\Entities\Vendor;

class VendorService
{
    use CustomFields;
    /**
     * @var Vendor
     */
    private $model;

    public function __construct(Vendor $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPreRequisite($id = null)
    {
        $data['countries'] = Country::all()->pluck('name', 'id')->prepend(__('client.Select country'), '');
        $data['states'] = State::where('country_id', config('configs')->where('key', 'country_id')->first()->value)->pluck('name', 'id')->prepend(__('client.Select state'), '');
        $data['cities'] = [''=> __('common.Select State First')];
        $data['fields'] = null;

        if (moduleStatusCheck('CustomField')) {
            $data['fields'] = getFieldByType('vendor');
        }

        if ($id){
            $data['model'] = $this->findById($id);
            if ($data['model']->state_id){
                $data['cities'] = City::where('state_id', $data['model']->state_id)->get()->pluck('name', 'id')->prepend(__('vendor.Select city'), '');
            }

            if ($data['model']->counrty_id){
                $data['states'] = State::where('country_id', $data['model']->counrty_id)->pluck('name', 'id')->prepend(__('client.Select state'), '');
            }

        }

        return $data;
    }

    public function store(array $requests)
    {
        $model = $this->model->forceCreate($this->formatRequest($requests));
        if (moduleStatusCheck('CustomField') and gv($requests, 'custom_field')) {
            $this->storeFields($model, $requests['custom_field'], 'vendor');
        }

        return $model->refresh();
    }

    public function update($id, array $requests)
    {
        $model = $this->findById($id);
        $model->forceFill($this->formatRequest($requests))->save();
        $model->refresh();
        if (moduleStatusCheck('CustomField') and gv($requests, 'custom_field')) {
            $this->storeFields($model, $requests['custom_field'], 'vendor');
        }

        return $model;
    }

    private function formatRequest(array $requests)
    {
        return [
            'country_id' => gv($requests, 'country_id'),
            'state_id' => gv($requests, 'state_id'),
            'city_id' => gv($requests, 'city_id'),
            'name' => gv($requests, 'name'),
            'email' => gv($requests, 'email'),
            'mobile' => gv($requests, 'mobile'),
            'address' => gv($requests, 'address'),
            'description' => gv($requests, 'description'),
        ];
    }

    public function findById(int $id)
    {
        return $this->model->with('invoices', 'transactions')->findOrFail($id);
    }

    public function destroy($id)
    {
        $model = $this->findById($id);
        if (moduleStatusCheck('CustomField')) {
            $model->load('customFields');
            $model->customFields()->delete();
        }

        return $model->delete();
    }

}
