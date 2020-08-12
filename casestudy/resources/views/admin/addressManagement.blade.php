@extends('layouts.Admin')

@section('content')
<p class="display-4 text-center">Quản lý Tỉnh , huyện </p>
<div class="address row justify-content-between mt-3">
  <div class="col-7">
    <table class="table mr-1 table-hover text-md-center" id="tableAdd">
      <thead class="thead-dark">
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Tỉnh</th>
          <th scope="col">Thêm Huyện</th>
          <th scope="col">Sửa / Xóa</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
    <button class="btn btn-warning text-dark font-weight-bold"  data-toggle="modal" data-target="#editAddress">Thêm tỉnh mới</button>
  </div>
  <div class="col-5">
    <table class="table ml-1 table-hover text-md-center" id="tableDistrict">
      <thead class="thead-dark">
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Huyện</th>
          <th scope="col">Sửa / Xóa</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="editAddress">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-address-title">Thêm tỉnh</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-address-body p-2">
        <div class="form-group">
          <label for="inputAddress">Tên tỉnh</label>
          <input type="text" class="form-control" id="inputAddress" placeholder="Nhập tên tỉnh ....">
        </div>
        <div class="form-group">
          <label for="inputDistrict">Tên huyện</label>
          <textarea class="form-control" id="inputDistrict" rows="3" placeholder="Nhập tên huyện (mỗi tên cách nhau bằng dấu phẩy VD: Hà Tĩnh,Huế) ...."></textarea>
        </div>
        <input type="hidden" class="form-control" id="addressId" value='0'>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-success" onclick="address.create()">Lưu</button>
      </div>

    </div>
  </div>
</div>
@endsection

@push('addressManagerment-js')
<script>
  var address = address || {};
        address.get = function(){
            $.ajax({
                method: "GET",
                dataType: "json",
                url: '{{ route("get.address") }}',
                success: function (data){
                  if ($.fn.DataTable.isDataTable( '#tableAdd' ) ) {
                    $('#tableAdd').DataTable().destroy();
                  }
                  $('#tableAdd tbody').empty();
                  $.each(data, function (i, value) { 
                    $('#tableAdd tbody').append(`
                    <tr>
                      <th scope="row">${i+1}</th>
                      <td >
                        <a href="javascript:;" class="text-decoration-none" onclick=address.detail(${value.id})>${value.address}</a>
                      </td>
                      <td>
                        <a href="javascript:;" title="Thêm huyện"onclick="district.modalShow(${value.id},${value.address})"><i class="fas fa-lg fa-map-marked-alt text-primary"></i></a>                       
                      </td>
                      <td class="d-flex justify-content-around">
                        <a href="javascript:;" title="Sửa" onclick=""><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                        <a href="javascript:;" title="Xóa" onclick=""><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                      </td>
                    </tr>
                    `);
                  });
                  $('#tableAdd').DataTable();
                }
            });
        }

  address.detail = function(id){
    $.ajax({
      type: "GET",
      url: "{{ route('address.detail') }}",
      data: {
        id: id,
      },
      dataType: "json",
      success: function (data) {
        if ($.fn.DataTable.isDataTable( '#tableAdd' ) ) {
          $('#tableAdd').DataTable().destroy();
        }
        $('#tableAdd tbody').empty();
        if ($.fn.DataTable.isDataTable( '#tableDistrict' ) ) {
          $('#tableDistrict').DataTable().destroy();
        }
        $('#tableDistrict tbody').empty();
        $('#tableAdd tbody').append(`
        <tr>
            <th scope="row">1</th>
            <td >
              <a href="javascript:;" class="text-decoration-none" onclick=address.detail(${data.id})>${data.address}</a>
            </td>
            <td>
              <a href="javascript:;" title="Thêm huyện" onclick="district.modalShow(${data.id},${data.address})"><i class="fas fa-lg fa-map-marked-alt text-primary"></i></a>                       
            </td>
            <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick=""><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick=""><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
            </td>
        </tr>
        <tr>
          <td colspan="4" scope="row">
            <a href="javascript:;" onclick="address.showAll()">Tất cả</a>
          </td>
        </tr>
        `);
        $.each(data.address_details, function (i, value) {
           $('#tableDistrict tbody').append(`
           <tr>
              <th scope="row">${i+1}</th>
                <td>
                  <a href="javascript:;" class="text-decoration-none" onclick=district.detail(${value.id})>${value.district}</a></td>
                </td>
                <td class="d-flex justify-content-around">
                  <a href="javascript:;" title="Sửa" onclick=""><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                  <a href="javascript:;" title="Xóa" onclick=""><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                </td>
            </tr>
           `);
        });
        $('#tableDistrict').DataTable();
      }
    });
  }

  address.showAll = function(){
    address.get();
    district.get();
  }

  address.create = function(){
    console.log($('#inputDistrict').val());
    if($('#addressId').val() == 0){
      $.ajax({                                    //create address
        type: "POST",
        url: "{{ route('address.create') }}",
        data: {
          address: $('#inputAddress').val()
        },
        dataType: "json",
        success: function (data) {
          console.log(data);
          if($('#inputDistrict').val()){                        //create district
            district.save(data.id);
          }else{
            address.showAll();
            $('#editAddress').modal('hide');
            toastr["success"]("Thêm thành công !");
          }
        }
      });
    }
  }
// jquery district
  var district = district || {};
  district.get = function(){
            $.ajax({
                method: "GET",
                dataType: "json",
                url: '{{ route("get.district") }}',
                success: function (data){
                  if ($.fn.DataTable.isDataTable( '#tableDistrict' ) ) {
                    $('#tableDistrict').DataTable().destroy();
                  }
                  $('#tableDistrict tbody').empty();
                  $.each(data, function (i, value) { 
                     $('#tableDistrict tbody').append(`
                     <tr>
                        <th scope="row">${i+1}</th>
                        <td >
                          <a href="javascript:;" class="text-decoration-none" onclick=district.detail(${value.id})>${value.district}</a></td>
                        <td class="d-flex justify-content-around">
                          <a href="javascript:;" title="Sửa" onclick=""><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                          <a href="javascript:;" title="Xóa" onclick=""><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                        </td>
                      </tr>
                     `);
                  });
                  $('#tableDistrict').DataTable();
                }
            });
  }

  district.detail = function(id){
    $.ajax({
      type: "GET",
      url: '{{ route("district.detail") }}',
      data: {
        id: id,
      },
      dataType: "json",
      success: function (data) {

        if ($.fn.DataTable.isDataTable( '#tableAdd' ) ) {
          $('#tableAdd').DataTable().destroy();
        }
        $('#tableAdd tbody').empty();
        if ($.fn.DataTable.isDataTable( '#tableDistrict' ) ) {
          $('#tableDistrict').DataTable().destroy();
        }
        $('#tableDistrict tbody').empty();
        $('#tableDistrict tbody').append(`
          <tr>
            <th scope="row">1</th>
          <td >
            <a href="javascript:;" class="text-decoration-none" onclick=district.detail(${data.id})>${data.district}</a></td>
          <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick=""><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick=""><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
            </td>
          </tr>
          <tr>
            <td colspan="3" scope="row">
              <a href="javascript:;" class="text-decoration-none" onclick="address.showAll()">Tất cả</a>
            </td>
          </tr>
        `);         
          $('#tableAdd tbody').append(`
          <tr>
            <th scope="row">1</th>
            <td >
              <a href="javascript:;" class="text-decoration-none" onclick=address.detail(${data.address.id})>${data.address.address}</a>
            </td>
            <td>
              <a href="javascript:;" title="Thêm huyện" onclick="district.modalShow(${data.address.id},${data.address.address})"><i class="fas fa-lg fa-map-marked-alt text-primary"></i></a>                       
            </td>
            <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick=""><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick=""><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
            </td>
        </tr>
        <tr>
            <td colspan="3" scope="row">
              <a href="javascript:;" class="text-decoration-none" onclick="address.showAll()">Tất cả</a>
            </td>
          </tr>
        `);
      }
    });
  }

  district.modalShow = function(id, addressName){
    $('#inputAddress').val(addressName);
    $('#inputAddress').attr("disabled", true);
    $('#addressId').val(id);
    $('#editAddress').modal('show');
  }

  district.create = function(id){
    $.ajax({
      type: "POST",
      url: "{{ route('district.create') }}",
      data: {
          id: id,
          district: $('#inputDistrict').val(),
      },
      dataType: "json",
      success: function (data) {
        address.showAll();
        $('#editAddress').modal('hide');
        toastr["success"]("Thêm thành công !");
      }
    });
  }


  $(document).ready( function () {   
    address.get();
    district.get();
  });
</script>
@endpush