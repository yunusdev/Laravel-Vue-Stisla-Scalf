<?php

namespace App\Repositories;

use App\Contracts\CategoryContract;
use App\Contracts\SubCategoryContract;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryContract
{

    private $subCategoryRepository;

    public function __construct(Category $model, SubCategoryContract $subCategoryRepository)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getCategories()
    {
        return $this->all();
    }

    public function getTopCategories(int $num = 3)
    {
        return $this->model->latest()->take($num)->get();
    }

    public function getCategoriesSubCategories()
    {

        $categories = $this->getCategories();

        foreach ($categories as $category){

            $category['sub_categories'] = $this->subCategoryRepository->getCategorySubCategories($category->id);

        }

        return $categories;


    }


    public function getCategoryBy(array $data)
    {
        return $this->findOneBy($data);
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
