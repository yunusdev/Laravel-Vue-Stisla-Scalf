<?php

namespace App\Contracts;


interface CouponContract
{

    public function getCoupons();

    public function storeCoupon(array $params);

    public function getCouponBy(array $data);

    public function updateCoupon(array $params, string $id);
//
    public function deleteCoupon(string $id);

}
