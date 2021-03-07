<?php

namespace App\Contracts;

interface SubCategoryContract
{
    public function getSubCategories();

    public function storeSubCategory(array $params);

    public function updateSubCategory(array $params, string $id);
//
    public function deleteSubCategory(string $id);
}
