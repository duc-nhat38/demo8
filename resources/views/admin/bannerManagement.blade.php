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
                    <th scope="col">Đang chiếu</th>
                    <th scope="col">Sửa / Xóa</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
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
                    if ($.fn.DataTable.isDataTable('#tableBanner') ) {
                        $('#tableBanner').DataTable().destroy();
                    }
                    $('#tableBanner tbody').empty();
                    
                    $.each(data, function (i, item) {
                        $('#tableBanner tbody').append(`                       
                        <tr>
                            <td scope="row">${i+1}</td>
                            <td><img src="{{ asset('uploads/images/banners/${item.imageAddress}') }}" class=""></td>
                            <td data-toggle="title" title="${item.title}">${(item.title).substr(0,10)}...</td>
                            <td data-toggle="partner" title="${item.partner}">${(item.partner).substr(0, 10)}...</td>                            
                            <td>${item.name}</td>
                            <td>${item.expirationDate}</td>
                            <td>${(item.show == 1) ? '<i class="fas fa-check text-success fa-lg"></i>':'<i class="fas fa-times text-danger fa-lg"></i>'}</td>
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

   banner.formModal = function(){
        $('.modal-show').empty();
        $('.modal-show').append(`
            <form class="modalForm" id="formAdBanner" enctype="multipart/form-data">
                <div class="form-group">
                <label for="title">Tiêu đề :</label>
                <input type="text" class="form-control" id="titleBanner" name='titleBanner' placeholder="Nhập tiêu đề ...." 
                data-rule-required='true' data-msg-required="Tiêu đề không được để trống"
                data-rule-maxlength='200' data-msg-maxlength="Tiêu đề không dài hơn 200 ký tự">
            </div>
            <div class="form-group">
                <img src="https://dean2020.edu.vn/wp-content/uploads/2018/11/Nha6.jpg" class="img-thumbnail w-100" id="image"><br>
                <input class="mt-2" type="file" accept="image/*" class="form-control-file" name="fileUpload" id="fileUpload" onchange="banner.showImage(this)"
                data-rule-required='true' data-msg-required="Ảnh không được để trống">
            </div>
            <div class="form-group">
                <label for="namePartner">Tên đối tác :</label>
                <input type="text" class="form-control" name="namePartner" id="namePartner" placeholder="Tên đối tác..."
                data-rule-required='true' data-msg-required="Tên đối tác không được để trống"
                data-rule-maxlength='200' data-msg-maxlength="Tên đối tác không dài hơn 200 ký tự">
            </div>
            <div class="form-group">
                <label for="date-input">Thời gian hết hạn :</label>
                <input type="date" class="form-control" name="expirationDate" id="date-input" 
                data-rule-required='true' data-msg-required="Thời gian hết hạn không được để trống">
                <span><small id="msgErrorDate"></small></span>
            </div>     
            <div class="form-group">
                <div class="form-check">
                <input class="form-check-show" type="checkbox" id="gridCheck" >
                <label class="form-check-label" for="gridCheck">
                    Show lên trang chính.
                </label>
                </div>
            </div>
            <input type="hidden" value="0" id="hidden" name='id'>
            <input type="hidden" value="{{ Auth::user()->id }}" id="user_id" name='user_id'>
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
                    banner.formModal();
                       if(data[0].show == 1){
                            $('#gridCheck').prop('checked', true);
                        }
                        $('#titleBanner').val(data[0].title);
                        $('#image').attr('src', `{{ asset('uploads/images/banners/${data[0].imageAddress}') }}`);
                        $('#namePartner').val(data[0].partner);
                        $('#date-input').val(data[0].expirationDate);
                        $('#hidden').val(data[0].id);
                        $('#exampleModalLongTitle').text('Cập nhật thông tin')
                        $('#fileUpload').attr('data-rule-required', false);
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
   banner.checkDay = function(dayIn){
    var dayIn = $('#date-input').val();
    var x = new Date(dayIn);
    var dateObj = new Date();    
    var month = dateObj.getUTCMonth() + 1;    
    var day = dateObj.getUTCDate();    
    var year = dateObj.getUTCFullYear();    
    newdate = year + "-" + month + "-" + day;   
     var y = new Date(newdate);
    if(x < y) {         
        $('#msgErrorDate').text('Ngày hết hạn không bé hơn ngày hiện tại.');
        $('#msgErrorDate').show();
        return false;
   }else{
    $('#msgErrorDate').hide();
        return true;
   }
   }
   banner.save = function(){
       var formBanner = new FormData($('#formAdBanner')[0]);
       
        let show;
        ($('#gridCheck:checked').val() == 'on') ? show = 1 : show = 0;
        formBanner.append('show', show);

       if($('#formAdBanner').valid()){
            $('#editAddbanner').modal('hide');
            if($('#hidden').val() != 0){
                $.ajax({
                    method: "POST",
                    dataType: "json",
                    url: '{{ route("banner.update") }}',
                    data: formBanner,
                    contentType: false,
                    processData: false,
                    success: function (data){
                        banner.get();
                        toastr["success"]("Thay đổi thành công !");
                    }
                });
        }else{
            var dayIn = $('#date-input').val();
            var x = new Date(dayIn);
            var dateObj = new Date();    
            var month = dateObj.getUTCMonth() + 1;    
            var day = dateObj.getUTCDate();    
            var year = dateObj.getUTCFullYear();    
            newdate = year + "-" + month + "-" + day;   
            var y = new Date(newdate);
            if(x < y) {         
                $('#msgErrorDate').text('Ngày hết hạn không bé hơn ngày hiện tại.');
                $('#msgErrorDate').show();
                return false;
            }else{
                $.ajax({
                method: "POST",
                dataType: "json",
                url: '{{ route("banner.create") }}',
                data: formBanner,
                contentType: false,
                processData: false,
                success: function (data){
                    banner.get();
                    toastr["success"]("Thay đổi thành công !");
                }
            });
            }
            
        }
    }
    
          
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
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="partner"]').tooltip();
    } );
</script>
@endpush