<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['expires_in'];

    protected $appends = ['expires_format'];

    public function users(){

        return $this->belongsToMany(User::class, 'coupon_user')->withTimestamps()->orderBy('created_at', 'DESC');

    }

    public function getExpiresFormatAttribute(){

        return $this->expires_in ? $this->expires_in->diffForHumans() : null;

    }

}
