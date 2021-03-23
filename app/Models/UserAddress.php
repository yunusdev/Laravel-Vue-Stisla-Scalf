<?php

namespace App\Models;

use App\Traits\uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory, uuids;

    protected $fillable = ['user_id', 'address', 'lga', 'state', 'country'];

    public function user(){

        return $this->belongsTo(User::class);

    }
}
