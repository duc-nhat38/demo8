var business = business || {};
business.validate = function () {
    if ($('#selectBusiness').val() == null || $('#selectAddress').val() == null) {
        toastr.options = {
            "positionClass": "toast-top-center",
        }
        if ($('#selectBusiness').val() == null) {

            toastr["warning"]("Vui lòng chọn thể loại!")
        } else {
            if ($('#selectAddress').val() == null) {

                toastr["warning"]("Vui lòng chọn địa điểm!")
            }
        }

        return false;
    }
}
business.searchBusiness = function () {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-business",
        dataType: "json",
        success: function (data) {
            $('#selectBusiness').empty();
            $('#selectBusiness').append(`
                    <option selected disabled>Thể loại</option>
                `);
            $.each(data, function (i, value) {
                $('#selectBusiness').append(`
                        <option value="${value.id}">${value.typeName}</option>
                    `);

            });

        }
    });
}

// 
var address = address || {};
address.searchAddress = function () {
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-address",
        dataType: "json",
        success: function (data) {
            $('#selectAddress').empty();
            $('#selectAddress').append(`
                <option selected disabled>Tỉnh / Thành</option>
                `);
            $.each(data, function (i, value) {
                $('#selectAddress').append(`
                        <option value="${value.id}">${value.address}</option>
                `);

            });

        }
    });
}

address.select = function (data) {
    let id = data.value;
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/api/get-address-detail",
        data: {
            id: id,
        },
        dataType: "json",
        success: function (data) {
            $('#selectDistrict').empty();
            $('#selectDistrict').append(`
                    <option selected disabled >Quận / Huyện</option>
                `);
            $.each(data.address_details, function (i, value) {
                $('#selectDistrict').append(`
                        <option value="${value.id}"> ${value.district}</option>
                    `);
            });
        }
    });

}

$(document).ready(function () {
    business.searchBusiness();
    address.searchAddress();
    $('#selectArea').select2();
    $('#selectBusiness').select2();
    $('#selectAddress').select2();
    $('#selectDistrict').select2();

});
