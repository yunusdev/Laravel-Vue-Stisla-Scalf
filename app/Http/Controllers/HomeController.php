<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $categoryRepository, $productRepository;

    public function __construct(CategoryContract $categoryRepository, ProductContract $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->middleware('auth')->except('index');
    }

    public function index()
    {

        $categories = $this->categoryRepository->getTopCategories();
        foreach ($categories as $category){

            $category['top_products'] = $this->productRepository->getTopCategoryProducts($category->id);
        }
        $data['top_categories'] = $categories;
        $data['trending_products'] = $this->productRepository->getTrendingProducts();

        return view('welcome')->with($data);
    }
}
