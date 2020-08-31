CKEDITOR.replace('editor3');
var user = user || {};
user.openForm = function (data) {
    $(":input").attr('disabled', false);
    $(":input").removeClass('border-0');
    $(data).hide();
    $('#close').show();
    $('#submit').show();
    $(this).data('fullName', $('#fullName').val());
    $(this).data('name', $('#userName').val());
    $(this).data('email', $('#userEmail').val());
    $(this).data('phone', $('#userPhone').val());
    $(this).data('address', $('#userAddress').val());
}

user.closeForm = function (data) {
    ($(this).data('fullName') == null) ? $('#fullName').val(''): $('#fullName').val($(this).data('fullName'));
    ($(this).data('name') == null) ? $('#userName').val(''): $('#userName').val($(this).data('name'));
    ($(this).data('email') == null) ? $('#userEmail').val(''): $('#userEmail').val($(this).data('email'));
    ($(this).data('phone') == null) ? $('#userPhone').val(''): $('#userPhone').val($(this).data('phone'));
    ($(this).data('address') == null) ? $('#userAddress').val(''): $('#userAddress').val($(this).data('address'));
    $(":input").attr('disabled', true);
    $(":input").addClass('border-0');
    $(data).hide();
    $('#open').show();
    $('#submit').hide();
    $('label.error').hide();
}

user.submitDataEdit = function (data) {
    if ($('#formInputUser').valid()) {
        let id = $('#hiddenUserId').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "PATCH",
            url: "https://timnha.herokuapp.com/api/update-user",
            data: {
                id: id,
                fullName: $('#fullName').val(),
                name: $('#userName').val(),
                email: $('#userEmail').val(),
                phone: $('#userPhone').val(),
                address: $('#userAddress').val(),
            },
            dataType: "json",
            success: function (data) {
                $(":input").attr('disabled', true);
                $('#close').hide();
                $('#open').show();
                $('#submit').hide();
                $('label.error').hide();
                toastr["success"]("Thay đổi thành công!");
            },
            error: function () {
                user.closeForm();
                toastr["warning"]("Thay đổi không thành công!");
            }
        });
    }
}

user.openFormUpdateAvatar = function (element) {
    $('#formUpdateAvatar').attr('hidden', false);
    $(element).hide();
    $(this).data('avatar', $('#avatarUser').attr('src'));
}

user.closeFormUpdateAvatar = function (element) {
    $('#formUpdateAvatar').attr('hidden', true);
    $('#inputAvatar').val('');
    $('#openFormUpdateAvatar').show();
    $('#avatarUser').attr('src', $(this).data('avatar'));
}

user.showAvatar = function (element) {
    let img = element.files[0];
    let reader = new FileReader();
    reader.onloadend = function () {
        $("#avatarUser").attr("src", reader.result);
    }
    reader.readAsDataURL(img);
}

user.updateAvatar = function () {
    if ($('#formUpdateAvatar').valid()) {
        let formData = new FormData($('#formUpdateAvatar')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "https://timnha.herokuapp.com/api/update-avatar-user",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data) {
                    $('#avatar').attr('src', $('#avatarUser').attr('src'));
                    $('#formUpdateAvatar').attr('hidden', true);
                    $('#inputAvatar').val('');
                    $('#openFormUpdateAvatar').show();
                    toastr["success"]("Thay đổi thành công!");
                } else {
                    toastr["warning"]("Thay đổi không thành công!");
                    user.closeFormUpdateAvatar();
                }
            },
            error: function (data) {
                toastr["warning"]("Thay đổi không thành công!");
            }
        });
    }

}
district.changeDistrict = function () {
    $.ajax({
        type: "GET",
        url: "https://timnha.herokuapp.com/api/get-district-detail",
        data: {
            id: $('#inputEditDistrict').val(),
        },
        dataType: "json",
        success: function (data) {
            $('#inputEditAddress').val(data.address.address);
        }
    });
}

function formEditHouseOn(data) {
    $('#formEditPostHouse').modal('show');

    $.ajax({
        type: "GET",
        url: "https://timnha.herokuapp.com/api/get-house-detail",
        data: {
            id: $(data).data('houseid')
        },
        dataType: "json",
        success: function (data) {
            $('#inputEditTitle').val(data.title);
            $(`select#inputEditBusiness option[value='${data.business_type_id}']`).attr('selected', true);
            $(`select#inputEditDistrict option[value='${data.district_id}']`).attr('selected', true);
            $('#inputEditAddress').val(data.address);
            $('#inputEditArea').val(data.area);
            $('#inputEditPrice').val(data.price);
            CKEDITOR.instances.editor3.setData(data.description);
            $('#houseIdHidden').val(data.id);
            $('#showPhotoHouse').empty();
            $.each(data.photos, function (i, value) {
                $('#showPhotoHouse').append(`
                     <div class="position-relative">
                        <img src="https://timnha.herokuapp.com/uploads/images/houses/house-${value.house_id}/${value.photoAddress}" alt="">
                        <a href="javascript:;" onclick="deletePhotoHouse(this)"  data-photoid="${value.id}" class="position-absolute btn btn-link text-white"><i class="fas fa-times"></i></a>
                    </div>
                     
                     `);
            });
        }
    });

}

function formEditHouseOff() {
    $('#inputEditTitle').val('');
    $('select#inputEditBusiness').val('');
    $('select#inputEditDistrict').val('');
    $('#inputEditAddress').val('');
    $('#inputEditArea').val('');
    $('#inputEditPrice').val('');
    $('#inputEditFile').val('');
    CKEDITOR.instances.editor3.setData('');
    $('#showPhotoHouse').empty();
    $('#formEditPostHouse').modal('hide');
}
var indexPhoto = [];

function deletePhotoHouse(data) {

    if ($(data).data('photoid') != 0) {
        indexPhoto.push($(data).data('photoid'));
    }
    $(data).closest('div').remove();
}

function checkValueEditPhoto(data) {
    let countImage = $('#showPhotoHouse').children('div').length;

    let countFile = $("#inputEditFile").prop('files');
    if ((countImage + countFile.length) > 6) {
        $('#inputFileError2').text('Số lượng ảnh vượt quá số lượng');
        $('#inputFileError2').show();
        return false;
    } else {
        $('#inputFileError2').hide();
        if (countFile.length != 0) {
            let img = data.files;
            for (let i = 0; i < img.length; i++) {
                let reader = new FileReader();
                reader.onloadend = function () {
                    $('#showPhotoHouse').append(`
                        <div class="position-relative">
                             <img src="${reader.result}" alt="">
                            <a href="javascript:;" onclick="deletePhotoHouse(this)"  data-photoid="0" class="position-absolute btn btn-link text-white"><i class="fas fa-times"></i></a>
                        </div>
                    `);
                }
                reader.readAsDataURL(img[i]);
            }
        }
    }
    return true;
}

function houseDelete(data) {
    bootbox.confirm({
        size: "small",
        message: "Bạn muốn xóa?",
        callback: function (result) {
            if (result) {
                let id = $(data).data('houseid');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: "https://timnha.herokuapp.com/api/house-delete",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $(`a[data-houseid='${id}']`).closest('div.div-hover').hide();
                            toastr["warning"]("Đã xóa bài đăng!");
                        }
                    }
                });
            }
        }
    });
}

function editHouse() {
    if ($('#showPhotoHouse').children('div').length == 0) {
        $('#inputFileError2').text('Ảnh không được bỏ trống.');
        $('#inputFileError2').show();
    } else {
        if ($('#formEditHouse').valid() && $('#showPhotoHouse').children('div').length <= 6) {
            $('#formEditHouse').append(`
                <input type="text" name="photoIdDelete" value="${indexPhoto}" hidden>
            `);
            $('#formEditHouse').submit();
            formEditHouseOff();
        }
    }
}
$(document).ready(function () {
    // $('.div-hover').children('div .btn-editHouseUser').attr('hidden', true)
    $('.div-hover').hover(function () {
        $(this).children('div.btn-editHouseUser').attr('hidden', true);
        // $(this).children('div.btn-editHouseUser').attr('hidden', true);
    }, function () {
        $(this).children('div.btn-editHouseUser').attr('hidden', true);
    });

});
