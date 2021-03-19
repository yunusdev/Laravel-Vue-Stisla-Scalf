<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //

    private $productRepository, $categoryRepository;

    public function __construct(ProductContract $productRepository, CategoryContract $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){

        $data['products'] = $this->productRepository->getProducts();
        $data['categories'] = $this->categoryRepository->getCategoriesSubCategories();

        return view('shop.index')->with($data);

    }

    public function viewProduct($slug){

        $data['product'] = $this->productRepository->getProductBy(['slug' => $slug], ['productImages']);
//        $this->productRepository->incrementProductViewCount($data['product']);
        $data['related_products'] = $this->productRepository->getRelatedProducts($data['product']);
        return view('shop.product-view')->with($data);

    }
}
