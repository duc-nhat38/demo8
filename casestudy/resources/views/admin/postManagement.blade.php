@extends('layouts.Admin')

@section('content')
<div id="post">
    <h4 class="display-4 mb-2 text-center">Quản lí tin tức</h4>
    <table class="table  table-hover text-md-center" id="tablePost">
        <thead class="thead-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Ngày đăng</th>
                <th scope="col">Ngày cập nhật</th>
                <th scope="col">Lượt xem</th>
                <th scope="col">Người đăng</th>
                <th scope="col">Sửa / Xóa</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div class="w-100 text-center">

    </div>
    <div class="w-100 text-center click-post" onclick="post.dropDown()">
        <span>Đăng bài ngay</span>
        <i class="far fa-edit ml-2"></i>
    </div>
    {{-- modal xl --}}

    <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa bài viết</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body modal-post">
                    <form id="formDataPost">
                        <div class="form-group">
                            <div class="form-group form-row">
                                <div class="col">
                                    <label for="titlePost">Tiêu đề bài viết :</label>
                                    <textarea class="form-control" id="titlePost" rows="6"></textarea>
                                </div>
                                <div class="col">
                                    <label for="">Ảnh bìa : </label>
                                    <div id="divImage">
                                        <img src="" class="img-thumbnail" alt="" id="coverImage"><br>
                                    </div>
                                    <input class="mt-3 ml-2" type="file" accept="image/*" class="form-control-file"
                                        name="imageUpload" id="imageUpload" onchange="post.showCoverImage(this)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="texarea">Nội dung bài viết : </label>
                                <textarea class="form-control editor1" id="editor1" rows="10"></textarea>
                            </div>
                            <input type="hidden" name="id" id="postId">
                            <input type="hidden" name="user_id" id="userId" value="{{ Auth::user()->id }}">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="post.save()">Lưu</button>
                </div>

            </div>
        </div>
    </div>
    @endsection

    @push('postManagerment-js')
    {{-- ck editor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1'); 
    </script>
    <script>
        // jquery ajax Post
        var post = post || {};

        post.get = function(){
            $.ajax ({
                method: 'GET',
                url: '{{ route("get.posts") }}',
                dataType: 'json',
                success: function(data){
                    $('#tablePost tbody').empty();
                    let time = new Date();
                    let month = time.getMonth()+1;
                    let view = 0;
                    let viewsOfTheMonth = 0;
                    let post = 0;
                    let postsOfTheMonth = 0;
                    $.each(data, function(i, item) {
                        let update = 'Chưa cập nhật';
                        if(item.day_update != item.day_create){
                        update = item.day_update;
                    }
                    view += item.view;
                    post += 1;
                
                    viewsOfTheMonth += 
                    $('#tablePost tbody').append(`
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td data-toggle="tooltip" title="${item.title}">${(item.title).substr(0, 20)}...</td>
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

post.getDetail = function(id){
    $.ajax({
            method: "GET",
            dataType: "json",
            url: '{{ route("post.detail") }}',
            data: {
                id: id,
            },
            success: function (data){
                $('#titlePost').val(data.title);
                $('#coverImage').attr('src', data.coverImage);
                CKEDITOR.instances.editor1.setData(data.content);
                $('#postId').val(data.id);                   
            }
    });
}

post.store = function(id){
    post.getDetail(id);
    $('#editPost').modal('show');
}   

post.show = function(){
    closed();
    $('#post').show();
}

post.save = function(){
    if($('#postId').val() != 0){
        $.ajax ({
        method: 'POST',
        url: '{{ route("post.update") }}',
        dataType: 'json',
        data: {
            id: $('#postId').val(),
            title: $('#titlePost').val(),
            content: CKEDITOR.instances.editor1.getData(),
            user_id: $('#userId').val(),
            coverImage: $('#coverImage').attr('src'),
        },
        success: function(data){
            $('#editPost').modal('hide');
            post.get();
            toastr["success"]("Thay đổi thành công !");
        }
        });
    }else{
        $.ajax ({
        method: 'POST',
        url: '{{ route("post.create") }}',
        dataType: 'json',
        data: {
            title: $('#titlePost').val(),
            content: CKEDITOR.instances.editor1.getData(),
            user_id: $('#userId').val(),
            coverImage: $('#coverImage').attr('src'),
        },
        success: function(data){
            $('#editPost').modal('hide');
            post.get();
            toastr["success"]("Thêm thành công !");
        }
    });
}
}

post.delete = function(id){
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
    if(result){
            $.ajax({
                    url:'{{ route("post.destroy") }}',
                     method: "DELETE",
                    dataType:"json",
                    data:{
                        id: id,
                    },
                    success : function(){
                        post.get();
                        toastr["warning"]("Đã xóa!");
                    }
                })
            }
    
        }
    });
}

post.showCoverImage = function(data){
    if(data.files[0] != null){
        let image = data.files[0];
        var reader = new FileReader();
        reader.onloadend = function() {
        $("#coverImage").attr("src",reader.result);
        }
        reader.readAsDataURL(image);
   }
}
post.dropDown = function(){
    $('#titlePost').val('');
    $('#coverImage').attr('src','');
    CKEDITOR.instances.editor1.setData('');
    $('#postId').val(0);
    $('#editPost').modal('show');
}
$(document).ready( function () {
    
    post.get();
    $('[data-toggle="tooltip"]').tooltip();
    } );
    </script>
    @endpush