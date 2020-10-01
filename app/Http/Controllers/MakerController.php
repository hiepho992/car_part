<?php

namespace App\Http\Controllers;

use App\Maker;
use Illuminate\Http\Request;
use App\Http\Controllers\Datatable;
use App\Http\Requests\CreateMaker;
use App\Http\Requests\MakerValidate;
use App\Http\Requests\UpdateMaker;
use Yajra\DataTables\Facades\DataTables;

class MakerController extends Controller
{

    public function index()
    {
        return view('admin.makers.index');
    }

    public function getList()
    {
        $makers = Maker::select('id', 'name');
        $datatable = DataTables::of($makers)
        ->addColumn('action', function($makers){
            return '<a href="javascript:;" onclick="maker.edit('.$makers->id.'), maker.openModal(this)" type="button" class="btn btn-primary"><i class="far fa-edit"></i></a>
            <a href="javascript:;" onclick="maker.delete('.$makers->id.')" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>';
        })
        ->make();

        return $datatable;
    }

    public function create(MakerValidate $request)
    {
        $makers = new Maker();
        $makers->name = $request->name;
        $makers->save();

        return response()->json($makers, 200);
    }

    public function edit($id)
    {
        $makers = Maker::findOrFail($id);

        return response()->json($makers, 200);
    }

    public function update(MakerValidate $request, $id)
    {
        $makers = Maker::findOrFail($id);
        $makers->name = $request->name;
        $makers->update();

        return response()->json($makers, 200);
    }

    public function destroy($id)
    {
        return Maker::destroy($id);
    }
}
