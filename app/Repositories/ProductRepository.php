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

    public function getProductsBy(array $data, array $relationship = [])
    {
        return $this->findByWhere($data, $relationship);
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

    private function handleArrayImageUploads($images, $productId)
    {
        foreach ($images as $image) {
            $img = UploadImage::upload($image, 'products');
            $this->productImageRepository->storeProductImage([
                'product_id' => $productId,
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
            $this->handleArrayImageUploads($images, $product->id);

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
