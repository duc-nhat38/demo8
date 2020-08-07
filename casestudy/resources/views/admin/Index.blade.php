@extends('layouts.Admin')

@section('content')
<div class="dataSynthesis">
    <div id="my-chart" style="min-width: 1140px; height: 500px; margin: 15px auto 0;"></div>

</div>


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
        <button class="btn btn-warning mb-3" onclick="banner.formCreate()">Thêm mới</button>
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
            <button class="rounded-circle button-banner position-absolute border" type="button">
                <i class="fas fa-plus"></i>
            </button>
        </div>

    </div>
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
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btnSave">Lưu</button>
            </div>
        </div>
    </div>
</div>

{{-- body modal --}}

    
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
                        
                        let power = (item.role != 0) ? '<i class="fas fa-crown crown size-crown"></i>':'<i class="fas fa-crown no-crown size-crown"></i>';
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
                url: `{{ route("lock.user") }}`,
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
                url: `{{ route("power.user") }}`,
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
                let color = (data[0].role == 1)?'crown':'no-crown';
                let power = (data[0].role == 1)?'VIP':'Thường';
                $('.modal-body').empty();
                $('.modal-body').append(`
                <div class="card position-relative m-auto border-0" style="width: 29rem;">
                    <img class="card-img-top m-auto" src="${data[0].avatar}" alt="Ảnh đại diện">
                    
                <div class="card-body">
                    <h5 class="card-title">Tên : ${data[0].fullName}</h5>
                    <p class="card-text">Tên đăng nhập : ${data[0].name}</p>
                    <p class="card-text">Email : ${data[0].email}</p>
                    <p class="card-text">Số điện thoại : ${data[0].phone}</p>
                    <p class="card-text">Địa chỉ : ${data[0].address}</p>
                    <p class="card-text">Giới tính : ${data[0].gender}</p>
                    <p class="card-text">Tài khoản : ${power} <i class="fas fa-crown position-absolute ml-2 size-crown ${color}"></i></p>
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
                    
                    $.each(data, function (i, item) {
                        if(item.show == 1){
                            $('#showBanner').prepend(`
                            <div class="position-relative">
                                <img src="${item.imageAddress}" alt="" class="mh-100 w-100 img-thumbnail">
                                <button class="rounded-circle button-banner position-absolute border" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
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

    banner.show = function(){
        closed();
       $('#banner').show();
   }

   banner.formCreate = function(){
        $('.modal-body').empty();
        
   }

    function closed(){
        $('#user').hide();
        $('#banner').hide();
    }
// Data synthesis
 dataSynthesis.statistics = function(){
     
 }

// tesst

dataSynthesis.drawChart = function(chartID, cate, data, title, unit, type = 'line') {
    Highcharts.chart(chartID, {
        chart: {
            type: type
        },
        title: {
            text: title
        },
        xAxis: {
            categories: cate
        },
        yAxis: {
            title: {
                text: unit
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }, column: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: data
    });
}

// tesst

    $(document).ready( function () {
        user.getUsers();
        banner.get();
        closed();
        $('#content-dashboard').css('display', 'block');
        
    } );
</script>
@endpush
    
  