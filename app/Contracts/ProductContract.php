<?php

namespace App\Contracts;

interface ProductContract
{

    public function getProducts();

    public function getProductById(string $id);

    public function getProductBy(array $data, array $relationship = []);

    public function getProductsBy(array $data, array $relationship = []);

    public function storeProduct(array $params);

    public function updateProduct(array $params, string $id);

    public function deleteProduct(string $id);

}
