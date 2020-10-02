var maker = maker || {};

maker.show = function () {
    $('#makerTb').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {
            "url": "http://quanlyphutung.herokuapp.com/admin/maker/getList",
            "type": "GET"
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'action' }
        ],
    });
}

maker.create = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "http://quanlyphutung.herokuapp.com/admin/maker/create",
        method: "POST",
        dataType: "json",
        data: new FormData($('#makerForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            maker.show();
            $('#editAddmakerModal').modal('hide');
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

maker.update = function () {
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/maker/update/${id}`,
        method: "POST",
        dataType: "json",
        data: new FormData($('#makerForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            maker.show();
            $('#editAddmakerModal').modal('hide');
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

maker.delete = function (id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    alertify.confirm("Xóa hãng","Bạn chắc chắn muốn xóa ?",
        function () {
            $.ajax({
                url: `http://quanlyphutung.herokuapp.com/admin/maker/destroy/${id}`,
                method: "DELETE",
                dataType: "json",
                success: function () {
                    alertify.success('Xóa thành công');
                    maker.show();
                }
            });
        },
        function () {
            alertify.error('Cancel');
        });
}

maker.openModal = function (element) {
    if (element.innerHTML == "Thêm mới") {
        $('#makerTitle').html('Thêm mới hãng xe');
        $('#save-change').html('Save');
        $('#save-change').attr('onclick', 'maker.create()');
    } else {
        $('#makerTitle').html('Sửa tên hãng xe');
        $('#save-change').html('Chỉnh sửa');
        $('#save-change').attr('onclick', 'maker.update()');
    }
    maker.reset();
    $('#editAddmakerModal').modal('show');

}


maker.edit = function (id) {
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/maker/edit/${id}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            $('#id').val(data.id);
            $('#name').val(data.name);
        }
    })
}

maker.reset = function () {
    $('#name').val('');
    $('#errorName').empty();
}

$(document).ready(function () {
    maker.show();
});

// maker.search = function(){
//     $('#divSearch').show();
//     $('#tableSearch').DataTable({
//         "processing": true,
//         "serverSide": true,
//         "destroy": true,

//         "ajax": {
//             "url": 'http://quanlyphutung.herokuapp.com/admin/maker/getDataSearch',
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




