<?php


namespace Modules\Finance\Services;


use Modules\Finance\Entities\Service;

class ServiceService
{
    private $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function getAllByType(array $type)
    {
        return $this->model->whereIn('type', $type)->get();
    }

    public function store(array $requests)
    {
        return $this->model->forceCreate($this->formatRequest($requests));

    }

    public function update($id, array $requests)
    {
        $model = $this->findById($id, gv($requests, 'type', 'service'));
        $model->forceFill($this->formatRequest($requests))->save();
        return $model->refresh();
    }

    private function formatRequest(array $requests)
    {
        return [
            'name' => gv($requests, 'name'),
            'type' => gv($requests, 'type'),
            'charge' => gv($requests, 'charge', 0),
            'description' => gv($requests, 'description'),
        ];
    }

    public function findById($id, string $type = null)
    {
        if ($type){
            return $this->model->where(['id' => $id, 'type' => $type])->firstOrFail();
        }
        return $this->model->findOrFail($id);

    }

    public function destroy(int $id, string $type)
    {
        $model = $this->destroyAble($id, $type);

        return $model->delete();
    }

    private function destroyAble(int $id, string $type)
    {
        $model = $this->findById($id, $type);

//        delete Logic

        return $model;
    }

    public function pluckAllByType($type, $come_from = 'income')
    {
        return $this->model->whereIn('type', $type)->get()->pluck('name', 'id')->prepend(__('finance.Select '.ucfirst($come_from)), '');
    }


}
