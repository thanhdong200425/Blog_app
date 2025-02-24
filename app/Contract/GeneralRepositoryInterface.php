<?php

namespace App\Contract;

use Illuminate\Database\Eloquent\Model;

interface GeneralRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}