<?php

namespace Modules\CustomField\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Http\Requests\CustomFieldRequest;
use Modules\CustomField\Services\CustomFieldService;

class CustomFieldController extends Controller
{

    private $customFieldService;

    private $request;

    public function __construct(
        CustomFieldService $customFieldService,
        Request $request
    )
    {
        $this->customFieldService = $customFieldService;
        $this->request = $request;
    }

    public function index()
    {
        $models = $this->customFieldService->getAll();
        return view('customfield::index', compact('models'));
    }

    public function create()
    {
        $preRequisite = $this->customFieldService->preRequisite();
        return view('customfield::create', $preRequisite);
    }

    public function store(CustomFieldRequest $request)
    {
        $model = $this->customFieldService->store($request->all());

        $response = [
            'model' => $model,
            'message' => __('custom_fields.Custom Field Added Successful'),
            'goto' => route('custom_fields.create')
        ];

        return response()->json($response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $model = $this->customFieldService->findById($id);
        return view('customfield::show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $preRequisite = $this->customFieldService->preRequisite($id);
        return view('customfield::edit', $preRequisite);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CustomFieldRequest $request, $id)
    {
        $model = $this->customFieldService->update($id, $request->all());

        $response = [
            'model' => $model,
            'message' => __('custom_fields.Custom Field Updated Successful'),
            'goto' => route('custom_fields.index')
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->customFieldService->destroy($id);

        $response = [
            'message' => __('custom_fields.Custom Field Deleted Successful'),
            'goto' => route('custom_fields.index')
        ];

        return response()->json($response);
    }

    public function get_field_by_form_name(): array
    {
        $form_name = $this->request->form_name;
        $data['parent_id'] = $this->request->id;
        $data['select_text'] = __('custom_fields.select_controlled_field');
        $params = ['form_name' => $form_name, 'status' => 1];
        $data['models'] = $this->customFieldService->getByParamForChild($params, $data['parent_id']);
        $data['controlled_field'] = null;
        if ($data['parent_id']){
            $parent = $this->customFieldService->findById($data['parent_id']);
            $data['controlled_field'] = $parent->controlled_field;
        }
        return $data;
    }

    public function get_field_by_form_name_and_form_id(): array
    {
        $form_name = $this->request->form_name;
        $field = $this->request->field;
        $data['parent_id'] = $this->request->id;
        $data['select_text'] = __('custom_fields.select_controlled_field');
        $data['model'] = $this->customFieldService->findByParam(['form_name' => $form_name, 'status' => 1, 'id' => $field]);
        $field = 'text';
        if (in_array($data['model']->type, ['radio', 'dropdown', 'checkbox'])){
            $field = $data['model']->type;
        }
        $value =  null;
        if ($data['parent_id']){
            $parent = $this->customFieldService->findById($data['parent_id']);
            $value = $parent->controlled_field_value;
        }
        $data['html'] = view('customfield::controlled_fields.'.$field)->with(['field' => $data['model'], 'value' => $value])->render();
        return $data;
    }
}
