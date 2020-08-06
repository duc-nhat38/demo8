@extends('layouts.Admin')

@section('content')
<div class="user">
    <table class="table  table-hover text-md-center" id="tableUser">
        <thead class="thead-dark">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Họ & Tên</th>
                <th scope="col">Tên đăng nhập</th>
                <th scope="col">Email</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Quyền</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="banner">
    <div>
        <table class="table  table-hover text-md-center" id="tableBanner">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Đối tác</th>
                    <th scope="col">NV đăng</th>
                    <th scope="col">Sửa / Xóa</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="d-flex flex-wrap mt-3 w-100" id="showBanner">
        <div class="w-50 h-25">
            <button class="rounded-circle" type="button">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@push('dataTables-js')
<script>
    var user = user || {};


    user.getUsers = function(){
        
            $.ajax({
                method: "GET",
                dataType: "json",
                url: '{{ route("get.users") }}',
                success: function (data){
                    
                    $('#tableUser tbody').empty();
                    
                    $.each(data, function (i, item) {
                        
                        let power = (item.role == 2) ? '<i class="fas fa-crown crown"></i>': '<i class="fas fa-crown no-crown"></i>';
                        let titleVip = (item.role == 2) ? 'Xóa VIP':'Cấp VIP';
                        let lock = (item.locked != 0)?'<i class="fas fa-lock"></i>':'<i class="fas fa-lock-open"></i>';
                        let titleLock = (item.locked != 0)? 'Mở khóa tài khoản' : 'Khóa tài khoản';

                        $('#tableUser tbody').append(`                       
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td><img src="${item.avatar}"></td>
                            <td>${item.fullName}</td>
                            <td>${item.name}</td>                            
                            <td>${item.email}</td>
                            <td>${item.phone}</td>

                            <td>
                                <a href="javascript:;" title="${titleVip}">${power}</a>
                            </td>
                            <td>
                                <a href="javascript:;"  title="${titleLock}" onclick="user.lockUser(${item.id})">${lock}</a>
                            </td>
                        </tr>                       
                        `);
                        
                    });

                    $('#tableUser').DataTable();
                    
                }
            });
    }
    
    user.lockUser =function(userId){
       console.log(userId);
       $.ajax({
                method: "PATCH",
                dataType: "json",
                url: `{{ route("lock.user") }}`,
                data: {
                    id: userId,
                },
                success: function (data){
                    
                }
       });
   }


    var banner = banner || {}; 

   banner.get = function(){
    
    $.ajax({
                method: "GET",
                dataType: "json",
                url: '{{ route("get.banners") }}',
                success: function (data){
                    console.log(data);
                    $('#tableBanner tbody').empty();
                    
                    $.each(data, function (i, item) {
                        if(item.show == 1){
                            $('#showBanner').prepend(`
                            <div class="mw-50 mh-25">
                                <img src="${item.imageAddress}" alt="" class="mw-25 mh-25 img-thumbnail">
                            </div>
                            
                        `);
                        }
                        
                        $('#tableBanner tbody').append(`                       
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td><img src="${item.imageAddress}" class="w-40 h-25"></td>
                            <td>${item.title}</td>
                            <td>${item.renter}</td>                            
                            <td>${item.name}</td>
                            <td>
                                <a href="javascript:;"  title="Sửa" onclick="banner.update()" class="btn"><i class="fas fa-tools"></i></a>
                                <a href="javascript:;"  title="Xóa" onclick="user.delete()" class="btn"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>                       
                        `);
                        
                    });
                    $('#tableBanner').DataTable();
                   
                }
    });
   }

   
    $(document).ready( function () {
        // $('.banner').hide();
        user.getUsers();
        banner.get();
            
    } );
</script>
@endpush