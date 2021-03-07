<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryContract
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getCategories()
    {
        return $this->all();
    }

    public function storeCategory(array $params)
    {
        return $this->create($params);
    }

    public function updateCategory(array $params, string $id)
    {
        return $this->update($params, $id);
    }

    public function deleteCategory(string $id)
    {
        return $this->delete($id);
    }


}
