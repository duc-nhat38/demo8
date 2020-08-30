@extends('layouts.Admin')

@section('content')
    <div class="w-100 d-flex justify-content-around">
        <a href="{{ route('user.manager') }}" class="btn p-3 bg-success text-white">Quản lý người dùng</a>
        <a href="{{ route('address.manager') }}" class="btn p-3 bg-primary text-white">Quản lý Tỉnh Huyện</a>
        <a href="{{ route('banner.manager') }}" class="btn p-3 bg-warning text-white">Quản lý quảng cáo</a>
        <a href="{{ route('post.manager') }}" class="btn p-3 bg-danger text-white">Quản lý tin tức</a>
    </div>
@endsection
