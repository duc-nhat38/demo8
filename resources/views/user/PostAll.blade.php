@extends('layouts.HomePage')

@section('title', "Tin tức")

@section('content')
@include('user.Search')
<div class="container d-flex showListPost mt-5">
    
        <div class="col-8 p-0">
            <div class="text-center bg-warning p-2 rounded">
                <h5>Tin tức:</h5>
            </div>
            @foreach ($posts as $item)
            <div class="w-100 d-flex border p-1 mt-2 rounded div-hover ml-0">
                <div class="col-3 m-auto p-0">
                    <img src="{{ asset('uploads/images/posts/'.$item['coverImage']) }}" alt="">
                </div>
                <div class="col-9 p-0">
                    <p class="text-wrap"><a class="text-decoration-none"
                            href="{{ route('post.show', $item['id']) }}">{{ $item['title'] }}</a></p>
                    <span><small>Lượt xem : {{ $item['view'] }} <i class="fas fa-eye"></i></small></span><br>
                    <span><small>Ngày đăng : {{ $item['day_create'] }}</small></span>
                </div>
            </div>
            @endforeach
            <div>
                {{ $posts->links() }}
            </div>
        </div>
        <div class="col-4 ml-2">
            @include('user.BarSelect')
        </div>
   
</div>
@endsection