@extends('layouts.Admin')

@section('content')
<div id="user">
    <h1 class="display-4 text-center">Danh sách người dùng</h1>
    <table class="table  table-hover text-md-center" id="tableUser">
        <thead class="thead-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên đăng nhập</th>
                <th scope="col">Email</th>
                <th scope="col">Quyền</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div id="banner">
    <h1 class="display-4 mb-2 text-center">Thông tin quảng cáo</h1>
    <div class="mt3">
        <button class="btn btn-warning mb-3" onclick="banner.formModal()">Thêm mới</button>
        <table class="table  table-hover text-md-center" id="tableBanner">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Đối tác</th>
                    <th scope="col">NV đăng</th>
                    <th scope="col">Ngày hết hạn</th>
                    <th scope="col">Sửa / Xóa</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="d-flex flex-wrap mt-2" id="showBanner">
        <div class="position-relative border">
            <p class="display-4 text-center">Thêm</p>
            <a href="javascript:;" title="Thêm"
                class="text-center rounded-circle button-banner position-absolute border" type="button">
                <i class="fas fa-plus"></i>
            </a>
        </div>

    </div>
</div>
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
    {{-- <div>
        <form id="formDataPost">
            <div class="form-group form-row">
                <div class="col">
                    <label for="titlePost">Tiêu đề bài viết :</label>
                    <textarea class="form-control" id="titlePost" rows="3"></textarea>
                </div>
                <div class="col">
                </div>
            </div>
            <div class="form-group">
                <label for="texarea">Nội dung bài viết : </label>
                <textarea class="form-control editor1" id="editor1" rows="10"></textarea>
            </div>
            <input type="hidden" name="id" id="postId">
            <input type="hidden" name="user_id" id="userId" value="{{ Auth::user()->id }}">
        </form>
    </div> --}}
</div>
<!-- Modal banner-->
<div class="modal fade" id="editAddbanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm quảng cáo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-show">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btnSave" onclick="banner.save()">Lưu</button>
            </div>
        </div>
    </div>
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
                                <textarea class="form-control" id="titlePost" rows="3"></textarea>
                            </div>
                            <div class="col d-flex">
                                <img src="" class="img-thumbnail" alt="" id="coverImage">
                                <input class="mt-2 ml-2" type="file" accept="image/*" class="form-control-file" name="imageUpload" id="imageUpload" onchange="post.showCoverImage(this)">
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

@push('dataTables-js')
<script>
//  jquery ajax user dashboard
    var user = user || {};

    user.getUsers = function(){
    
        $.ajax({
            method: "GET",
            dataType: "json",
            url: '{{ route("get.users") }}',
            success: function (data){
                console.log(data);
                $('#tableUser tbody').empty();
                
                $.each(data, function (i, item) {
                    
                    let power = (item.role != 0) ? '<i class="fas fa-crown text-warning"></i>':'<i class="fas fa-crown text-dark"></i>';
                    let titleVip = (item.role != 0) ? 'Xóa VIP':'Cấp VIP';
                    let lock = (item.locked != 0)?'<i class="fas fa-lock"></i>':'<i class="fas fa-lock-open"></i>';
                    let titleLock = (item.locked != 0)? 'Mở khóa tài khoản' : 'Khóa tài khoản';

                    $('#tableUser tbody').append(`                       
                    <tr onclick="user.showInfoUser(${item.id})">
                        <td scope="row">${i+1}</td>
                        <td><img src="${item.avatar}"></td>
                        <td>${item.name}</td>                            
                        <td>${item.email}</td>                            
                        <td>
                            <a href="javascript:;" title="${titleVip}" onclick="user.power(${item.id}, ${item.role})">${power}</a>
                        </td>
                        <td>
                            <a href="javascript:;"  title="${titleLock}" onclick="user.lockUser(${item.id}, ${item.locked})">${lock}</a>
                        </td>
                    </tr>                                            
                    `);
                    
                });

                $('#tableUser').DataTable();
                
            }
        });
    }

    user.lockUser =function(userId, locked){
    
        $.ajax({
            method: "PATCH",
            dataType: "json",
            url: '{{ route("lock.user") }}',
            data: {
                id: userId,
                locked: locked,
            },
            success: function (data){
                user.getUsers();
                toastr["success"]("Thay đổi thành công !");
            }
        });
    }

    user.power = function(userId, role){
        $.ajax({
            method: "PATCH",
            dataType: "json",
            url: '{{ route("power.user") }}',
            data: {
                id: userId,
                role: role,
            },
            success: function (data){
                user.getUsers();
                toastr["success"]("Thay đổi thành công !");
            }
        });
    }

    user.showInfoUser = function(userId){       
        $.ajax({
        method: "GET",
        dataType: "json",
        url: '{{ route("show.user") }}',
        data: {
            id: userId,
        },
        success: function (data){
            let color = (data[0].role == 1)?'text-warning':'text-dark';
            let power = (data[0].role == 1)?'VIP':'Thường';
            $('.modal-show').empty();
            $('.modal-show').append(`
            <div class="card position-relative m-auto border-0" style="width: 29rem;">
                <img class="card-img-top m-auto" src="${data[0].avatar}" alt="Ảnh đại diện">
                
            <div class="card-body">
                <h5 class="card-title">Tên : ${data[0].fullName}</h5>
                <p class="card-text">Tên đăng nhập : ${data[0].name}</p>
                <p class="card-text">Email : ${data[0].email}</p>
                <p class="card-text">Số điện thoại : ${data[0].phone}</p>
                <p class="card-text">Địa chỉ : ${data[0].address}</p>
                <p class="card-text">Giới tính : ${data[0].gender}</p>
                <p class="card-text">Tài khoản : ${power} <i class="fas fa-crown position-absolute ml-2 ${color}"></i></p>
            </div>                                              
            </div>    
            `);
            $('#exampleModalLongTitle').text('Thông tin cá nhân người dùng :');
            $('.btnSave').hide();
            $('#editAddbanner').modal('show');
        }
        });
    }

    user.show = function(){
        closed();
        $('#user').show();
    }
//    jquery ajax banner dashboard
    var banner = banner || {}; 

   banner.get = function(){
    
        $.ajax({
                method: "GET",
                dataType: "json",
                url: '{{ route("get.banners") }}',
                success: function (data){
                    console.log(data);
                    $('#tableBanner tbody').empty();
                    $('#showBanner').empty();
                    $('#showBanner').append(`
                        <div class="position-relative border">
                            <p class="display-4 text-center">Thêm</p>
                            <a href="javascript:;" title="Thêm" class=" text-center rounded-circle button-banner position-absolute border" type="button">
                            <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    `);
                    $.each(data, function (i, item) {
                        if(item.show == 1){
                            $('#showBanner').prepend(`
                            <div class="position-relative">
                                <img src="${item.imageAddress}" alt="" class="mh-100 w-100 img-thumbnail">
                                <a href="javascript:;" title="Thay đổi" class="text-center rounded-circle button-banner position-absolute border" onclick="">
                                    <i class="fas fa-plus text-white"></i>
                                </a>
                            </div>
                            
                        `);
                        }
                        
                        $('#tableBanner tbody').append(`                       
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td><img src="${item.imageAddress}" class=""></td>
                            <td>${item.title}</td>
                            <td>${item.partner}</td>                            
                            <td>${item.name}</td>
                            <td>${item.expirationDate}</td>
                            <td>
                                <a href="javascript:;"  title="Sửa" onclick="banner.store(${item.id})" class="btn"><i class="fas fa-pencil-alt text-success"></i></a>
                                <a href="javascript:;"  title="Xóa" onclick="banner.delete(${item.id})" class="btn"><i class="far fa-trash-alt  text-danger"></i></a>
                            </td>
                        </tr>                       
                        `);
                        
                    });
                    $('#tableBanner').DataTable();
                   
                }
        });
   }

    banner.show = function(){
        closed();
       $('#banner').show();
   }

   banner.formModal = function(){
        $('.modal-show').empty();
        $('.modal-show').append(`
            <form class="modalForm">
                <div class="form-group">
                <label for="title">Tiêu đề :</label>
                <input type="text" class="form-control" id="titleBanner" placeholder="Nhập tiêu đề ....">
            </div>
            <div class="form-group">
                <img src="https://dean2020.edu.vn/wp-content/uploads/2018/11/Nha6.jpg" class="img-thumbnail w-100" id="image"><br>
                <input class="mt-2" type="file" accept="image/*" class="form-control-file" name="fileUpload" id="fileUpload" onchange="banner.showImage(this)">
            </div>
            <div class="form-group">
                <label for="namePartner">Tên đối tác :</label>
                <input type="text" class="form-control" name="namePartner" id="namePartner" placeholder="Tên đối tác...">
            </div>
            <div class="form-group">
                <label for="date-input">Thời gian hết hạn :</label>
                <input type="date" class="form-control" name="date-input" id="date-input" >
            </div>     
            <div class="form-group">
                <div class="form-check">
                <input class="form-check-show" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Show lên trang chính.
                </label>
                </div>
            </div>
            <input type="hidden" value="0" id="hidden">
            <input type="hidden" value="{{ Auth::user()->id }}" id="user_id">
            </form>
        `);

        $('#editAddbanner').modal('show');
        $('.btnSave').show();
   }

    banner.getDetail = function(bannerId){
        $.ajax({
                method: "GET",
                dataType: "json",
                url: '{{ route("banner.detail") }}',
                data: {
                    id: bannerId,
                },
                success: function (data){
                    console.log(data);
                    banner.formModal();
                       if(data[0].show == 1){
                            $('#gridCheck').prop('checked', true);
                        }
                        $('#titleBanner').val(data[0].title);
                        $('#image').attr('src', data[0].imageAddress);
                        $('#namePartner').val(data[0].partner);
                        $('#date-input').val(data[0].expirationDate);
                        $('#hidden').val(data[0].id);
                        $('#exampleModalLongTitle').text('Cập nhật thông tin')
                }
        });
    }

   banner.store = function(id){
    banner.getDetail(id);
   }

   banner.showImage = function(data){
       if(data.files[0] != null){
            let image = data.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
            $("#image").attr("src",reader.result);
            }
            reader.readAsDataURL(image);
       }     
   }

   banner.save = function(){
       $('#editAddbanner').modal('hide');
    let show;
       if($('#gridCheck:checked').val() == 'on'){
         show = 1;
       }else{
         show = 0;
       }
    if($('#hidden').val() != 0){
        $.ajax({
            method: "PUT",
            dataType: "json",
            url: '{{ route("banner.update") }}',
            data: {
                id: $('#hidden').val(),
                title: $('#titleBanner').val(),
                imageAddress: $('#image').attr('src'),
                partner: $('#namePartner').val(),
                expirationDate: $('#date-input').val(),
                show: show,
                user_id: $('#user_id').val(),
            },
            success: function (data){
                banner.get();
                toastr["success"]("Thay đổi thành công !");
            }
        });
    }else{
        $.ajax({
            method: "POST",
            dataType: "json",
            url: '{{ route("banner.create") }}',
            data: {
                id: $('#hidden').val(),
                title: $('#titleBanner').val(),
                imageAddress: $('#image').attr('src'),
                partner: $('#namePartner').val(),
                expirationDate: $('#date-input').val(),
                show: show,
                user_id: $('#user_id').val(),
            },
            success: function (data){
                banner.get();
                toastr["success"]("Thay đổi thành công !");
            }
        });
    }
          
   }

    function closed(){
        $('#user').hide();
        $('#banner').hide();
        $('#post').hide();
    }
    banner.formValidate = function(){
        $(".modalForm").validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "fileUpload": {
                    required: true,
                },
                "namePartner": {
                    required: true
                },
                "date-input": {
                    required: true
                }
            },
            messages: {
                "fileUpload": {
                    required: "Không được để trống"
                },
                "namePartner": {
                    required: "Không được để trống"
                },
                "date-input": {
                    required: "Không được để trống"
             }
            }
        });
    }

    banner.delete = function(id){
        bootbox.confirm({
            message: "Bạn muốn xóa ?",
            buttons: {
            confirm: {
                abel: 'CÓ',
                className: 'btn-success'
            },
            cancel: {
                label: 'KhÔNG',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
        if(result){
                $.ajax({
                        url:'{{ route("banner.destroy") }}',
                         method: "DELETE",
                        dataType:"json",
                        data:{
                            id: id,
                        },
                        success : function(){
                            banner.get();
                            toastr["warning"]("Đã xóa!");
                        }
                    })
                }
        
            }
        });

    }

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
                                <a href="javascript:;"  title="Sửa" onclick="post.store(${item.id})" class="btn"><i class="fas fa-pencil-alt text-success"></i></a>
                                <a href="javascript:;"  title="Xóa" onclick="post.delete(${item.id})" class="btn"><i class="far fa-trash-alt text-danger"></i></a>
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


    $(document).ready( function () {
        user.getUsers();
        banner.get();
        post.get();
        closed();
        $('#content-dashboard').css('display', 'block');
        $('[data-toggle="tooltip"]').tooltip();
        
    } );
</script>
@endpush