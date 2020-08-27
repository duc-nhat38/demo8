@extends('layouts.HomePage')

@section('content')
<div class="container pt-5">
    <div class="w-100 d-flex border rounded p-2 information bg-white">
        <div class="col-3 p-0 text-center">
            <img src="{{  asset('uploads/images/users/user-'.$information["id"].'/'.$information["avatar"]) }}" alt="avatar" class="rounded-circle">
        </div>
        <div class="col-4">
            <p><i class="fas fa-user fa-lg"></i> {{ $information['name'] }}
                @if ($information['role'] != 0 )
                <i class="fas fa-check-circle text-success"></i>
                @else
                <i class="fas fa-check-circle text-dark"></i>
                @endif
            </p>
            <p><i class="fas fa-phone-square-alt fa-lg"></i> Số điện thoại :
                {{ $information['phone'] ?? 'Chưa cập nhật' }}</p>
            <p><i class="fas fa-map-marker-alt fa-lg"></i> Địa chỉ : {{ $information['address'] }}</p>
        </div>
        <div class="col-5">
            <p><i class="far fa-calendar-alt fa-lg"></i> Ngày tham gia : {{ $information['day_create'] }}</p>
            <p><i class="far fa-newspaper fa-lg"></i> Số bài đăng : {{ count($houses) ?? 0 }}</p>
            @if ($information['role'] != 0 )
            <p><i class="fas fa-user-check fa-lg"></i> Đã xác minh : <i
                    class="fas fa-map-marker-alt fa-lg text-sucess ml-1"></i> <i
                    class="far fa-envelope fa-lg text-sucess ml-1"></i> <i
                    class="fas fa-phone-square-alt fa-lg text-sucess ml-1"></i></p>
            @else
            <p>Chưa xác minh</p>
            @endif

        </div>
    </div>
    <div class="w-100 bg-white mt-5">
        <div class="text-center bg-warning p-2 rounded">
            <h5>Đang bán </h5>
        </div>
        @if (count($houses) != 0)
        
        <div class="w-100 d-flex flex-wrap">
            @foreach ($houses as $item)
            <div class="card div-hover p-0">
                <img src="{{  asset('uploads/images/houses/house-'.$item["id"].'/'.$item["photo"]) }}" class="card-img-top">
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
                </div>
            </div>
            @endforeach

        </div>
        <div class="mt-3">
            {{ $houses->links() }}
        </div>
        @else
        <div class="w-100 text-center p-2">
            <p>Chưa có bất động sản đăng bán.</p>
        </div>
        @endif

    </div>
</div>
@endsection