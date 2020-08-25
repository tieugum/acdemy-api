<?php

namespace App\Support\Traits;

Trait HasCrudAction
{
    public function index()
    {
        $entities = $this->getModel()->all();

        return $this->getResource()->collection($entities);
    }

    public function findBySlug($slug)
    {
        $entity = $this->getModel()->findBySlug($slug);

        return $this->getResource($entity);
    }

    public function store()
    {
        $entity = $this->getModel()->create(
            $this->getRequest('store')->all(),
        );

        return $this->getResource($entity);
    }

    public function update($id)
    {
        $entity = $this->getEntity($id);

        $entity->update(
            $this->getRequest('update')->all(),
        );

        return $this->getResource($entity);
    }

    public function destroy($ids)
    {
        $this->getModel()
            ->whereIn('id', explode(',', $ids))
            ->delete();

        return response()->json([
            'status' => 'Record Deleted.'
        ], 200);
    }

    protected function getModel()
    {
        return new $this->model;
    }

    protected function getEntity($id)
    {
        return $this->getModel()
            ->with($this->relations())
            ->findOrFail($id);
    }

    protected function getResource($resource = null)
    {
        $object = $this->resources;

        return new $object($resource);
    }

    protected function getRequest($action)
    {
        if(! isset($this->validation)) {
            return request();
        }

        if(isset($this->validation[$action])) {
            return resolve($this->validation[$action]);
        }

        return resolve($this->validation);
    }

    private function relations()
    {
        return collect($this->with ?? [])->all();
    }
}
