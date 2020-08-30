@extends('layouts.HomePage')

@section('title')
    {{ $house['title'] }}
@endsection

@section('content')
@include('user.Search')
<div class="container mt-5">
    @if ($house)
    <div class="w-100 d-flex">
        <div class="col-8">
            <div id="photoSlideHouse" class="carousel slide" data-ride="carousel" data-id="{{ $house['id'] }}">
                <ol class="carousel-indicators" id="node">
                    <li data-target="#photoSlideHouse" data-slide-to="0" class="active"></li>
                    @for ($i = 1; $i < count($house['photos']); $i++)
                    <li data-target="#photoSlideHouse" data-slide-to="{{ $i }}"></li>
                    @endfor
                </ol>
                <div class="carousel-inner" id="slideShowImage">
                    <div class="carousel-item active" data-interval="3000">
                        <img src="{{ asset('uploads/images/houses/house-'.$house["id"].'/'.$house['photos'][0]['photoAddress']) }}" class="d-block w-100"
                            alt="...">
                    </div>
                    @for ($i = 1; $i < count($house['photos']); $i++) 
                    <div class="carousel-item" data-interval="3000">
                        <img src="{{ asset('uploads/images/houses/house-'.$house["id"].'/'.$house['photos'][$i]['photoAddress']) }}" class="d-block w-100" alt="...">
                    </div>
                    @endfor
            </div>
            <a class="carousel-control-prev" href="#photoSlideHouse" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#photoSlideHouse" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="w-100 d-flex">
    <div class="col-8">
        <div id="infoDetail" class="mt-5">
            <h4>{{ $house['title'] }}</h4>
            <div class="border rounded mt-2 p-2">
                <h6>Thông tin chính :</h6>
                <p>Giá : {{ number_format($house['price']) }} đ</p>
                <p>Diện tích : {{ $house['area'] }} m<sup>2</sup></p>
                <p>Lượt xem : {{ $house['view'] }} <i class="far fa-eye"></i></p>
                <p>Ngày đăng : {{ $house['day_create'] }}</p>
            </div>
            <div class="border rounded p-2 mt-2">
                <h6>Mô tả :</h6>
                <div>{!! $house['description'] !!}</div>
            </div>
            <div data-id="{{ $house['user_id'] }}" id="userHouse" class="border rounded p-2 mt-2">
                <h6>Người đăng :</h6>

            </div>
            <div class="border rounded p-2 w-100 mt-2" id="voteHouse" data-id="{{ Auth::user()->id ?? 0}} ">
                <div>
                    <h6>Đánh giá : </h6>
                    <div class="text-center">
                        <div class="point">
                            <a href="javascript:;" title="1 sao" class="m-2">
                                <i data-point="1" class="far fa-star fa-2x"></i></a>
                            <a href="javascript:;" title="2 sao" class="m-2">
                                <i data-point="2" class="far fa-star fa-2x"></i></a>
                            <a href="javascript:;" title="3 sao" class="m-2">
                                <i data-point="3" class="far fa-star fa-2x"></i></a>
                            <a href="javascript:;" title="4 sao" class="m-2">
                                <i data-point="4" class="far fa-star fa-2x"></i></a>
                            <a href="javascript:;" title="5 sao" class="m-2">
                                <i data-point="5" class="far fa-star fa-2x"></i></a>
                            <p id="total" class="mt-1">Chưa Có đánh giá .</p>
                        </div>
                    </div>
                    <div id="cate-rating" class="cate-rating text-center mt-3">
                        <div class="stars">
                            <a id="star-1" href="javascript:;" title="1 sao" class="star" onclick="vote.rating(this)">
                                <i data-id="1" class="far fa-star fa-2x"></i></a>
                            <a id="star-2" href="javascript:;" title="2 sao" class="star" onclick="vote.rating(this)">
                                <i data-id="2" class="far fa-star fa-2x"></i></a>
                            <a id="star-3" href="javascript:;" title="3 sao" class="star" onclick="vote.rating(this)">
                                <i data-id="3" class="far fa-star fa-2x"></i></a>
                            <a id="star-4" href="javascript:;" title="4 sao" class="star" onclick="vote.rating(this)">
                                <i data-id="4" class="far fa-star fa-2x"></i></a>
                            <a id="star-5" href="javascript:;" title="5 sao" class="star" onclick="vote.rating(this)">
                                <i data-id="5" class="far fa-star fa-2x"></i></a>
                            <p id="vote-desc">Mời bạn cho điểm!</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="commentHouse" data-id="{{ $house['id'] }}" class="border rounded p-2 w-100 mt-2">
                <h6>Nhận xét :</h6>
                <div class="d-flex p-2 my-2 border rounded">
                    <div class="col-1 p-0 d-flex align-items-center">
                        @if (Auth::check())
                        <img src="{{ asset('uploads/images/users/user-'.Auth::user()->id.'/'.Auth::user()->information->avatar) }}" alt="avatar"
                        class="rounded-circle">
                        @else
                        <img src="{{ asset('uploads/images/avatar.jpg') }}" alt="avatar"
                        class="rounded-circle">
                        @endif
                        
                    </div>
                    <div class="col-11 ml-1 d-flex">
                        <textarea class="form-control" id="myComment" rows="1" placeholder="Thêm bình luận ..."
                            required></textarea>
                        <button class="btn btn-warning ml-1" id="btnComment" data-id="{{ Auth::user()->id ?? 0 }}"
                            onclick="comment.create(this)">Bình luận</button>

                    </div>
                </div>
                <div id="listComment">

                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        @include('user.BarSelect')
    </div>
</div>
@endif
</div>
@endsection

@push('house-info')
<script src="{{ asset('js/homePage/HouseInfo.js') }}"></script>
@endpush