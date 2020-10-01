<?php

namespace App\Http\Controllers;

use App\ClassCar;
use App\Http\Requests\ClassCarValidate;
use App\Maker;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClassCarController extends Controller
{
    public function index()
    {
        $makers = Maker::all();
        return view('admin.classCar.index', compact('makers'));
    }

    public function getList()
    {
        $classCars = ClassCar::join('makers', 'class_cars.maker_id', '=', 'makers.id')
        ->select('class_cars.id AS id', 'class_cars.name AS name', 'makers.name AS maker')
        ->get();
        $datatable = DataTables::of($classCars)
        ->addColumn('action', function($classCars){
            return '<a href="javascript:;" onclick="classCar.edit('.$classCars->id.'), classCar.openModal(this)" type="button" class="btn btn-primary"><i class="far fa-edit"></i></a>
            <a href="javascript:;" onclick="classCar.delete('.$classCars->id.')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>';
        })
        ->make();

        return $datatable;
    }

    public function create(ClassCarValidate $request)
    {
        $classCars = new ClassCar();
        $classCars->name = $request->name;
        $classCars->maker_id = $request->maker_id;
        $classCars->save();

        return response()->json($classCars, 200);
    }

    public function edit($id)
    {
        $classCars = ClassCar::findOrFail($id);
        $maker = $classCars->maker->id;

        return response()->json([$classCars, $maker], 200);
    }

    public function update(ClassCarValidate $request, $id)
    {
        $classCars = ClassCar::findOrFail($id);
        $classCars->name = $request->name;
        $classCars->maker_id = $request->maker_id;
        $classCars->update();

        return response()->json($classCars, 200);
    }

    public function destroy($id)
    {
        return ClassCar::destroy($id);
    }
}
