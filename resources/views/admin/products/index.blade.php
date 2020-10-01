@extends('admin.layouts.dashboard')
@section('title', 'Danh sách phụ tùng')
@section('content')
    @push('head')
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    @endpush
    @push('bottom')
        <script src="{{ asset('backend/subjectJs/productJs.js') }}"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    @endpush
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Danh sách phụ tùng</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div>
            <a href="javascript:;" class="btn btn-primary mb-2 float-right" onclick="product.openModal(this)">Thêm mới</a>
        </div>
        <div>
            <table id="productTb" class="display" style="width: 100%; font-size: 14px">
                <thead>
                    <th class="text-center">ID</th>
                    <th class="text-center">Tên phụ tùng</th>
                    {{-- <th class="text-center">Mô tả</th> --}}
                    <th class="text-center">Giá</th>
                    <th class="text-center">Thương hiệu</th>
                    <th class="text-center">Ngày sản xuất</th>
                    <th class="text-center">Thay đổi</th>
                </thead>

            </table>
        </div>
    </div><!-- /.container-fluid -->
    <!-- Modal -->
    <div class="modal fade" id="editAddproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Tên phụ tùng</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name">
                                <div id="errorName" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-4 col-form-label">Loại phụ tùng</label>
                            <div class="col-sm-8">
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">-</option>
                                    @foreach ($categories as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <div id="errorCategory_id" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="car_id" class="col-sm-4 col-form-label">Xe</label>
                            <div class="col-sm-8">
                                <select name="car_id[]" id="car_id" class="form-control chosen-select" multiple>
                                    @foreach ($cars as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <div id="errorCar_id" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea name="description" id="description" class="form-control"></textarea>
                                <div id="errorDescription" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Giá</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="price" name="price">
                                <div id="errorPrice" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="brand" class="col-sm-4 col-form-label">Thương hiệu</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="brand" name="brand">
                                <div id="errorBrand" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="manufacturing_data" class="col-sm-4 col-form-label">Ngày sản xuất</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="manufacturing_data" name="manufacturing_data">
                                <div id="errorManufacturing" style="color: red; font-size: 12.5px"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-change">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Detail-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="getCarTb">
                        <thead>
                            <th class="text-center">ID</th>
                            <th class="text-center">Tên xe</th>
                        </thead>
                        <tbody class="text-center">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
