@extends('layouts.HomePage')

@section('content')
<div class="container">
    <div class="d-flex w-100 post-detail">
        <div class="col-8">
            @if ($post)
            <h3>{{ $post['title'] }}</h3>
            <div class="d-flex  justify-content-between">
                <span><small>{{ $post['day_create'] }}</small></span>
                <span><small><i class="fas fa-eye"></i> {{ $post['view'] }}</small></span>
            </div>
            <div class="mt-5 text-center">
                <img src="{{ $post['coverImage'] }}" alt="">
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
                <img src="{{ $item['coverImage'] }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h6 class="card-text">
                        <a class="text-decoration-none" href="{{ route('post.show', $item['id']) }}">{{ $item['title'] }}</a>
                    </h6>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

</div>
@endsection