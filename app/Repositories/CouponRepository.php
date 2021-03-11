<?php

namespace App\Repositories;

use App\Contracts\CouponContract;
use App\Models\Coupon;

class CouponRepository extends BaseRepository implements CouponContract
{

    public function __construct(Coupon $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function getCoupons()
    {
        return $this->all();
    }

    public function getCouponBy(array $data)
    {
        return $this->findOneBy($data);
    }


    public function storeCoupon(array $params)
    {
        $params['admin_id'] = auth('admin')->id();
        return $this->create($params);
    }

    public function updateCoupon(array $params, string $id)
    {
        return $this->update($params, $id);
    }

    public function deleteCoupon(string $id)
    {
        return $this->delete($id);
    }


}
