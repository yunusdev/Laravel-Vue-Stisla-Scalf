<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Utils\RandomStringGenerator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{

    protected $productRepository, $categoryRepository;

    public function __construct(ProductContract $productRepository, CategoryContract $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    public function index(){

        $data['products'] = $this->productRepository->getProducts();
        $data['title'] = 'Products';
        return view('admin.products.index')->with($data);

    }

    public function create(){

        $data['categories'] = $this->categoryRepository->getCategories();
        return view('admin.products.create')->with($data);

    }

    public function store(Request  $request){

        try {

            $this->validate($request, [

//                'name' => 'required|max:100|unique:products',
                'name' => 'required|max:100',
                'class' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'price' => 'required',
                'available_sizes' => 'required|array|min:1',
                'available_colors' => 'required|array|min:1',
                'images' => 'required|array|min:1',
                'front_image' => 'required',
                'description' => 'required',

            ]);

            $params = $request->only('name', 'class', 'category_id', 'images', 'quantity', 'weight', 'front_image', 'available',
                'sub_category_id', 'price', 'available_colors', 'available_sizes', 'description', 'featured', 'verified');

            $params['available_colors'] = implode(',', $params['available_colors']);
            $params['available_sizes'] = implode(',', $params['available_sizes']);

            return $this->productRepository->storeProduct($params);


        } catch (\Throwable $exception) {

            throw $exception;
        }


    }

    public function show($slug){

        $data['product'] = $this->productRepository->getProductBy(['slug' => $slug], ['category', 'subCategory', 'productImages']);
        return view('admin.products.show')->with($data);

    }

    public function edit($slug){


    }

    public function update(Request  $request, Product $product){


    }

    public function destroy(Product $product){


    }
}
