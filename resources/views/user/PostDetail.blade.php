@extends('layouts.HomePage')

@section('title')
{{ $post['title'] }} - Tin tức
@endsection
@section('content')
@include('user.Search')
<div class="container mt-5">
    <div class="d-flex w-100 post-detail">
        <div class="col-8">
            @if ($post)
            <h5>{{ $post['title'] }}</h5>
            <div class="d-flex  justify-content-between">
                <span><small>{{ $post['day_create'] }}</small></span>
                <span><small><i class="fas fa-eye"></i> {{ $post['view'] }}</small></span>
            </div>
            <div class="mt-5 text-center">
                <img src="{{ asset('uploads/images/posts/'.$post['coverImage']) }}" alt="">
            </div>
            <div class="mt-5">
                {!! $post['content'] !!}
            </div>
            @endif
        </div>
        <div class="col-4"></div>
    </div>
    <div class="w-100 mt-5">
        <h5>Có thể ban quan tâm</h5><br>
        <div class="w-100 post-involve d-flex flex-wrap">
            @if ($postInvolve)
            @foreach ($postInvolve as $item)
            <div class="card m-2 " style="width: 260px;">
                <img src="{{ asset('uploads/images/posts/'.$item['coverImage']) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h6 class="card-text">
                        <a class="text-decoration-none" href="{{ route('post.show', $item['id']) }}">{{ $item['title'] }}</a>
                    </h6>
                    <span><small>Lượt xem : {{ $item['view'] }} <i class="far fa-eye"></i></small></span><br>
                    <span><small>Ngày đăng : {{ $item['day_create'] }}</small></span>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

</div>
@endsection