@extends('admin.layouts.dashboard')
@section('title', 'Danh sách loại phụ tùng')
@section('content')
    @push('head')
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    @endpush
    @push('bottom')
        <script src="{{ asset('backend/subjectJs/categoryJs.js') }}"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    @endpush
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Danh sách loại phụ tùng</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div>
            <a href="javascript:;" class="btn btn-primary mb-2 float-right" onclick="category.openModal(this)">Thêm mới</a>
        </div>
        <div>
            <table id="categoryTb" class="display" style="width: 100%; font-size: 14px">
                <thead>
                    <th class="text-center">ID</th>
                    <th class="text-center">Loại phụ tùng</th>
                    <th class="text-center">Thay đổi</th>
                </thead>
                <tbody class="text-center">

                </tbody>
            </table>
        </div>
    </div><!-- /.container-fluid -->
    <!-- Modal -->
    <div class="modal fade" id="editAddcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Loại phụ tùng</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name">
                                <div id="errorName" style="color: red; font-size: 12.5px"></div>
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
@endsection
