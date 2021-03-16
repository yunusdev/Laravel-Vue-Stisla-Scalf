<?php

namespace App\Contracts;


interface CategoryContract
{

    public function getCategories();

    public function getTopCategories(int $num = 3);

    public function getCategoriesSubCategories();

    public function storeCategory(array $params);

    public function getCategoryBy(array $data);

    public function updateCategory(array $params, string $id);
//
    public function deleteCategory(string $id);

}
