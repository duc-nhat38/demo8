@extends('layouts.Admin')

@section('content')
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
{{-- modal --}}
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
@endsection

@push('bannerManagerment-js')
<script>
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
                                <a href="javascript:;"  title="Sửa" onclick="banner.store(${item.id})" class="btn"><i class="fas fa-pencil-alt text-success fa-lg"></i></a>
                                <a href="javascript:;"  title="Xóa" onclick="banner.delete(${item.id})" class="btn"><i class="far fa-trash-alt  text-danger fa-lg"></i></a>
                            </td>
                        </tr>                       
                        `);
                        
                    });
                    $('#tableBanner').DataTable();
                   
                }
        });
   }

//     banner.show = function(){
//         closed();
//        $('#banner').show();
//    }

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
    $(document).ready( function () {
    
    banner.get();

    } );
</script>
@endpush