<nav class="navbar navbar-expand-lg navbar-light bg-white navbar-inverse navbar-fixed-top w-100">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('uploads/avatar.png') }}" alt="logo" style="width:120px; height:40px">
  </a>
  <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
    <!-- Links -->
    <ul class="nav navbar-nav text-uppercase" id="businessType">

    </ul>
    <ul class="nav navbar-nav mr-3">
      @guest
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('login') }}" title="Đăng nhập"><i class="fas fa-user-circle fa-2x"></i></a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item active pt-2 text-uppercase">
        <a class="nav-link" title="Đăng kí" href="{{ route('register') }}">Đăng ký</a>
      </li>
      @endif
      @else
      <li class="nav-item pt-2 active">
        <div class="d-flex position-relative p-1" id="cardDrop" data-id="{{ Auth::user()->id }}">
          <img src="{{ asset('uploads/'.Auth::user()->information->avatar) }}" alt="" class="rounded-circle"
            id="avatar">
          <span class="ml-1">{{ Auth::user()->name }}</span>
          <div class="card position-absolute" style="width: 15rem;" id="card-user">
            <ul class="list-group list-group-flush">
              @if (Auth::user()->isAdmin == 1)
              <li class="list-group-item">
                <a class="text-decoration-none" href="{{ route('dashboard') }}"><i class="far fa-address-card"></i>
                  Dashboard</a>
              </li>
              @endif
              <li class="list-group-item">
                <a class="text-decoration-none" href="{{ route('user.information', Auth::user()->id) }}"><i
                    class="far fa-address-card"></i> Cá nhân</a>
              </li>
              <li class="list-group-item">
                <a class="text-decoration-none" href=""><i class="fas fa-user-cog"></i> Thay đổi mật khẩu</a>
              </li>
              <li class="list-group-item ">
                <a class="collapse-item text-decoration-none" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
        </div>
      </li>

      @endguest
      <li class="nav-item active pt-2 text-uppercase">
        <a class="nav-link" title="Đăng bài" href="javascript:;" onclick="formPostHouseOn()">Đăng bài</a>
      </li>
    </ul>
  </div>
</nav>

{{-- modal post --}}
<div class="modal fade" id="formPostHouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Đăng bài</h5>
        <button type="button" class="close"  aria-label="Close" onclick="formPostHouseOff()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formInputHouse" action="{{ route('house.create') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="inputTitle">Tiêu đề :</label>
            <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Tiêu đề bài viết ..."
              data-rule-required='true' data-msg-required="Tiêu đề không được để trống" data-rule-maxlength=”100”
              data-msg-maxlength="Tiêu đê không dài quá 100 ký tự.">
          </div>
          <div class="form-group row">
            <div class="col w-100">
              <label for="inputBusiness">Thể loại</label>
              <select class="form-control" id="inputBusiness" name="inputBusiness" data-rule-required='true'
                data-msg-required="Thể loại không được để trống">

              </select>
            </div>
            <div class="col w-100">
              <label for="inputDistrict">Quận / Huyện</label>
              <select class="form-control" id="inputDistrict" name="inputDistrict" data-rule-required='true'
                data-msg-required="Quận / Huyện không được để trống" onchange="district.addressDetail()">

              </select>
            </div>
            <div class="col">
              <label for="inputAddress">Tỉnh / Thành :</label>
              <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="Tỉnh / Thành"
                data-rule-required='true' data-msg-required="Tỉnh / Thành không được để trống" readonly>
            </div>

            <div class="col">
              <label for="inputArea">Diện tích (m2) :</label>
              <input type="number" class="form-control" name="inputArea" id="inputArea" placeholder="Diện tích"
                data-rule-required='true' data-msg-required="Diện tích không được để trống" data-rule-min='1'
                data-msg-min='Diện tích không nhỏ hơn 1.' data-rule-max='500'
                data-msg-max='Diện tích không lớn hơn 500.'>
            </div>
            <div class="col">
              <label for="inputPrice">Giá tiền (đ) :</label>
              <input type="number" class="form-control" name="inputPrice" id="inputPrice" placeholder="Giá tiền"
                data-rule-required='true' data-msg-required="Giá tiền không được để trống" data-rule-min='1'
                data-msg-min='Giá tiền không nhỏ hơn 1.'>
            </div>
          </div>
          <div class="form-group">
            <label for="inputFile">Ảnh (Giới hạn số lượng: 6):</label>
            <input type="file" class="form-control-file" accept="image/*" id="inputFile" name="inputFile[]" multiple
              onchange="checkValueInputFile(this)" data-rule-required='true'
              data-msg-required="Ảnh không được để trống">
            <span class="text-danger"><small id="inputFileError"></small></span>
          </div>
          <div class="form-group">
            <label for="inputDescription">Mô tả :</label>
            <textarea class="form-control" id="editor2" name="inputDescription" rows="3" data-rule-required='true'
              data-msg-required="Mô tả không được để trống"></textarea>
          </div>
          <input type="hidden" value="{{ Auth::user()->id ?? 0 }}" name="user_id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formPostHouseOff()">Đóng</button>
        <button type="button" class="btn btn-primary" id="submitCreateHouse" onclick="createHouse()">Đăng ngay</button>
      </div>
    </div>
  </div>
</div>
{{-- alert login --}}
<div class="modal fade" id="alertLogin" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Đăng nhập</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span>Đăng nhập để đăng bài ? </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <a href="{{ route('login') }}" class="btn btn-primary">Đồng ý</a>
      </div>
    </div>
  </div>
</div>
@push('header')
{{-- ck editor --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace('editor2'); 
</script>
<script>
  var business = business || {};
        business.get = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('get.business') }}",
                dataType: "json",
                success: function (data) {
                    $('#businessType').empty();
                    $('#businessType').append(`
                        
                        <li class="nav-item active">
                            <a class="nav-link" href="/">TRANG CHỦ <span class="sr-only">(current)</span></a>
                        </li>
                    `);
                    $.each(data, function (i, value) { 
                        $('#businessType').append(`
                        <li class="nav-item active">
                            <a class="nav-link" href="/business/${value.id}">${(value.typeName).toUpperCase()}</a>
                        </li>
                        `);
                        $('#inputBusiness').append(`
                        <option value="${value.id}">${value.typeName}</option>
                    `);
                    });
                    $('#businessType').append(`
                        <li class="nav-item active">
                            <a class="nav-link" href="/posts">TIN TỨC</a>
                        </li>
                    `);                   
                }
            });
        }

        business.inputBusiness = function(){
          $.ajax({
                type: "GET",
                url: "{{ route('get.business') }}",
                dataType: "json",
                success: function (data) {
                  $('#inputBusiness').empty();
                  $.each(data, function (i, value) { 
                    $('#inputBusiness').append(`
                        <option value="${value.id}">${value.typeName}</option>
                    `);
                  });
                }
          });
        }
  var district = district || {};
  district.inputDistrict = function(){
    $.ajax({
      type: "GET",
      url: "{{ route('get.district') }}",
      dataType: "json",
      success: function (data) {
        $('#inputDistrict').empty();
        $.each(data, function (i, value) { 
          $('#inputDistrict').append(`
            <option value="${value.id}"> ${value.district}</option>
          `);
        });
        district.addressDetail();
      }

    });
  }

  district.addressDetail = function(){
    $.ajax({
      type: "GET",
      url: "{{ route('district.detail') }}",
      data: {
        id: $('#inputDistrict').val(),
      },
      dataType: "json",
      success: function (data) {
        $('#inputAddress').val(data.address.address);
      }
    });
  }
        function createHouse(){
            if (checkValueInputFile() && $('#formInputHouse').valid()){
              $('#formInputHouse').submit();
              formPostHouseOff();
            }
        }

        function formPostHouseOn() {
          if($('#cardDrop').data('id') != null){
            $('#formPostHouse').modal('show');
          }else{
            $('#alertLogin').modal('show');
          }
          
        }
        function formPostHouseOff(){
          $('#inputTitle').val('');
          $('#inputArea').val('');
          $('#inputPrice').val('');
          $('#inputFile').val('');
          $('#showPhotoHouse').empty();
          district.inputDistrict();
          business.inputBusiness();
          CKEDITOR.instances.editor2.setData('');
          $('#formPostHouse').modal('hide');
          $('label.error').hide();
        }
       function checkValueInputFile(data){
         let inputFile = $("#inputFile").prop('files');
          if(inputFile.length > 6){
            $('#inputFileError').text('* Số lượng ảnh vượt quá số lượng cho phép .')
            $('#inputFileError').show();
            return false;
          }else{
            $('#inputFileError').hide();
          }
          
          return true;
          
       }
       
    $(document).ready( function () {   
        business.get();
        district.inputDistrict();
        business.inputBusiness();
        
        $('#cardDrop').click(function(){
            $('#card-user').show();
        });
        $('#card-user').hover(function(){
          $('#card-user').show();
        },function(){
          $('#card-user').hide();
        }
        );
        $('#inputBusiness').select2();
        $('#inputDistrict').select2();
    });
    
</script>
@endpush