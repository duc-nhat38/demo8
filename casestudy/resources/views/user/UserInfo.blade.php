@extends('layouts.HomePage')

@section('content')
<div class="container pt-5">
    <div class="d-flex w-100 mt-3 bg-white p-3 border rounded">
        <div class="col-4 img-user p-0">
            <img src="{{ asset('uploads/images/users/user-'.Auth::user()->id.'/'.Auth::user()->information->avatar) }}"
                alt="avatar" class="img-thumbnail" id="avatarUser">
            <div class="mt-3">
                <div class="mb-2 w-75">
                    <a href="javascript:;" class="btn btn-warning" onclick="user.openFormUpdateAvatar(this)"
                        id="openFormUpdateAvatar">Thay ảnh đại diện</a>
                    <form id="formUpdateAvatar" class="mt-3" hidden enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputAvatar">Thêm ảnh</label>
                            <input type="file" class="form-control-file" id="inputAvatar" name="inputAvatar"
                                accept="image/*" onchange="user.showAvatar(this)" data-rule-required='true'
                                data-msg-required="Ảnh không được để trống" data-rule-accept='image/*'
                                data-msg-accept="File tải lên không phải ảnh">
                        </div>
                        <input type="hidden" id="idUpdateAvatar" name="id" value="{{ Auth::user()->id ?? 0 }}">
                        <div class="d-flex justify-content-end mt-3">
                            <a href="javascript:;" class="btn btn-dark" onclick="user.closeFormUpdateAvatar(this)"
                                id="closeFormUpdateAvatar">Đóng</a>
                            <a href="javascript:;" class="btn btn-success ml-3" onclick="user.updateAvatar()"
                                id="btnUpdateAvatar">Lưu</a>
                        </div>
                    </form>
                </div>
                <p>Tài khoản :
                    @if (Auth::user()->information->role == 0)
                    <span>chưa xác minh <i class="fas fa-check-circle text-dark"></i></span>
                    @else
                    <span>đã xác minh <i class="fas fa-check-circle text-success"></i></span>
                    @endif
                </p>
                <p><i class="far fa-newspaper"></i> Số lượng bài đăng : {{ count($listHouseUser) ?? 0}}</p>
            </div>
        </div>
        <div class="col-8 p-0">
            <form id="formInputUser">
                <div class="form-group">
                    <label for="fullName">Họ và Tên :</label>
                    <div class="d-flex">
                        <input type="text" class="form-control border-0" name="fullName" id="fullName"
                            value="{{ Auth::user()->information->fullName ?? '' }}" disabled
                            placeholder="Chưa có, bổ sung ngay." data-rule-maxlength='100'
                            data-msg-maxlength="Họ tên không vượt quá 100 ký tự." data-rule-minlength='2'
                            data-msg-minlength="Họ tên không ít hơn 2 ký tự.">
                    </div>

                </div>
                <div class="form-group">
                    <label for="userName">Tên đăng nhập :</label>
                    <input type="text" class="form-control border-0" id="userName"
                        value="{{ Auth::user()->name ?? '' }}" disabled name="name" placeholder="Chưa có, bổ sung ngay."
                        data-rule-required='true' data-msg-required="Tên đăng nhập không được để trống"
                        data-rule-maxlength='24' data-msg-maxlength="Tên đăng nhập không vượt quá 24 ký tự."
                        data-rule-minlength='6' data-msg-minlength="Tên đăng nhập không ít hơn 6 ký tự.">

                </div>
                <div class="form-group">
                    <label for="userEmail">Email :</label>
                    <input type="email" class="form-control border-0" name="email" id="userEmail"
                        value="{{ Auth::user()->email ?? '' }}" disabled placeholder="Chưa có, bổ sung ngay."
                        data-rule-email='true' data-msg-email='Email không đúng.' data-rule-required='true'
                        data-msg-required="Email không được để trống">
                </div>
                <div class="form-group">
                    <label for="userPhone">Số điện thoại :</label>
                    <input type="text" class="form-control border-0" name="phone" id="userPhone"
                        value="{{ Auth::user()->information->phone ?? '' }}" disabled
                        placeholder="Chưa có, bổ sung ngay." data-rule-required='true'
                        data-msg-required="Số điện thoại không được để trống" data-rule-number='true'
                        data-msg-number="Số điện thoại phải là chữ số.">
                </div>
                <div class="form-group">
                    <label for="userAddress">Địa chỉ :</label>
                    <input type="text" class="form-control border-0" name="address" id="userAddress"
                        value="{{ Auth::user()->information->address ?? '' }}" disabled
                        placeholder="Chưa có, bổ sung ngay." data-rule-required='true'
                        data-msg-required="Địa chỉ không được để trống" data-rule-maxlength='150'
                        data-msg-maxlength="Địa chỉ không vượt quá 150 ký tự." data-rule-minlength='3'
                        data-msg-minlength="Địa chỉ không ít hơn 3 ký tự.">

                    <input type="hidden" id="hiddenUserId" value="{{ Auth::user()->id ?? 0 }}">
                </div>
            </form>
            <div class="d-flex justify-content-end mt-3">
                <a href="javascript:;" class="bnt btn-warning text-center p-2 px-3 rounded" id="open"
                    onclick="user.openForm(this)"><i class="far fa-edit"></i></a>
                <a href="javascript:;" class="bnt btn-dark p-2 rounded" style="display: none" id="close"
                    onclick="user.closeForm(this)">Đóng</a>
                <a href="javascript:;" class="bnt btn-success p-2 ml-2 rounded" style="display: none" id="submit"
                    onclick="user.submitDataEdit(this)">Lưu thay đổi</a>
            </div>

        </div>
    </div>

    <div class="w-100 bg-white mt-5">
        <div class="text-center bg-warning p-2 rounded">
            <h5>Đang bán </h5>
        </div>
        @if (count($listHouseUser) != 0)

        <div class="w-100 d-flex flex-wrap">
            @foreach ($listHouseUser as $item)
            <div class="card div-hover p-0 position-relative">
                <img src="{{  asset('uploads/images/houses/house-'.$item["id"].'/'.$item["photo"]) }}"
                    class="card-img-top">
                <div class="card-body p-2">
                    <h6><a href="{{ route('house.show', $item['id']) }}"
                            class="text-decoration-none">{{ $item['title'] }}</a></h6>
                    <span class="card-text">Địa chỉ : <a
                            href="{{ route('district.house', $item['district_id']) }}">{{ $item['district'] }}</a> - <a
                            href="{{ route('address.house', $item['address_id']) }}">{{ $item['address'] }}</a></span><br>
                    <span class="card-text">Thể loại : <a
                            href="{{ route('business.house', $item['business_type_id']) }}">{{ $item['businessName'] }}</a></span><br>
                    <span class="card-text">Diện tích : {{ $item['area'] }} m<sup>2</sup></span><br>
                    <span class="card-text">Giá : {{ number_format($item['price']) }} đ</span><br>
                    <span class="card-text">Người đăng : <a
                            href="{{ route('get.user',$item['user_id']) }}">{{ $item['name'] }}</a></span><br>
                    <span class="card-text"><small class="text-muted">Thời gian :
                            {{ $item['day_create'] }}</small></span>
                    <div class="position-absolute p-1 btn-editHouseUser">
                        <a href="javascript:;" class="btn btn-danger" data-houseid="{{ $item['id'] }}"
                            onclick="houseDelete(this)"><i class="far fa-trash-alt text-white"></i></a>
                        <a href="javascript:;" class="btn btn-warning ml-2" data-houseid="{{ $item['id'] }}"
                            onclick="formEditHouseOn(this)"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="mt-3">
            {{ $listHouseUser->links() }}
        </div>
        @else
        <div class="w-100 text-center p-2">
            <p>Chưa có bất động sản đăng bán.</p>
        </div>
        @endif

    </div>
</div>
{{-- modal form --}}
<div class="modal fade" id="formEditPostHouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa bài đăng</h5>
                <button type="button" class="close" aria-label="Close" onclick="formEditHouseOff()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditHouse" action="{{ route('house.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEditTitle">Tiêu đề :</label>
                        <input type="text" class="form-control" name="inputEditTitle" id="inputEditTitle"
                            placeholder="Tiêu đề bài viết ..." data-rule-required='true'
                            data-msg-required="Tiêu đề không được để trống" data-rule-maxlength=”100”
                            data-msg-maxlength="Tiêu đê không dài quá 100 ký tự.">
                    </div>
                    <div class="form-group row">
                        <div class="col w-100">
                            <label for="inputEditBusiness">Thể loại</label>
                            <select class="form-control inputBusiness" id="inputEditBusiness" name="inputEditBusiness"
                                data-rule-required='true' data-msg-required="Thể loại không được để trống">

                            </select>
                        </div>
                        <div class="col w-100">
                            <label for="inputEditDistrict">Quận / Huyện</label>
                            <select class="form-control inputDistrict" id="inputEditDistrict" name="inputEditDistrict"
                                data-rule-required='true' data-msg-required="Quận / Huyện không được để trống"
                                onchange="district.changeDistrict()">

                            </select>
                        </div>
                        <div class="col">
                            <label for="inputEditAddress">Tỉnh / Thành :</label>
                            <input type="text" class="form-control inputAddress" name="inputEditAddress"
                                id="inputEditAddress" placeholder="Tỉnh / Thành" data-rule-required='true'
                                data-msg-required="Tỉnh / Thành không được để trống" readonly>
                        </div>

                        <div class="col">
                            <label for="inputEditArea">Diện tích (m2) :</label>
                            <input type="number" class="form-control" name="inputEditArea" id="inputEditArea"
                                placeholder="Diện tích" data-rule-required='true'
                                data-msg-required="Diện tích không được để trống" data-rule-min='1'
                                data-msg-min='Diện tích không nhỏ hơn 1.' data-rule-max='500'
                                data-msg-max='Diện tích không lớn hơn 500.'>
                        </div>
                        <div class="col">
                            <label for="inputEditPrice">Giá tiền (đ) :</label>
                            <input type="number" class="form-control" name="inputEditPrice" id="inputEditPrice"
                                placeholder="Giá tiền" data-rule-required='true'
                                data-msg-required="Giá tiền không được để trống" data-rule-min='1'
                                data-msg-min='Giá tiền không nhỏ hơn 1.'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditFile">Ảnh (Giới hạn số lượng: 6):</label>
                        <div id="showPhotoHouse" class="d-flex flex-wrap"></div>
                        <input type="file" class="form-control-file" accept="image/*" id="inputEditFile"
                            name="inputEditFile[]" multiple onchange="checkValueEditPhoto(this)">
                        <span class="text-danger"><small id="inputFileError2"></small></span>
                    </div>
                    <div class="form-group">
                        <label for="inputEditDescription">Mô tả :</label>
                        <textarea class="form-control" id="editor3" name="inputEditDescription" rows="3"
                            data-rule-required='true' data-msg-required="Mô tả không được để trống"></textarea>
                    </div>
                    <input type="hidden" value="0" name="houseIdHidden" id="houseIdHidden">
                    <input type="hidden" value="{{ Auth::user()->id ?? 0 }}" name="user_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="formEditHouseOff()">Đóng</button>
                <button type="button" class="btn btn-primary" id="submitCreateHouse" onclick="editHouse()">Đăng
                    ngay</button>
            </div>
        </div>
    </div>
</div>
{{-- end --}}
@endsection
@push('user-info')
{{-- ck editor --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('editor3'); 
</script>
<script>
    var user = user || {};
    user.openForm = function(data){
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

    user.closeForm = function(data){
        ($(this).data('fullName') == null) ? $('#fullName').val('') : $('#fullName').val($(this).data('fullName'));
        ($(this).data('name') == null) ? $('#userName').val('') : $('#userName').val($(this).data('name'));
        ($(this).data('email') == null) ? $('#userEmail').val('') : $('#userEmail').val($(this).data('email'));
        ($(this).data('phone') == null) ? $('#userPhone').val('') : $('#userPhone').val($(this).data('phone'));
        ($(this).data('address') == null) ? $('#userAddress').val('') : $('#userAddress').val($(this).data('address'));
        $(":input").attr('disabled', true);
        $(":input").addClass('border-0');
        $(data).hide();
        $('#open').show();
        $('#submit').hide();
        $('label.error').hide();
    }

    user.submitDataEdit = function(data){
        if($('#formInputUser').valid()){
            let id = $('#hiddenUserId').val();
            $.ajax({
                type: "PATCH",
                url: "{{ route('update.user') }}",
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
                error: function(){
                    user.closeForm();
                    toastr["warning"]("Thay đổi không thành công!");
                }
            });
        } 
    }

    user.openFormUpdateAvatar = function(element){
        $('#formUpdateAvatar').attr('hidden', false);
        $(element).hide();
        $(this).data('avatar', $('#avatarUser').attr('src'));
    }

    user.closeFormUpdateAvatar = function(element){
        $('#formUpdateAvatar').attr('hidden', true);
        $('#inputAvatar').val('');
        $('#openFormUpdateAvatar').show();
        $('#avatarUser').attr('src', $(this).data('avatar'));
    }

    user.showAvatar = function(element){
        let img = element.files[0];
        let reader = new FileReader();
        reader.onloadend = function() {
        $("#avatarUser").attr("src",reader.result);
        }
        reader.readAsDataURL(img);
    }

    user.updateAvatar = function(){
        if($('#formUpdateAvatar').valid()){
            let formData = new FormData($('#formUpdateAvatar')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('update.avatar') }}",        
                data: formData,
                contentType: false,
                processData: false,             
                dataType: "json",
                success: function (data) {
                    if(data){
                        $('#avatar').attr('src', $('#avatarUser').attr('src'));
                        $('#formUpdateAvatar').attr('hidden', true);
                        $('#inputAvatar').val('');
                        $('#openFormUpdateAvatar').show();
                        toastr["success"]("Thay đổi thành công!");
                    }
                    else{
                        toastr["warning"]("Thay đổi không thành công!");
                        user.closeFormUpdateAvatar();
                    }
                },
                error: function(data){
                    toastr["warning"]("Thay đổi không thành công!");
                }
            });
        }
        
    }
    district.changeDistrict =  function(){
        $.ajax({
            type: "GET",
            url: "{{ route('district.detail') }}",
            data: {
              id: $('#inputEditDistrict').val(),
            },
            dataType: "json",
            success: function (data) {
              $('#inputEditAddress').val(data.address.address);
            }
        });
    }
    function formEditHouseOn(data){
        $('#formEditPostHouse').modal('show');
        
        $.ajax({
            type: "GET",
            url: "{{ route('house.detail') }}",
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
                        <img src="{{ asset('uploads/images/houses/house-${value.house_id}/${value.photoAddress}') }}" alt="">
                        <a href="javascript:;" onclick="deletePhotoHouse(this)"  data-photoid="${value.id}" class="position-absolute btn btn-link text-white"><i class="fas fa-times"></i></a>
                    </div>
                     
                     `);
                });
            }
        });
       
    }
    function formEditHouseOff(){
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
    function deletePhotoHouse(data){
        
        if($(data).data('photoid') != 0){
            indexPhoto.push($(data).data('photoid'));
        }       
        $(data).closest('div').remove();
    }
    function checkValueEditPhoto(data){
        let countImage = $('#showPhotoHouse').children('div').length;
        
        let countFile = $("#inputEditFile").prop('files');
        if((countImage + countFile.length) > 6) {
            $('#inputFileError2').text('Số lượng ảnh vượt quá số lượng');
            $('#inputFileError2').show();
            return false;
        }else{
            $('#inputFileError2').hide();
            if(countFile.length != 0){
            let img = data.files;
            for(let i = 0; i < img.length; i++){
                let reader = new FileReader();
                reader.onloadend = function() {
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
    function houseDelete(data){
        bootbox.confirm({ 
                size: "small",
                message: "Bạn muốn xóa?",
            callback: function (result) {
                    if(result){
                        let id = $(data).data('houseid');
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('house.delete') }}",
                            data: {
                                id: id,
                            },
                            dataType: "json",
                            success: function (data){
                                if(data){
                                    $(`a[data-houseid='${id}']`).closest('div.div-hover').hide();
                                    toastr["warning"]("Đã xóa bài đăng!");
                                }
                            }
                        });
                    }
                }
            });
    }
    function editHouse(){
        if($('#showPhotoHouse').children('div').length == 0){
            $('#inputFileError2').text('Ảnh không được bỏ trống.');
            $('#inputFileError2').show();
        }else{
            if($('#formEditHouse').valid() && $('#showPhotoHouse').children('div').length <= 6 ){
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
            }
        );
            
    });
       
</script>
@endpush