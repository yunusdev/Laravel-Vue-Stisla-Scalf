<?php

namespace App\Repositories;

use App\Contracts\ProductsImageContract;
use App\Models\ProductsImage;

class ProductsImageRepository extends BaseRepository implements ProductsImageContract
{

    public function __construct(ProductsImage $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getProductsImages()
    {
        // TODO: Implement getProductsImages() method.
    }

    public function storeProductImage(array $params)
    {
        return $this->create($params);
    }

    public function updateProductImage(array $params, string $id)
    {
        // TODO: Implement updateProductImage() method.
    }

    public function deleteProductImage(string $id)
    {
        // TODO: Implement deleteProductImage() method.
    }


}
