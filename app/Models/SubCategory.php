<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    public function category(){

        return $this->belongsTo(Category::class);

    }
}
