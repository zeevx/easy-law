<?php


namespace Modules\Finance\Services;


use Illuminate\Support\Facades\DB;
use Modules\Finance\Entities\Tax;

class TaxService
{
    /**
     * @var Tax
     */
    private $model;

    public function __construct(Tax $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function store(array $requests)
    {
        return $this->model->forceCreate($this->formatRequest($requests));
    }

    private function formatRequest(array $requests)
    {
        return [
            'name' => gv($requests, 'name'),
            'rate' => gv($requests, 'rate', 0),
            'description' => gv($requests, 'description'),
        ];
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, array $requests)
    {
        $model = $this->findById($id);
        $model->forceFill($this->formatRequest($requests))->save();
        return $model->refresh();
    }

    public function destroy($id)
    {
        $model = $this->destroyAble($id);

        return $model->delete();
    }

    private function destroyAble( $id)
    {
        $model = $this->findById($id);

//        delete Logic

        return $model;
    }

    public function pluckAll()
    {
        return $this->model->select(DB::raw('CONCAT(name, " (", rate, "%)") AS full_name'), DB::raw('CONCAT(id, "-", rate) AS id_rate'))->get()->pluck('full_name', 'id_rate')->prepend( __('finance.select_tax'), '');
    }

}
