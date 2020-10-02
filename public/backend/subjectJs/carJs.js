var car = car || {};

car.show = function () {
    $('#carTb').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {
            "url": "http://quanlyphutung.herokuapp.com/admin/car/getList",
            "type": "GET"
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'classCar' },
            { data: 'action' }
        ],
    });
}

car.create = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "http://quanlyphutung.herokuapp.com/admin/car/create",
        method: "POST",
        dataType: "json",
        data: new FormData($('#carForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            car.show();
            $('#editAddcarModal').modal('hide');
            alertify.success('Thêm mới thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $('#errorClassCar').empty();
            $.each(errors, function (i, v) {
                if (i == "name") {
                    $('#errorName').append(v[0]);
                }else{
                    $('#errorClassCar').append(v[0]);
                }
            });
        }
    })
}

car.update = function () {
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/car/update/${id}`,
        method: "POST",
        dataType: "json",
        data: new FormData($('#carForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            car.show();
            $('#editAddcarModal').modal('hide');
            alertify.success('Chỉnh sửa thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $('#errorClassCar').empty();
            $.each(errors, function (i, v) {
                if (i == "name") {
                    $('#errorName').append(v[0]);
                }else{
                    $('#errorClassCar').append(v[0]);
                }
            });
        }

    })
}

car.delete = function (id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    alertify.confirm("Xóa tên xe","Bạn chắc chắn muốn xóa ?",
        function () {
            $.ajax({
                url: `http://quanlyphutung.herokuapp.com/admin/car/destroy/${id}`,
                method: "DELETE",
                dataType: "json",
                success: function () {
                    alertify.success('Xóa thành công');
                    car.show();
                }
            });
        },
        function () {
            alertify.error('Cancel');
        });
}

car.openModal = function (element) {
    if (element.innerHTML == "Thêm mới") {
        $('#carTitle').html('Thêm mới xe');
        $('#save-change').html('Save');
        $('#save-change').attr('onclick', 'car.create()');
    } else {
        $('#carTitle').html('Sửa tên xe');
        $('#save-change').html('Chỉnh sửa');
        $('#save-change').attr('onclick', 'car.update()');
    }
    car.reset();
    $('#editAddcarModal').modal('show');

}


car.edit = function (id) {
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/car/edit/${id}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#classcar_id').val(data.classcar_id);
        }
    })
}

car.reset = function () {
    $('#name').val('');
    $('#errorName').empty();
    $('#classcar_id').val('');
    $('#errorClassCar').empty();
}

$(document).ready(function () {
    car.show();
});

// car.search = function(){
//     $('#divSearch').show();
//     $('#tableSearch').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "destroy": true,

//         "ajax": {
//             "url": 'http://quanlyphutung.herokuapp.com/admin/car/getDataSearch',
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




