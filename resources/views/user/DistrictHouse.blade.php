@extends('layouts.HomePage')

@section('title')
    Các bài đăng liên quan về {{ $districtHouse[0]['district'] }}
@endsection

@section('content')
@include('user.Search')
<div class="container mt-5">
    <div class="text-center bg-warning p-2 rounded">
        <h4>Các bài đăng liên quan về " {{ $districtHouse[0]['district'] }} ":</h4>
    </div>
    <div class="w-100 d-flex flex-wrap">
        @foreach ($districtHouse as $item)
        <div class="card div-hover p-0">
            <img src="{{  asset('uploads/images/houses/house-'.$item["id"].'/'.$item["photo"]) }}" class="card-img-top">
            <div class="card-body p-2">
                <h6><a href="{{ route('house.show', $item['id']) }}"
                        class="text-decoration-none">{{ $item['title'] }}</a></h6>
                <span class="card-text">Địa chỉ : <a href="{{ route('district.house', $item['district_id']) }}">{{ $item['district'] }}</a> - <a href="{{ route('address.house', $item['address_id']) }}">{{ $item['address'] }}</a></span><br>
                <span class="card-text">Thể loại : <a
                        href="{{ route('business.house', $item['business_type_id']) }}">{{ $item['businessName'] }}</a></span><br>
                <span class="card-text">Diện tích : {{ $item['area'] }} m<sup>2</sup></span><br>
                <span class="card-text">Giá : {{ number_format($item['price']) }} đ</span><br>
                <span class="card-text">Người đăng : <a href="{{ route('get.user',$item['user_id']) }}">{{ $item['name'] }}</a></span><br>
                <span class="card-text"><small class="text-muted">Thời gian : {{ $item['day_create'] }}</small></span>
            </div>
        </div>
        @endforeach

    </div>
    <div class="mt-3">
        {{ $districtHouse->links() }}
    </div>

</div>
@endsection