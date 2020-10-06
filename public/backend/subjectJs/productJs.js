var product = product || {};

product.show = function () {
    $('#productTb').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {
            "url": "http://quanlyphutung.herokuapp.com/admin/product/getList",
            "type": "GET"
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            // { data: 'description' },
            {
                data: 'price',
                render: $.fn.dataTable.render.number(',', '.')
            },
            { data: 'brand' },
            { data: 'manufacturing_data' },
            { data: 'action' }
        ],
    });
}

product.create = function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "http://quanlyphutung.herokuapp.com/admin/product/create",
        method: "POST",
        dataType: "json",
        data: new FormData($('#productForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            product.show();
            $('#editAddproductModal').modal('hide');
            alertify.success('Thêm mới thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $('#errorCategory_id').empty();
            $('#errorCar_id').empty();
            $('#errorDescription').empty();
            $('#errorPrice').empty();
            $('#errorBrand').empty();
            $('#errorManufacturing').empty();
            $.each(errors, function (i, v) {
                if (i == "name") {
                    $('#errorName').append(v[0]);
                } else if (i == "category_id") {
                    $('#errorCategory_id').append(v[0]);
                } else if (i == "car_id") {
                    $('#errorCar_id').append(v[0]);
                } else if (i == "description") {
                    $('#errorDescription').append(v[0]);
                } else if (i == "price") {
                    $('#errorPrice').append(v[0]);
                } else if (i == "brand") {
                    $('#errorBrand').append(v[0]);
                } else {
                    $('#errorManufacturing').append(v[0]);
                }
            });
        }
    })
}

product.update = function () {
    var id = $('#id').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/product/update/${id}`,
        method: "POST",
        dataType: "json",
        data: new FormData($('#productForm')[0]),
        contentType: false,
        processData: false,
        success: function () {
            product.show();
            $('#editAddproductModal').modal('hide');
            alertify.success('Chỉnh sửa thành công');
        },
        error: function (data) {
            var errors = data.responseJSON.errors;
            $('#errorName').empty();
            $('#errorCategory_id').empty();
            $('#errorCar_id').empty();
            $('#errorDescription').empty();
            $('#errorPrice').empty();
            $('#errorBrand').empty();
            $('#manufacturing_data').empty();
            $.each(errors, function (i, v) {
                if (i == "name") {
                    $('#errorName').append(v[0]);
                } else if (i == "category_id") {
                    $('#errorCategory_id').append(v[0]);
                } else if (i == "car_id") {
                    $('#errorCar_id').append(v[0]);
                } else if (i == "description") {
                    $('#errorDescription').append(v[0]);
                } else if (i == "price") {
                    $('#errorPrice').append(v[0]);
                } else if (i == "brand") {
                    $('#errorBrand').append(v[0]);
                } else {
                    $('#manufacturing_data').append(v[0]);
                }
            });
        }

    })
}

product.delete = function (id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    alertify.confirm("Xóa hãng", "Bạn chắc chắn muốn xóa ?",
        function () {
            $.ajax({
                url: `http://quanlyphutung.herokuapp.com/admin/product/destroy/${id}`,
                method: "DELETE",
                dataType: "json",
                success: function () {
                    alertify.success('Xóa thành công');
                    product.show();
                }
            });
        },
        function () {
            alertify.error('Cancel');
        });
}

product.openModal = function (element) {
    if (element.innerHTML == "Thêm mới") {
        $('#productTitle').html('Thêm mới phụ tùng');
        $('#save-change').html('Save');
        $('#save-change').attr('onclick', 'product.create()');
    } else {
        $('#productTitle').html('Sửa phụ tùng');
        $('#save-change').html('Chỉnh sửa');
        $('#save-change').attr('onclick', 'product.update()');
    }
    product.reset();
    $('#editAddproductModal').modal('show');

}


product.edit = function (id) {
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/product/edit/${id}`,
        method: "GET",
        dataType: "json",
        success: function (data) {
            var id = [];
            for (var i = 0; i < data[1].length; i++) {
                id.push(data[1][i].id);
            }
            var idClass = [];
            for (var i = 0; i < data[2].length; i++) {
                idClass.push(data[2][i].id);
            }
            console.log(idClass);
            var idMaker = [];
            for (var i = 0; i < data[3].length; i++) {
                idMaker.push(data[3][i].id);
            }
            $('#maker_id').val(idMaker).trigger('chosen:updated');
            $('#classcar_id').val(idClass).trigger('chosen:updated');
            $('#car_id').val(id).trigger('chosen:updated');
            $('#id').val(data[0].id);
            $('#name').val(data[0].name);
            $('#category_id').val(data[0].category_id);
            $('#description').val(data[0].description);
            $('#price').val(data[0].price);
            $('#brand').val(data[0].brand);
            $('#manufacturing_data').val(data[0].manufacturing_data);
        }
    })
}

product.reset = function () {
    $('#name').val('');
    $('#category_id').val('');
    $('#car_id').val('').trigger('chosen:updated');
    $('#classcar_id').val('').trigger('chosen:updated');
    $('#maker_id').val('').trigger('chosen:updated');
    $('#description').val('');
    $('#price').val('');
    $('#brand').val('');
    $('#manufacturing_data').val('');
    $('#errorName').empty();
    $('#errorCategory_id').empty();
    $('#errorCar_id').empty();
    $('#errorDescription').empty();
    $('#errorPrice').empty();
    $('#errorBrand').empty();
    $('#errorManufacturing').empty();
};

product.getCar = function(id){
    $('#getCarTb').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {
            "url": `http://quanlyphutung.herokuapp.com/admin/product/getCar/${id}`,
            "type": "GET"
        },
        columns: [
            { data: 'id' },
            { data: 'maker' },
            { data: 'name' }
        ],
    });
}

product.makers = function(){
    var id = $('#maker_id').val();
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/product/makers/${id}`,
        method: "GET",
        dataType: "json",
        success: function(data){
            // console.log(data);
            $('#classcar_id').empty();
            $.each(data, function (i, v) {
                $('#classcar_id').append(
                    `<option value="${v.id}">${v.name}</option>`
                ).trigger('chosen:updated');
            });
        }
    })
}

product.classCar = function(){
    var id = $('#classcar_id').val();
    $.ajax({
        url: `http://quanlyphutung.herokuapp.com/admin/product/classCar/${id}`,
        method: "GET",
        dataType: "json",
        success: function(data){
            console.log(data);
            $('#car_id').empty();
            $.each(data, function (i, v) {
                $('#car_id').append(
                    `<option value="${v.id}">${v.name}</option>`
                ).trigger('chosen:updated');
            });
        }
    })
}

$(document).ready(function () {
    product.show();
    $(".chosen-select").chosen({ width: "100%" });
});

product.search = function () {
    $('#divSearch').show();
    $('#tableSearch').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,

        "ajax": {
            "url": 'http://quanlyphutung.herokuapp.com/admin/product/getDataSearch',
            "type": "POST",
            "data": {
                'name': $('#name').val(),
                'category_id': $('#category_id').val(),
                'manufacturing_data_from': $('#manufacturing_data_from').val(),
                'manufacturing_data_to': $('#manufacturing_data_to').val(),
                'description': $('#description').val(),
                'brand': $('#brand').val(),
                'price_form': $('#price_form').val(),
                'price_to': $('#price_to').val(),
            },
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'category' },
            { data: 'description' },
            {
                data: 'price',
                render: $.fn.dataTable.render.number(',', '.')
            },
            { data: 'brand' },
            { data: 'manufacturing_data' }
        ],
    });
}




