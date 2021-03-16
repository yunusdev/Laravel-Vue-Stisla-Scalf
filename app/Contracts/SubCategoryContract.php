<?php

namespace App\Contracts;

interface SubCategoryContract
{
    public function getSubCategories();

    public function getSubCategoryBy(array $params, array $relationship);

    public function getCategorySubCategories(string $id);

    public function storeSubCategory(array $params);

    public function updateSubCategory(array $params, string $id);
//
    public function deleteSubCategory(string $id);
}
