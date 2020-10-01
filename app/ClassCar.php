<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassCar extends Model
{
    protected $guarded = [];

    use SoftDeletes;
    protected $data = ['delete_at'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'classcar_id', 'id');
    }

    public function maker()
    {
        return $this->belongsTo(Maker::class, 'maker_id', 'id');
    }
}
