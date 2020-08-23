@extends('layouts.HomePage')

@section('content')
@include('user.Search')
<div class="container m-auto banner-slide mt-3">
    @include('user.Banner')
</div>
<div class="container bg-light content-house">
    <div class="">
        @include('user.ListHouse')
    </div>
    <div class="w-100 d-flex">
        <div class="col-8">
            @include('user.ListPost')
        </div>
        <div class="col-4 p-2">
            @include('user.BarSelect')
        </div>
    </div>
</div>
@endsection
