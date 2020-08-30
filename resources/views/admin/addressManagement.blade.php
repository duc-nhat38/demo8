@extends('layouts.Admin')

@section('title', 'Dashboard - Quản lý Tỉnh , Huyện')
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
    <a href="javascript:;" class="btn btn-warning" onclick="address.create()">Thêm tỉnh mới</a>
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
    <a href="javascript:;" class="btn btn-warning" onclick="district.create()">Thêm huyện mới</a>
  </div>
</div>

<div class="modal fade" id="editAddress">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title addressForm">Sửa tên</h4>
        <button type="button" class="close" data-dismiss="modal" onclick="closeFormAddress()">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="formAddress">
          <div class="form-group">
            <label for="nameEdit">Tên :</label>
            <input type="text" class="form-control" id="nameEdit" placeholder="Nhập tên" data-rule-required="true"
            data-msg-required="Không được để trống" data-rule-minlength="3"
            data-msg-minlength="Không được ít hơn 3 kí tự" data-rule-maxlength="50"
            data-msg-maxlength="Không được lớn hơn 50 kí tự">
          </div>
          <span><small id="msgError" class="text-danger"></small></span>
          <input type="hidden" class="form-control" id="idHidden" value="0">
        </form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeFormAddress()">Đóng</button>
        <button type="button" class="btn btn-success addressSave" onclick="address.save()">Lưu</button>
        <button type="button" class="btn btn-success districtSave" onclick="district.save()">Lưu</button>
      </div>

    </div>
  </div>
</div>
@endsection

@push('addressManagerment-js')
<script src="/js/dashboard/addressManagement.js"></script>
@endpush