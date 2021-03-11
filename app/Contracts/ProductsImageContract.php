<?php

namespace App\Contracts;


interface ProductsImageContract
{

    public function getProductsImages();

    public function storeProductImage(array $params);

    public function updateProductImage(array $params, string $id);
//
    public function deleteProductImage(string $id);

}
