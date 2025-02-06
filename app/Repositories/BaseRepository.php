<?php

namespace App\Repositories;

use App\Contract\GeneralRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements GeneralRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function getAll()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model->find($id);
    }
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }
    public function update($id, array $attributes)
    {
        $record = $this->model->findOrFail($id);
        $record->fill($attributes);
        if ($record->isDirty())
            $record->save();
        return $record;
    }
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}