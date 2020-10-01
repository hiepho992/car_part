<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    protected $data = ['delete_at'];

    public function classCars()
    {
        return $this->hasMany(ClassCar::class, 'maker_id', 'id');
    }

    public function cars()
    {
        return $this->hasManyThrough(Car::class, ClassCar::class, 'maker_id', 'classcar_id', 'id', 'id');
    }
}
