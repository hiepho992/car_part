<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $data = ['delete_at'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
