CKEDITOR.replace('editor1');
var post = post || {};

post.get = function () {
    $.ajax({
        method: 'GET',
        url: '/api/get-posts',
        dataType: 'json',
        success: function (data) {
            if ($.fn.DataTable.isDataTable('#tablePost')) {
                $('#tablePost').DataTable().destroy();
            }
            $('#tablePost tbody').empty();
            $.each(data, function (i, item) {
                let update = 'Chưa cập nhật';

                $('#tablePost tbody').append(`
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td data-toggle="tooltip" title="${item.title}">${((item.title).length > 20) ?(item.title).substr(0,20)+'...':(item.title)}</td>
                            <td>${item.day_create}</td>
                            <td>${update}</td>
                            <td>${item.view}</td>
                            <td>${item.name}</td>
                            <td>
                                <a href="javascript:;"  title="Sửa" onclick="post.store(${item.id})" class="btn"><i class="fas fa-pencil-alt text-success fa-lg"></i></a>
                                <a href="javascript:;"  title="Xóa" onclick="post.delete(${item.id})" class="btn"><i class="far fa-trash-alt text-danger fa-lg"></i></a>
                            </td>
                        </tr>
                    `);

            });

            $('#tablePost').DataTable();
        }
    });
}

post.getDetail = function (id) {
    $.ajax({
        method: "GET",
        dataType: "json",
        url: '/api/get-post-detail',
        data: {
            id: id,
        },
        success: function (data) {
            $('#titlePost').val(data.title);
            $('#coverImage').attr('src', `/uploads/images/posts/${data.coverImage}`);
            CKEDITOR.instances.editor1.setData(data.content);
            $('#postId').val(data.id);
        }
    });
}

post.store = function (id) {
    post.getDetail(id);
    $('#editPost').modal('show');
}

post.show = function () {
    closed();
    $('#post').show();
}

post.save = function () {
    var fomrPost = new FormData($('#formDataPost')[0]);
    fomrPost.append('content', CKEDITOR.instances['editor1'].getData());
    if ($('#formDataPost').valid()) {
        if ($('#postId').val() != 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '/api//post-update',
                dataType: 'json',
                data: fomrPost,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#editPost').modal('hide');
                    post.get();
                    toastr["success"]("Thay đổi thành công !");
                }
            });
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                url: '/api/post-create',
                dataType: 'json',
                data: fomrPost,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#editPost').modal('hide');
                    post.get();
                    toastr["success"]("Thêm thành công !");
                }
            });
        }
    }
}

post.delete = function (id) {
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/api/post-destroy',
                    method: "DELETE",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function () {
                        post.get();
                        toastr["warning"]("Đã xóa!");
                    }
                })
            }

        }
    });
}

post.showCoverImage = function (data) {
    if (data.files[0] != null) {
        let image = data.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            $("#coverImage").attr("src", reader.result);
        }
        reader.readAsDataURL(image);
    }
}


post.dropDown = function () {
    $('#titlePost').val('');
    $('#coverImage').attr('src', '');
    $('#imageUpload').val('');
    CKEDITOR.instances.editor1.setData('');
    $('#postId').val(0);
    $('label.error').hide();
    $('#editPost').modal('show');
}
$(document).ready(function () {

    post.get();
    $('[data-toggle="tooltip"]').tooltip();
});
