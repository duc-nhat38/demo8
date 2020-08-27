@extends('layouts.Admin')

@section('content')
<p class="display-4 text-center">Quản lý Tỉnh , Huyện </p>
<div class="address row justify-content-between mt-5">
  <div class="col">
    <table class="table mr-1 table-hover text-md-center" id="tableAdd">
      <thead class="thead-dark">
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Tỉnh</th>
          <th scope="col">Sửa / Xóa</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  <div class="col">
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

<div class="modal fade" id="editAddress">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Sửa tên</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="nameEdit">Tên :</label>
          <input type="text" class="form-control" id="nameEdit" placeholder="Nhập tên">
        </div>
        <input type="hidden" class="form-control" id="idHidden">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-success addressSave" onclick="address.save()">Lưu</button>
        <button type="button" class="btn btn-success districtSave" onclick="district.save()">Lưu</button>
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
                      <td class="d-flex justify-content-around">
                        <a href="javascript:;" title="Sửa" onclick=address.edit(${value.id},'${value.address}')><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                        <a href="javascript:;" title="Xóa" onclick="address.delete(${value.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
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
            <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick="address.edit(${data.id},'${data.address}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick="address.delete(${data.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
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
                  <a href="javascript:;" title="Sửa" onclick="district.edit(${value.id},'${value.district}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                  <a href="javascript:;" title="Xóa" onclick="district.delete(${value.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
                </td>
            </tr>
           `);
        });
        $('#tableDistrict').DataTable();
      }
    });
  }

  address.edit = function(id,addressName){
    $('#nameEdit').val(addressName);
    $('#idHidden').val(id);
    $('.districtSave').hide();
    $('#editAddress').modal('show');
  }

  address.save = function(){
    $.ajax({
      method: "PUT",
      url: "{{ route('address.update') }}",
      data: {
        id: $('#idHidden').val(),
        address: $('#nameEdit').val(),
      },
      dataType: "json",
      success: function (data) {
        $('#editAddress').modal('hide');
        address.showAll();
        toastr["success"]("Thay đổi thành công !");
      }
    });
  }

  address.delete = function(id){
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
      type: "DELETE",
      url: "{{ route('address.destroy') }}",
      data: {
        id: id,
      },
      dataType: "json",
      success: function (response) {
        address.showAll();
        toastr["warning"]("Đã xóa!");
      }
    });
    
        }
    }
    
  });
  }
  address.showAll = function(){
    address.get();
    district.get();
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
                          <a href="javascript:;" title="Sửa" onclick="district.edit(${value.id},'${value.district}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
                          <a href="javascript:;" title="Xóa" onclick="district.delete(${value.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
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
              <a href="javascript:;" title="Sửa" onclick="district.edit(${data.id},'${data.district}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick="district.delete(${data.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
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
            <td class="d-flex justify-content-around">
              <a href="javascript:;" title="Sửa" onclick="address.edit(${data.address.id},'${data.address.address}')"><i class="fas fa-pencil-alt fa-lg text-success"></i></a>
              <a href="javascript:;" title="Xóa" onclick="address.delete(${data.address.id})"><i class="far fa-trash-alt  fa-lg text-danger"></i></a> 
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

  district.edit = function(id,districtName){
    $('#nameEdit').val(districtName);
    $('#idHidden').val(id);
    $('.addressSave').hide();
    $('#editAddress').modal('show');
  }

  district.save = function(){
    $.ajax({
      method: "PUT",
      url: "{{ route('district.update') }}",
      data: {
        id: $('#idHidden').val(),
        district: $('#nameEdit').val(),
      },
      dataType: "json",
      success: function (data) {
        $('#editAddress').modal('hide');
        address.showAll();
        toastr["success"]("Thay đổi thành công !");
      }
    });
  }

  district.delete = function(id){
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
      type: "DELETE",
      url: "{{ route('district.destroy') }}",
      data: {
        id: id,
      },
      dataType: "json",
      success: function (response) {
        address.showAll();
        toastr["warning"]("Đã xóa!");
      }
    });
    
        }
    }
    
  });
  }
  $(document).ready( function () {   
    address.get();
    district.get();
  });
</script>
@endpush