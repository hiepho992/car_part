@extends('admin.layouts.dashboard')
@section('title', 'Trang tìm kiếm')
@section('content')
    @push('bottom')
        <script src="{{ asset('backend/subjectJs/productJs.js') }}"></script>
    @endpush
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tìm kiếm phụ tùng</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div>
            <form id="productFormSearch">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Tên phụ tùng</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Loại phụ tùng</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Giá</label>
                    <div class="col-sm-4.5">
                        <input type="number" class="form-control" id="price_form" name="price_form">
                    </div>
                    <span>~</span>
                    <div class="col-sm-4.5">
                        <input type="number" class="form-control" id="price_to" name="price_to">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="manufacturing_data" class="col-sm-2 col-form-label">Ngày sản xuất</label>
                    <div class="col-sm-4.5">
                        <input type="date" class="form-control" id="manufacturing_data_from" name="manufacturing_data_from">
                    </div>
                    <span>~</span>
                    <div class="col-sm-4.5">
                        <input type="date" class="form-control" id="manufacturing_data_to" name="manufacturing_data_to">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">Thương hiệu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand" name="brand">
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="product.search()">Tìm</button>
                </div>
            </form>
        </div>
        <div style="display: none" id="divSearch">
            <table id="tableSearch" class="display" style="width: 100%; font-size: 14px">
                <thead>
                    <th class="text-center">STT</th>
                    <th class="text-center">Tên phụ tùng</th>
                    <th class="text-center">Loại phụ tùng</th>
                    <th class="text-center">Mô tả</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Thương hiệu</th>
                    <th class="text-center">Ngày sản xuất</th>
                </thead>
            </table>
        </div>
    </div><!-- /.container-fluid -->
@endsection
