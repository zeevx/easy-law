<?php


namespace Modules\CustomField\Services;


use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Modules\CustomField\Entities\CustomField;
use Modules\ModuleManager\Entities\Module;

class CustomFieldService
{

    /**
     * @var CustomField
     */
    private $customField;

    public function __construct(CustomField $customField)
    {
        $this->customField = $customField;
    }

    public function preRequisite ( $id = Null ): array
    {
        $list = get_custom_field_var('list');
        $data['forms'] = generate_custom_field_normal_translated_select_option($list['form_name']);
        $data['field_types'] = generate_custom_field_normal_translated_select_option($list['field_type']);
        $data['field_widths'] = generate_custom_field_normal_translated_select_option($list['field_width']);
        $data['controlled_fields'] =[ "" => __('custom_fields.select_controlled_field')];

        $modules = Module::all();
        foreach($modules as $module){
            if (moduleStatusCheck($module->name) ){
               $list = getModuleVar($module->name, 'custom_field');

               if ($list and gv($list, 'form_name')){
                   $data['forms'] = array_merge($data['forms'], generate_custom_field_normal_translated_select_option($list['form_name']));
               }
            }
        }

        if ($id){
            $data['model'] = $this->findById($id);
            if ($data['model']->controlled_field){
                $data['controlled_fields'] = $this->getByParamForChild(['form_name' => $data['model']->form_name, 'status' => 1])->pluck('title', 'id')->prepend(__('custom_fields.select_controlled_field'), '');
            }

        }


        return $data;
    }

    public function store(array $requests)
    {
        return $this->customField->forceCreate($this->formatRequests($requests));
    }

    private function formatRequests(array $requests): array
    {
        $formatted = [
            'form_name' => gv($requests, 'form_name'),
            'type' => gv($requests, 'type'),
            'title' => gv($requests, 'title'),
            'pattern' => gv($requests, 'pattern'),
            'min' => gv($requests, 'min'),
            'max' => gv($requests, 'max'),
            'width' => gv($requests, 'width'),
            'description' => gv($requests, 'description'),
            'status' => gbv($requests, 'status'),
            'required' => gbv($requests, 'required'),
            'default_value' => gv($requests, 'default_value'),
            'values' => gv($requests, 'values'),
            'controlled_field' => gv($requests, 'controlled_field'),
            'controlled_field_value' => null,
        ];

        if (gv($requests, 'controlled_field')){
            $formatted['controlled_field_value'] = gv($requests, 'controlled_field_value');
        }

        return $formatted;
    }

    public function getAll()
    {
        return $this->customField->all();
    }

    public function getByParam(array $params)
    {
        return $this->customField->where($params)->get();
    }

    public function findById($id)
    {
        return $this->customField->findOrFail($id);
    }

    /**
     * @throws ValidationException
     */
    public function update($id, array $requests)
    {
        $customField = $this->findById($id);
        if (gv($requests, 'controlled_field') == $id){
            throw ValidationException::withMessages(['message' => 'Parent field cannot be child field']);
        }
        $customField->forceFill($this->formatRequests($requests))->save();
        return $customField->refresh();
    }

    /**
     * @throws \Throwable
     */
    public function destroy(int $id)
    {
        $customField = $this->findById($id);

        throw_if($customField->responses()->count(), ValidationException::withMessages(['message' => __('custom_fields.has_response')]));
        throw_if($customField->childs()->count(), ValidationException::withMessages(['message' => __('custom_fields.has_childs')]));




        return $customField->delete();

    }

    public function findByParam(array $params)
    {
        return $this->customField->where($params)->firstOrFail();
    }

    public function getByParamForChild(array $params, $id= null)
    {
        $model = $this->customField->where($params)->whereNull('controlled_field')->whereNotIn('type', ['file', 'date']);
        if ($id){
            $model->where('id', '!=', $id);
        }
        return $model->get();
    }


}
