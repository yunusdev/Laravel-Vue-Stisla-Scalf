<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\SubCategoryContract;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    protected $subCategoryRepository, $categoryRepository, $productRepository;

    public function __construct(SubCategoryContract $subCategoryRepository,
                                CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {

        $this->subCategoryRepository = $subCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;

    }

    public function getAll()
    {
        $data['categories'] = $this->categoryRepository->getCategories();
        $data['sub_categories'] = $this->subCategoryRepository->getSubCategories();
        return view('admin.categories.sub_categories')->with($data);
    }

    public function getProducts($subCategorySlug)
    {
        $subCategory = $this->subCategoryRepository->getSubCategoryBy(['slug' => $subCategorySlug]);
        $data['title'] = 'Sub Category (' . $subCategory->name . ') - Products';
        $data['products'] = $this->productRepository->findByWhere(['sub_category_id' => $subCategory->id], ['category', 'subCategory']);
        return view('admin.products.index')->with($data);
    }

    public function index(Category $category)
    {
        return $this->subCategoryRepository->getCategorySubCategories($category->id);
    }

    public function store(Request $request, Category $category)
    {

        try {

            $this->validate($request, [

                'name' => 'required|max:80|unique:sub_categories',

            ]);

            $params = $request->only('name', 'description');
            $params['slug'] = Str::slug($params['name']);
            $params['category_id'] = $category->id;
            return $this->subCategoryRepository->storeSubCategory($params);

        }catch (\Throwable $exception){

            throw $exception;

        }

    }

    public function update(Request $request, Category $category, SubCategory $subCategory)
    {
        //
        try {

            $this->validate($request, [

                'name' => 'required|max:80',

            ]);

            $params = $request->only('name', 'description');
            $params['slug'] = Str::slug($params['name']);
            $params['category_id'] = $category->id;
            $this->subCategoryRepository->updateSubCategory($params, $subCategory->id);
            return $subCategory->fresh();

        } catch (\Throwable $exception) {

            throw $exception;

        }
    }

    public function destroy(Category $category, SubCategory $subCategory)
    {
        //
        try {

            return $this->subCategoryRepository->deleteSubCategory($subCategory->id);

        } catch (\Throwable $exception) {

            throw $exception;

        }
    }
}
