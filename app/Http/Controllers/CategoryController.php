<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryUpdateValidate;
use App\Http\Requests\CategoryValidate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function getList()
    {
        $categories = Category::all();
        $datatable = DataTables::of($categories)
        ->addColumn('action', function($categories){
            return '<a href="javascript:;" onclick="category.edit('.$categories->id.'), category.openModal(this)" type="button" class="btn btn-primary"><i class="far fa-edit"></i></a>
            <a href="javascript:;" onclick="category.delete('.$categories->id.')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>';
        })
        ->make();

        return $datatable;
    }

    public function create(CategoryValidate $request)
    {
        $categories = new Category();
        $categories->name = $request->name;
        $categories->save();

        return response()->json($categories, 200);
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);

        return response()->json($categories, 200);
    }

    public function update(CategoryUpdateValidate $request, $id)
    {
        $categories = Category::findOrFail($id);
        $categories->name = $request->name;
        $categories->update();

        return response()->json($categories, 200);
    }

    public function destroy($id)
    {
        return Category::destroy($id);
    }
}
