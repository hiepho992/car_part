var category = category || {};

category.show = function () {
    $('#categoryTb').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {
            "url": "http://127.0.0.1:8000/admin/category/getList",
            "type": "GET"
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'action' }
        ],
    });
}

category.create = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "http://127.0.0.1:8000/admin/category/create",
        method: "POST",
        dataType: "json",
        data: new FormData($('#categoryForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            category.show();
            $('#editAddcategoryModal').modal('hide');
            alertify.success('Thêm mới thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $.each(errors, function (i, v) {
                if (i == "name") {
                    $('#errorName').append(v[0]);
                }
            });
        }
    })
}

category.update = function () {
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `http://127.0.0.1:8000/admin/category/update/${id}`,
        method: "POST",
        dataType: "json",
        data: new FormData($('#categoryForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            category.show();
            $('#editAddcategoryModal').modal('hide');
            alertify.success('Chỉnh sửa thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $.each(errors, function (i, v) {
                console.log(i);
                if (i == "name") {
                    $('#errorName').append(v[0]);
                }
            });
        }

    })
}

category.delete = function (id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    alertify.confirm("Xóa hãng","Bạn chắc chắn muốn xóa ?",
        function () {
            $.ajax({
                url: `http://127.0.0.1:8000/admin/category/destroy/${id}`,
                method: "DELETE",
                dataType: "json",
                success: function () {
                    alertify.success('Xóa thành công');
                    category.show();
                }
            });
        },
        function () {
            alertify.error('Cancel');
        });
}

category.openModal = function (element) {
    if (element.innerHTML == "Thêm mới") {
        $('#categoryTitle').html('Thêm mới loại phụ tùng');
        $('#save-change').html('Save');
        $('#save-change').attr('onclick', 'category.create()');
    } else {
        $('#categoryTitle').html('Sửa tên loại phụ tùng');
        $('#save-change').html('Chỉnh sửa');
        $('#save-change').attr('onclick', 'category.update()');
    }
    category.reset();
    $('#editAddcategoryModal').modal('show');

}


category.edit = function (id) {
    $.ajax({
        url: `http://127.0.0.1:8000/admin/category/edit/${id}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#id').val(data.id);
            $('#name').val(data.name);
        }
    })
}

category.reset = function () {
    $('#name').val('');
    $('#errorName').empty();
}

$(document).ready(function () {
    category.show();
});

// category.search = function(){
//     $('#divSearch').show();
//     $('#tableSearch').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "destroy": true,

//         "ajax": {
//             "url": 'http://127.0.0.1:8000/admin/category/getDataSearch',
//             "type": "POST",
//             "data": {
//                 'name': $('#name').val(),
//                 'category_id': $('#category_id').val(),
//                 'manufacturing_data_from': $('#manufacturing_data_from').val(),
//                 'manufacturing_data_to': $('#manufacturing_data_to').val(),
//                 'description': $('#description').val(),
//                 'brand': $('#brand').val(),
//                 'price_form': $('#price_form').val(),
//                 'price_to': $('#price_to').val(),
//             },
//             "headers":{
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//         },
//         columns: [
//             { data: 'id' },
//             { data: 'name' },
//             { data: 'category' },
//             { data: 'description' },
//             {
//                 data: 'price',
//                 render: $.fn.dataTable.render.number( ',', '.')
//             },
//             { data: 'brand' },
//             { data: 'manufacturing_data' }
//         ],
//     });
// }




