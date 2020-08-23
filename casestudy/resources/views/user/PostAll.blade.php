@extends('layouts.HomePage')

@section('content')
<div class="container">
    <div class="text-center bg-warning p-2 rounded">
        <h5>Tin tức:</h5>
    </div>
    <div class="w-100 d-flex showListPost">
        <div class="col-8">
            @foreach ($posts as $item)            
        <div class="w-100 d-flex border p-1 mt-2 rounded div-hover">
            <div class="col-3 m-auto">
                <img src="{{ $item['coverImage'] }}" alt="">
            </div>
            <div class="col-9">
                <p class="text-wrap"><a class="text-decoration-none" href="{{ route('post.show', $item['id']) }}">{{ $item['title'] }}</a></p>
                <span>Lượt xem : {{ $item['view'] }} <i class="fas fa-eye"></i></span><br>
                <span><small>Ngày đăng : {{ $item['day_create'] }}</small></span>
            </div>
        </div>
        @endforeach 
        <div>
            {{ $posts->links() }}
        </div>
        </div>
        <div class="col-4 p-2">
            @include('user.BarSelect')
        </div>
    </div>
</div>
@endsection