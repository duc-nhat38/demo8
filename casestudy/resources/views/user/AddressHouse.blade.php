@extends('layouts.HomePage')

@section('content')
<div class="container">
    <div class="text-center bg-warning p-2 rounded">
        <h5>Các bài đăng liên quan về "{{ $addressHouse[0]['address'] }}":</h5>
    </div>
    <div class="w-100 d-flex flex-wrap">
        @foreach ($addressHouse as $item)
        <div class="card div-hover p-0">
            <img src="{{  asset('uploads/'.$item["photo"]) }}" class="card-img-top">
            <div class="card-body p-2">
                <h6><a href="{{ route('house.show', $item['id']) }}"
                        class="text-decoration-none">{{ $item['title'] }}</a></h6>
                <span class="card-text">Địa chỉ : {{ $item['district'] }} - {{ $item['address'] }}</span><br>
                <span class="card-text">Thể loại : <a
                        href="{{ route('business.house', $item['business_type_id']) }}">{{ $item['businessName'] }}</a></span><br>
                <span class="card-text">Diện tích : {{ $item['area'] }} m<sup>2</sup></span><br>
                <span class="card-text">Giá : {{ number_format($item['price']) }} đ</span><br>
                <span class="card-text">Người đăng : <a href="">{{ $item['name'] }}</a></span><br>
                <span class="card-text"><small class="text-muted">Thời gian : {{ $item['day_create'] }}</small></span>
            </div>
        </div>
        @endforeach

    </div>
    <div class="mt-3">
        {{ $addressHouse->links() }}
    </div>

</div>
@endsection