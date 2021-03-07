<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {

       $this->categoryRepository = $categoryRepository;

    }

    public function index()
    {
        $data['categories'] = $this->categoryRepository->getCategories();
        return view('admin.categories.index')->with($data);
    }

    public function store(Request $request)
    {

        try {

            $this->validate($request, [

                'name' => 'required|max:80|unique:categories',

            ]);

            $params = $request->only('name', 'description');
            $params['slug'] = Str::slug($params['name']);
            return $this->categoryRepository->storeCategory($params);

        }catch (\Throwable $exception){

            throw $exception;

        }

    }

    public function update(Request $request, Category $category)
    {
        //
        try {

            $this->validate($request, [

                'name' => 'required|max:80',

            ]);

            $params = $request->only('name', 'description');
            $params['slug'] = Str::slug($params['name']);
            $this->categoryRepository->updateCategory($params, $category->id);
            return $category->fresh();

        } catch (\Throwable $exception) {

            throw $exception;

        }
    }

    public function destroy($id)
    {
        //
        try {

            return $this->categoryRepository->deleteCategory($id);

        } catch (\Throwable $exception) {

            throw $exception;

        }
    }
}
