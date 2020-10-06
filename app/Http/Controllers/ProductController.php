<?php

namespace App\Http\Controllers;

use App\Car;
use App\Category;
use App\ClassCar;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Datatable;
use App\Http\Requests\ProductUpdateValidate;
use App\Http\Requests\ProductValidate;
use App\Maker;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $categories = Category::all();
        $makers = Maker::all();
        $classCars = ClassCar::all();
        return view('admin.products.index', compact('cars', 'categories', 'makers', 'classCars'));
    }

    public function getList()
    {
        $products = Product::select('products.id AS id', 'products.name AS name', 'products.description AS description', 'products.price AS price', 'products.brand AS brand', 'products.manufacturing_data AS manufacturing_data')
        ->get();
        $datatable = DataTables::of($products)
        ->addColumn('action', function($products){
            return '<a href="javascript:;" onclick="product.edit('.$products->id.'), product.openModal(this)" type="button" class="btn btn-primary"><i class="far fa-edit"></i></a>
            <a href="javascript:;" onclick="product.delete('.$products->id.')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>';
        })
        ->addColumn('name', function($products){
            return '<a href="#" data-toggle="modal" data-target="#exampleModal" onclick="product.getCar('.$products->id.')">'.$products->name.'</a>';
        })
        ->rawColumns(['action', 'name'])
        ->make();

        return $datatable;
    }

    public function create(ProductValidate $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->brand = $request->brand;
        $products->manufacturing_data = $request->manufacturing_data;
        $products->category_id = $request->category_id;
        $products->save();
        foreach($request->car_id as $car_id){
            $products->cars()->attach($car_id);
        }

        // dd($products->cars());
        // // dd($products);
        return response()->json($products, 200);
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $car = $products->cars;
        foreach($car as $value){
           $classCars[] = $value->classCar;
        }
        foreach($classCars as $value){
            $makers[] = $value->maker;
        }

        return response()->json([$products, $car, $classCars,  $makers], 200);
    }

    public function update(ProductUpdateValidate $request, $id)
    {
        $products = Product::findOrFail($id);
        $products->name = $request->name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->brand = $request->brand;
        $products->manufacturing_data = $request->manufacturing_data;
        $products->category_id = $request->category_id;
        $products->update();
        // $cars = $products->cars->pluck('name', 'id')->toArray();
        // // dd($cars);
        // dd($request->car_id);
        // foreach ($cars as $key => $car) {
        //     foreach($request->car_id as $car_id){

        //         $products->cars()->updateExistingPivot($key, ['car_id' => $car_id]);
        //     }

        // }
        $products->cars()->detach();
        foreach($request->car_id as $car_id){
            $products->cars()->attach($car_id);
        }

        return response()->json($products, 200);
    }

    public function destroy($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        $products->cars()->detach();

        return $products;
    }

    public function getCar($id){
        $products = Product::findOrfail($id);
        $cars = $products->cars;
        $data = [];
        foreach($cars as $car){
            $data[] = [
                'id'=> $car->id,
                'maker' => $car->classCar->maker->name,
                'name' => $car->name
            ];
        }
        $datatable = DataTables::of($data)->make();

        return $datatable;
    }

    public function makers($id)
    {
        $i = explode(",", $id);
        $classCars = Maker::select('class_cars.*')
        ->join('class_cars', 'class_cars.maker_id', '=', 'makers.id')
        ->wherein('makers.id', $i)
        ->get();
        return response()->json($classCars, 200);
    }

    public function classCar($id)
    {
        $i = explode(",", $id);
        $cars = Car::wherein('classcar_id', $i)->get();

        return response()->json($cars, 200);
    }

    public function search()
    {
        $categories = Category::all();
        return view('admin.products.search', compact('categories'));
    }

    public function getDataSearch(Request $request){
        // DB::enableQueryLog();
        $products = Product::join('categories', function($join){
            $join->on('products.category_id', '=', 'categories.id');
        })
        ->select('products.id AS id', 'products.name AS name', 'products.description AS description', 'products.price AS price', 'products.brand AS brand', 'products.manufacturing_data AS manufacturing_data', 'categories.name AS category')
        ->where(function($query) use($request){
            if($request->name){
                $query->where('products.name','LIKE', '%'.$request->name.'%');
            }

            if($request->category_id){
                $query->where('products.category_id', $request->category_id);
            }

            if($request->manufacturing_data_from){
                $query->where('products.manufacturing_data','>=', $request->manufacturing_data_from);
            }

            if($request->manufacturing_data_to){
                $query->where('products.manufacturing_data', '<=', $request->manufacturing_data_to);
            }

            if($request->description){
                $query->where('products.description','LIKE', '%'.$request->description.'%');
            }

            if($request->brand){
                $query->where('products.brand','LIKE', '%'.$request->brand.'%');
            }

            if($request->price_form){
                $query->where('products.price', '>=' ,$request->price_form);
            }

            if($request->price_to){
                $query->where('products.price', '<=', $request->price_to);
            }
        })->get();
        //  dd(DB::getQueryLog());
        $datatable = DataTables::of($products)->make();

        return $datatable;
    }
}
