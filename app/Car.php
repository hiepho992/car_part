<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    protected $data = ['delete_at'];

    public function classCar()
    {
        return $this->belongsTo(ClassCar::class, 'classcar_id', 'id');
    }

}
