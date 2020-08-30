var address = address || {};
address.get = function () {
    $.ajax({
        method: "GET",
        dataType: "json",
        url: 'https://timnha.herokuapp.com/api/get-address',
        success: function (data) {
            if ($.fn.DataTable.isDataTable('#tableAdd')) {
                $('#tableAdd').DataTable().destroy();
            }
            $('#tableAdd tbody').empty();
            $.each(data, function (i, value) {
                $('#tableAdd tbody').append(`
                    <tr>
                      <th scope="row">${i+1}</th>
                      <td >
                        <a href="javascript:;" class="text-decoration-none" onclick=address.detail(${value.id})>${value.address}</a>
                      </td>
                      <td class="d-flex justify-content-around">
                        <a href="javascript:;" title="Sửa" onclick="address.edit(${value.id},'${value.address}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                        <a href="javascript:;" title="Xóa" onclick="address.delete(${value.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                      </td>
                    </tr>
                    `);
            });
            $('#tableAdd').DataTable();
        }
    });
}

address.detail = function (id) {
    $.ajax({
        type: "GET",
        url: "https://timnha.herokuapp.com/api/get-address-detail",
        data: {
            id: id,
        },
        dataType: "json",
        success: function (data) {
            if ($.fn.DataTable.isDataTable('#tableAdd')) {
                $('#tableAdd').DataTable().destroy();
            }
            $('#tableAdd tbody').empty();
            if ($.fn.DataTable.isDataTable('#tableDistrict')) {
                $('#tableDistrict').DataTable().destroy();
            }
            $('#tableDistrict tbody').empty();
            $('#tableAdd tbody').append(`
        <tr>
            <th scope="row">1</th>
            <td >
              <a href="javascript:;" class="text-decoration-none" onclick=address.detail(${data.id})>${data.address}</a>
            </td>
            <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick="address.edit(${data.id},'${data.address}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick="address.delete(${data.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
            </td>
        </tr>
        <tr>
          <td colspan="4" scope="row">
            <a href="javascript:;" onclick="address.showAll()">Tất cả</a>
          </td>
        </tr>
        `);
            $('#tableAdd').addClass('mt-5');
            $.each(data.address_details, function (i, value) {
                $('#tableDistrict tbody').append(`
           <tr>
              <th scope="row">${i+1}</th>
                <td>
                  <a href="javascript:;" class="text-decoration-none" onclick=district.detail(${value.id})>${value.district}</a></td>
                </td>
                <td class="d-flex justify-content-around">
                  <a href="javascript:;" title="Sửa" onclick="district.edit(${value.id},'${value.district}',${value.address_id})"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                  <a href="javascript:;" title="Xóa" onclick="district.delete(${value.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                </td>
            </tr>
           `);
            });
            $('#tableDistrict').DataTable();
        }
    });
}

function closeFormAddress() {
    $('.selectAddressFormCreate').remove();
    $('#editAddress').modal('hide');
    $('#msgError').text('');
    $('#nameEdit').val('');
    $('#idHidden').val('0');
}

address.create = function () {
    $('.districtSave').hide();
    $('.addressSave').show();
    $('.addressForm').text('Thêm tỉnh mới');
    $('#editAddress').modal('show');
}


address.edit = function (id, addressName) {
    $('#nameEdit').val(addressName);
    $('#idHidden').val(id);
    $('.districtSave').hide();
    $('.addressSave').show();
    $('#editAddress').modal('show');
}

address.save = function () {
    if ($('#formAddress').valid()) {
        if ($('#idHidden').val() != 0) {
            $.ajax({
                method: "PUT",
                url: "https://timnha.herokuapp.com/api/address-update",
                data: {
                    id: $('#idHidden').val(),
                    address: $('#nameEdit').val(),
                },
                dataType: "json",
                success: function (data) {
                    closeFormAddress();
                    address.showAll();
                    toastr["success"]("Thay đổi thành công !");
                },
                error: function (data) {
                    $('#msgError').text(data.responseJSON.errors.address);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "https://timnha.herokuapp.com/api/address-create",
                data: {
                    address: $('#nameEdit').val(),
                },
                dataType: "json",
                success: function (data) {
                    closeFormAddress();
                    address.showAll();
                    toastr["success"]("Thêm thành công !");
                },
                error: function (data) {
                    $('#msgError').text(data.responseJSON.errors.address);
                }
            });
        }
    }

}

address.delete = function (id) {
    bootbox.confirm({
        message: "Bạn muốn xóa ?",
        buttons: {
            confirm: {
                abel: 'CÓ',
                className: 'btn-success'
            },
            cancel: {
                label: 'KHÔNG',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "https://timnha.herokuapp.com/api/address-destroy",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        address.showAll();
                        toastr["warning"]("Đã xóa!");
                    }
                });

            }
        }

    });
}
address.showAll = function () {
    address.get();
    district.get();
}

// jquery district
var district = district || {};
district.get = function () {
    $.ajax({
        method: "GET",
        dataType: "json",
        url: 'https://timnha.herokuapp.com/api/get-district',
        success: function (data) {
            if ($.fn.DataTable.isDataTable('#tableDistrict')) {
                $('#tableDistrict').DataTable().destroy();
            }
            $('#tableDistrict tbody').empty();
            $.each(data, function (i, value) {
                $('#tableDistrict tbody').append(`
                     <tr>
                        <th scope="row">${i+1}</th>
                        <td >
                          <a href="javascript:;" class="text-decoration-none" onclick=district.detail(${value.id})>${value.district}</a></td>
                        <td class="d-flex justify-content-around">
                          <a href="javascript:;" title="Sửa" onclick="district.edit(${value.id},'${value.district}',${value.address_id})"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                          <a href="javascript:;" title="Xóa" onclick="district.delete(${value.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                        </td>
                      </tr>
                     `);
            });
            $('#tableDistrict').DataTable();
        }
    });
}

district.detail = function (id) {
    $.ajax({
        type: "GET",
        url: 'https://timnha.herokuapp.com/api/get-district-detail',
        data: {
            id: id,
        },
        dataType: "json",
        success: function (data) {

            if ($.fn.DataTable.isDataTable('#tableAdd')) {
                $('#tableAdd').DataTable().destroy();
            }
            $('#tableAdd tbody').empty();
            if ($.fn.DataTable.isDataTable('#tableDistrict')) {
                $('#tableDistrict').DataTable().destroy();
            }
            $('#tableDistrict tbody').empty();
            $('#tableDistrict tbody').append(`
          <tr>
            <th scope="row">1</th>
          <td >
            <a href="javascript:;" class="text-decoration-none" onclick=district.detail(${data.id})>${data.district}</a></td>
          <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick="district.edit(${data.id},'${data.district}',${data.address_id})"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick="district.delete(${data.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
            </td>
          </tr>
          <tr>
            <td colspan="3" scope="row">
              <a href="javascript:;" class="text-decoration-none" onclick="address.showAll()">Tất cả</a>
            </td>
          </tr>
        `);
            $('#tableAdd tbody').append(`
          <tr>
            <th scope="row">1</th>
            <td >
              <a href="javascript:;" class="text-decoration-none" onclick=address.detail(${data.address.id})>${data.address.address}</a>
            </td>
            <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick="address.edit(${data.address.id},'${data.address.address}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick="address.delete(${data.address.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
            </td>
        </tr>
        <tr>
            <td colspan="3" scope="row">
              <a href="javascript:;" class="text-decoration-none" onclick="address.showAll()">Tất cả</a>
            </td>
          </tr>
        `);
        }
    });
}
district.create = function () {
    $('.addressSave').hide();
    $('.districtSave').show();
    $('#formAddress').append(`
        <div class="form-group selectAddressFormCreate">
            <label for="selectAddressFormCreate">Tỉnh</label>
            <select class="form-control" id="selectAddressFormCreate" data-rule-required="true"
            data-msg-required="Không được để trống">

            </select>
        </div>
    `);
    $.ajax({
        type: "GET",
        url: "https://timnha.herokuapp.com/api/get-address",
        dataType: "json",
        success: function (data) {
            $('#selectAddressFormCreate').empty();
            $.each(data, function (i, value) {
                $('#selectAddressFormCreate').append(`
                    <option value="${value.id}">${value.address}</option>
                `);
            });
            $('#editAddress').modal('show');
        }
    });

}
district.edit = function (id, districtName, address_id) {
    $('#nameEdit').val(districtName);
    $('#idHidden').val(id);
    $('.addressSave').hide();
    $('.districtSave').show();
    $('#formAddress').append(`
        <div class="form-group selectAddressFormCreate">
            <label for="selectAddressFormCreate">Tỉnh</label>
            <select class="form-control" id="selectAddressFormCreate" data-rule-required="true"
            data-msg-required="Không được để trống">

            </select>
        </div>
    `);
    $.ajax({
        type: "GET",
        url: "https://timnha.herokuapp.com/api/get-address",
        dataType: "json",
        success: function (data) {
            $('#selectAddressFormCreate').empty();
            $.each(data, function (i, value) {
                $('#selectAddressFormCreate').append(`
                    <option value="${value.id}">${value.address}</option>
                `);
            });
            $(`#selectAddressFormCreate option[value="${address_id}"]`).attr('selected', true);
            $('#editAddress').modal('show');
        }
    });
}

district.save = function () {
    if ($('#formAddress').valid()) {
        if ($('#idHidden').val() != 0) {
            $.ajax({
                method: "PUT",
                url: "https://timnha.herokuapp.com/api/district-update",
                data: {
                    id: $('#idHidden').val(),
                    district: $('#nameEdit').val(),
                    address_id: $('#selectAddressFormCreate').val(),
                },
                dataType: "json",
                success: function (data) {
                    closeFormAddress();
                    address.showAll();
                    toastr["success"]("Thay đổi thành công !");
                },
                error: function(data) {
                    $('#msgError').text(data.responseJSON.errors.district);
                }
            });
        }else{
            $.ajax({
                type: "POST",
                url: "https://timnha.herokuapp.com/api/district-create",
                data: {
                    id: '0',
                    district: $('#nameEdit').val(),
                    address_id: $('#selectAddressFormCreate').val(),
                },
                dataType: "json",
                success: function (data) {
                    closeFormAddress();
                    address.showAll();
                    toastr["success"]("Thêm thành công !");
                },
                error: function(data) {
                    $('#msgError').text(data.responseJSON.errors.district);
                }
            });
        }
    }
}

district.delete = function (id) {
    bootbox.confirm({
        message: "Bạn muốn xóa ?",
        buttons: {
            confirm: {
                abel: 'CÓ',
                className: 'btn-success'
            },
            cancel: {
                label: 'KHÔNG',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "https://timnha.herokuapp.com/api/district-destroy",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (response) {
                        address.showAll();
                        toastr["warning"]("Đã xóa!");
                    }
                });

            }
        }

    });
}
$(document).ready(function () {
    address.get();
    district.get();
});
