<?php

namespace App\Http\Controllers;

use App\Car;
use App\ClassCar;
use App\Http\Requests\CarUpdateValidate;
use App\Http\Requests\CarValidate;
use App\Maker;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CarController extends Controller
{
    public function index()
    {
        $classCar = ClassCar::all();
        return view('admin.car.index', compact('classCar'));
    }

    public function getList()
    {
        $car = Car::join('class_cars', 'cars.classcar_id', '=', 'class_cars.id')
        ->select('cars.id AS id', 'cars.name AS name', 'class_cars.name AS classCar')
        ->get();
        $datatable = DataTables::of($car)
        ->addColumn('action', function($car){
            return '<a href="javascript:;" onclick="car.edit('.$car->id.'), car.openModal(this)" type="button" class="btn btn-primary"><i class="far fa-edit"></i></a>
            <a href="javascript:;" onclick="car.delete('.$car->id.')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>';
        })
        ->make();

        return $datatable;
    }

    public function create(CarValidate $request)
    {
        $car = new Car();
        $car->name = $request->name;
        $car->classcar_id = $request->classcar_id;
        $car->save();

        return response()->json($car, 200);
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);

        return response()->json($car, 200);
    }

    public function update(CarUpdateValidate $request, $id)
    {
        $car = Car::findOrFail($id);
        $car->name = $request->name;
        $car->classcar_id = $request->classcar_id;
        $car->update();

        return response()->json($car, 200);
    }

    public function destroy($id)
    {
        return Car::destroy($id);
    }
}
