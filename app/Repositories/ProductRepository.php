<?php

namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Contracts\ProductsImageContract;
use App\Models\Product;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductRepository extends BaseRepository implements ProductContract
{

    private $productImageRepository;

    public function __construct(Product $model, ProductsImageContract $productImageRepository)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->productImageRepository = $productImageRepository;

    }

    public function getProducts()
    {
        return $this->all(['*'], 'created_at', 'desc',  ['category', 'subCategory']);
    }

    public function getTopCategoryProducts(string $categoryId, int $num = 3)
    {
        return $this->model->where('category_id', $categoryId)->latest()->take($num)->get();

    }

    public function incrementProductViewCount(Product $product)
    {

        $product->views_count++;
        $product->save();

    }

    public function getRelatedProducts(Product $product, int $num = 6)
    {
        return $this->model->where('id', '!=', $product->id)->where('sub_category_id', $product->sub_category_id)
            ->latest()->take($num)->get();

    }

    public function getTrendingProducts(int $num = 6)
    {
        return $this->model->orderBy('views_count', 'desc')->take($num)->get();

    }

    public function getProductsBy(array $data, array $relationship = [])
    {
        return $this->findByWhere($data, $relationship);
    }

    public function getCategoryProducts(string $categoryId, array $relationship = [])
    {
        return $this->findByWhere(['category_id' => $categoryId], $relationship);
    }

    public function getSubCategoryProducts(string $subCategoryId, array $relationship = [])
    {
        return $this->findByWhere(['sub_category_id' => $subCategoryId], $relationship);

    }

    public function getProductById(string $id)
    {
        return $this->find($id);

    }

    public function getProductBy(array $data, array $relationship = [])
    {
        return $this->findOneBy($data, $relationship);

    }
    private function handleImageUpload($params)
    {
        $imageKeys = ['front_image'];
        foreach ($imageKeys as $key) {
            if (array_key_exists($key, $params) && !empty($params[$key])) {
                try {
                    $params[$key] = UploadImage::upload($params[$key], 'products');
                } catch (\Throwable $th) {
                    throw $th;
                }
            } else {
                unset($params[$key]);
            }
        }
        return $params;
    }

    private function handleArrayImageUploads($images, $productId, $categoryId)
    {
        foreach ($images as $image) {
            $img = UploadImage::upload($image, 'products');
            $this->productImageRepository->storeProductImage([
                'product_id' => $productId,
                'category_id' => $categoryId,
                'path' => $img
            ]);
        }
    }


    public function storeProduct(array $params)
    {
        try {
            $params = $this->handleImageUpload($params);
            Log::debug($params);
            Log::debug($params);
            $images = $params['images'];
            unset($params['images']);

            $params['code'] = $this->generateProductCode();
            $params['admin_id'] = auth('admin')->id();
            $params['slug'] = Str::slug($params['name'].'-'.$params['code']);

            $product = $this->create($params);
            $this->handleArrayImageUploads($images, $product->id, $product->category_id);

            return $product;
//            return $this->create($params);
        } catch (\Throwable $exception) {
            throw $exception;
        }
    }

    public function updateProduct(array $params, string $id)
    {
        return $this->update($params, $id);
    }

    private function generateProductCode()
    {
        $start = round(strlen(time())/2)-1;
        $end = strlen(time());
        return substr(time(), $start, $end);
    }


    public function deleteProduct(string $id)
    {
        return $this->delete($id);
    }

}
