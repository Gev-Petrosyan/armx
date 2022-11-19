<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["id_user", "name", "category", "price", "description"];

    public function images() {
        return $this->hasMany(ProductImage::class, 'id_product');
    }

    public function city() {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

}
