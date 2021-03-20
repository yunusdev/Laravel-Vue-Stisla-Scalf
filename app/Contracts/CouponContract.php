<?php

namespace App\Contracts;


interface CouponContract
{

    public function getCoupons();

    public function storeCoupon(array $params);

    public function validateCoupon(string $code, int $totalAmount, string $userId = null);

    public function getCouponBy(array $data, array $relationship = []);

    public function getCouponsBy(array $data, array $relationship = []);

    public function updateCoupon(array $params, string $id);
//
    public function deleteCoupon(string $id);

}
