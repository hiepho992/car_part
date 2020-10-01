var classCar = classCar || {};

classCar.show = function () {
    $('#classCarTb').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {
            "url": "http://127.0.0.1:8000/admin/classCar/getList",
            "type": "GET"
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'maker' },
            { data: 'action' }
        ],
    });
}

classCar.create = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "http://127.0.0.1:8000/admin/classCar/create",
        method: "POST",
        dataType: "json",
        data: new FormData($('#classCarForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            classCar.show();
            $('#editAddclassCarModal').modal('hide');
            alertify.success('Thêm mới thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $('#errorMaker').empty();
            $.each(errors, function (i, v) {
                if (i == "name") {
                    $('#errorName').append(v[0]);
                }else{
                    $('#errorMaker').append(v[0]);
                }
            });
        }
    })
}

classCar.update = function () {
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `http://127.0.0.1:8000/admin/classCar/update/${id}`,
        method: "POST",
        dataType: "json",
        data: new FormData($('#classCarForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            classCar.show();
            $('#editAddclassCarModal').modal('hide');
            alertify.success('Chỉnh sửa thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $('#errorMaker').empty();
            $.each(errors, function (i, v) {
                console.log(i);
                if (i == "name") {
                    $('#errorName').append(v[0]);
                }else{
                    $('#errorMaker').append(v[0]);
                }
            });
        }

    })
}

classCar.delete = function (id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    alertify.confirm("Xóa loại xe","Bạn chắc chắn muốn xóa ?",
        function () {
            $.ajax({
                url: `http://127.0.0.1:8000/admin/classCar/destroy/${id}`,
                method: "DELETE",
                dataType: "json",
                success: function () {
                    alertify.success('Xóa thành công');
                    classCar.show();
                }
            });
        },
        function () {
            alertify.error('Cancel');
        });
}

classCar.openModal = function (element) {
    if (element.innerHTML == "Thêm mới") {
        $('#classCarTitle').html('Thêm mới loại xe');
        $('#save-change').html('Save');
        $('#save-change').attr('onclick', 'classCar.create()');
    } else {
        $('#classCarTitle').html('Sửa tên loại xe');
        $('#save-change').html('Chỉnh sửa');
        $('#save-change').attr('onclick', 'classCar.update()');
    }
    classCar.reset();
    $('#editAddclassCarModal').modal('show');

}


classCar.edit = function (id) {
    $.ajax({
        url: `http://127.0.0.1:8000/admin/classCar/edit/${id}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#id').val(data[0].id);
            $('#name').val(data[0].name);
            $('#maker_id').val(data[1]);
        }
    })
}

classCar.reset = function () {
    $('#name').val('');
    $('#errorName').empty();
    $('#maker_id').val('');
    $('#errorMaker').empty();
}

$(document).ready(function () {
    classCar.show();
});

// classCar.search = function(){
//     $('#divSearch').show();
//     $('#tableSearch').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "destroy": true,

//         "ajax": {
//             "url": 'http://127.0.0.1:8000/admin/classCar/getDataSearch',
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




