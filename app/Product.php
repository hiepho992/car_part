<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $data = ['delete_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_product', 'product_id', 'car_id');
    }
}
