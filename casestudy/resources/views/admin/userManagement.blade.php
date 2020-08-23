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

<!-- Modal banner-->
<div class="modal fade" id="showInfoUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Thông tin cá nhân người dùng :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body body-show">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('userManagerment-js')
<script>
    //   jquery ajax user dashboard
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
                
                let power = (item.role != 0) ? 'VIP <i class="fas fa-crown text-warning fa-lg"></i>':'Thường <i class="fas fa-crown text-dark fa-lg"></i>';
                let titleVip = (item.role != 0) ? 'Xóa VIP':'Cấp VIP';
                let lock = (item.locked != 0)?'<i class="fas fa-lg fa-lock"></i>':'<i class="fas fa-lg fa-lock-open"></i>';
                let titleLock = (item.locked != 0)? 'Mở khóa tài khoản' : 'Khóa tài khoản';
                $('#tableUser tbody').append(`                       
                <tr>
                    <td scope="row">${i+1}</td>
                    <td><img src="${item.avatar}"></td>
                    <td>${item.name}</td>                            
                    <td>${item.email}</td>                            
                    <td>
                        <a href="javascript:;" title="${titleVip}" class ="text-decoration-none" onclick="user.power(${item.id}, ${item.role})">${power}</a>
                    </td>
                    <td>
                        <a href="javascript:;" title='Xem chi tiết'  onclick="user.showInfoUser(${item.id})"><i class="fas fa-eye text-danger fa-lg"></i></a>
                        <a href="javascript:;"  title="${titleLock}" class="ml-3" onclick="user.lockUser(${item.id}, ${item.locked})">${lock}</a>
                        
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
            let power = (data.role == 1)?'VIP <i class="fas fa-crown position-absolute ml-2 text-warning fa-lg"></i>':'Thường <i class="fas fa-crown position-absolute ml-2 text-dark fa-lg"></i>';
            $('.body-show').empty();
            $('.body-show').append(`
            <div class="card position-relative m-auto border-0" style="width: 29rem;">
                <img class="card-img-top m-auto" src="${data.avatar}" alt="Ảnh đại diện">
            
            <div class="card-body">
                <h5 class="card-title">Tên : ${data.fullName}</h5>
                <p class="card-text">Tên đăng nhập : ${data.name}</p>
                <p class="card-text">Email : ${data.email}</p>
                <p class="card-text">Số điện thoại : ${data.phone}</p>
                <p class="card-text">Địa chỉ : ${data.address}</p>
                <p class="card-text">Giới tính : ${data.gender}</p>
                <p class="card-text">Tài khoản : ${power}
            </div>                                              
            </div>    
            `);
            $('#showInfoUser').modal('show');
        }
        });
    }

    $(document).ready( function () {
        user.getUsers();
        $(".myPopover").popover();
    } );
</script>
@endpush