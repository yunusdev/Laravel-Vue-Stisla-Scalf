<?php

namespace App\Http\Controllers;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return view('shop.index')->with($data);

    }

    public function session(){

        return json_encode(Session::get('cart'));

    }

    public function viewProduct($slug){

        $data['product'] = $this->productRepository->getProductBy(['slug' => $slug], ['productImages', 'category', 'subCategory']);
//        $this->productRepository->incrementProductViewCount($data['product']);
        $data['related_products'] = $this->productRepository->getRelatedProducts($data['product']);
        return view('shop.product-view')->with($data);

    }

    public function getCategories(){

        return $this->categoryRepository->getCategoriesSubCategories();
    }

    public function trendingProducts(){

        return $this->productRepository->getTrendingProducts();

    }

    public function topSellingProducts($num = 3){

        return $this->productRepository->getTopSellingProducts(intval($num));

    }

    public function newArrivalsProducts(){

        return $this->productRepository->getNewArrivalsProducts();

    }
}
