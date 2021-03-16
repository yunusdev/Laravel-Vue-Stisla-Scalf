<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Contracts\SubCategoryContract;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //

    private $categoryRepository, $subCategoryRepository, $productRepository;

    public function __construct(CategoryContract $categoryRepository,
                                SubCategoryContract $subCategoryRepository, ProductContract $productRepository)
    {

        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->subCategoryRepository = $subCategoryRepository;

    }

    public function categoryProducts($categorySlug){

        $data['categories'] = $this->categoryRepository->getCategoriesSubCategories();
        $category = $this->categoryRepository->getCategoryBy(['slug' => $categorySlug]);
        $data['category'] = $category;
        $data['products'] = $this->productRepository->getCategoryProducts($category->id, ['category', 'subCategory']);

        return view('shop.index')->with($data);

    }

    public function subCategoryProducts($subCategorySlug){

        $data['categories'] = $this->categoryRepository->getCategoriesSubCategories();
        $subCategory = $this->subCategoryRepository->getSubCategoryBy(['slug' => $subCategorySlug], ['category']);
        $data['sub_category'] = $subCategory;
        $data['products'] = $this->productRepository->getSubCategoryProducts($subCategory->id, ['category', 'subCategory']);
        return view('shop.index')->with($data);

    }

}
