@extends('layouts.Admin')

@section('title', 'Dashboard - Quản lý quảng cáo')
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
    aria-hidden="true" data-id="{{ Auth::user()->id }}">
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
<script src="/js/dashboard/bannerManagement.js"></script>
@endpush