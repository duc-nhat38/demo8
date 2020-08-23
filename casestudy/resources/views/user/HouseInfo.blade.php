@extends('layouts.HomePage')

@section('content')
<div class="container pt-5">
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
                        <img src="{{ asset('uploads/'.$house['photos'][0]['photoAddress']) }}" class="d-block w-100"
                            alt="...">
                    </div>
                    @for ($i = 1; $i < count($house['photos']); $i++) 
                    <div class="carousel-item" data-interval="3000">
                        <img src="{{ asset('uploads/'.$house['photos'][$i]['photoAddress']) }}" class="d-block w-100" alt="...">
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
                        <img src="{{ asset('uploads/'.Auth::user()->information->avatar) }}" alt="avatar"
                            class="rounded-circle">
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
<script>
    var house = house || {};
        house.user = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('show.user') }}",
                data: {
                    id: $('#userHouse').attr('data-id'),
                },
                dataType: "json",
                success: function (data) {
                    let phone = (data.phone != null)?data.phone:'Chưa cập nhật';
                    let role = (data.role != 0)?'text-success':'text-dark';
                    $('#userHouse').append(`
                    
                    <div class="d-flex row ">
                    <div class="col-2 d-flex align-items-center">
                        <img src="{{ asset('uploads/${data.avatar}') }}" alt="" class="rounded-circle image-center">
                    </div>
                    <div class="p-2 col-9">
                        <p><a href="">${data.name}</a>  <i class="fas fa-check-circle ${role}"></i></p>
                        <div class="d-flex justify-content-between">
                            <span class="border rounded border-warning p-2 text-decoration-none"><a href="mailto:${data.email}"><i class="far fa-envelope"></i> ${data.email}</a></span>
                            <span class="border rounded border-warning p-2 text-decoration-none"><a href="tel:+84${phone}"><i class="fas fa-mobile-alt"></i> ${phone}</a></span>
                        </div>
                    </div>
                </div>
                    `);
                }
            });
        }

        var comment = comment || {};
        comment.getCmtHouse = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('house.comments') }}",
                data: {
                    id: $('#commentHouse').attr('data-id'),
                },
                dataType: "json",
                success: function (data) {     
                    $('#listComment').empty();       
                    $.each(data, function (i, value) {
                        let id = $('#btnComment').data('id');
                        let action = '<div></div>' ;
                        if(id == value.user_id){
                            action = `
                            <div class="d-flex">
                                <a href="javascript:;" onclick="comment.edit(this)" class="mr-2"><i class="far fa-edit text-success"></i></a>
                                <a href="javascript:;" data-id="${value.id}" onclick="comment.delete(this)"><i class="far fa-trash-alt text-danger"></i></a>
                            </div>
                            `
                        }
                        
                        $('#listComment').append(`
                            <div class="d-flex p-2 my-2 border rounded position-relative">
                                <div class="col-1 p-0 d-flex align-items-center">
                                    <img src="{{ asset('uploads/${value.avatar}') }}" alt="" class="rounded-circle">
                                </div>
                                <div class="col-11 ml-1 pl-4 content-comment" data-id="${value.id}">
                                    <div class="d-flex justify-content-between">
                                        <span><a href="">${value.name}</a></span>
                                        ${action}
                                    </div>
                                    <span class="valueContent">${value.content}</span><br>
                                    <small>${value.day_create}</small>
                                </div>

                            </div>
                        `);
                    });
                }
            });
        }

        comment.create = function(data){
            if($('#btnComment').data('id') != 0){
                let content = $('#myComment').val();
                if(content){
                    let id = $(data).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('comment.house') }}",
                    data: {
                        user_id: id,
                        house_id: $('#commentHouse').attr('data-id'),
                        content: content,
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#myComment').val('');
                        comment.getCmtHouse();
                        toastr["success"]("Đã đăng bình luận!")
                    }
                });
                }else{
                    toastr["warning"]("Chưa nhập bình luận.");
                }
            }else{
                toastr["warning"]("Chưa đăng nhập .");
            }
        }
        comment.edit = function(data){
                let text = $(data).closest('.content-comment').children('.valueContent').text();
                let a = $(data).closest('.content-comment');
                a.empty();
                a.append(`
                <textarea class="form-control" rows="2" id="editComment"
                    placeholder="Thêm bình luận ..."></textarea>
                    <div class="d-flex justify-content-between w-100">
                        <button class="btn btn-secondary" onclick="comment.getCmtHouse()">Đóng</button>
                        <button class="btn btn-warning mt-1" data-id="{{ Auth::user()->id ?? 0 }}" onclick="comment.editComment(this)">Bình luận</button>
                    </div>                
           `);
            $('#editComment').val(text);
        }

        comment.editComment = function(data){
            console.log();
            let content = $('#editComment').val();
            if(content){
            $.ajax({
                type: "PUT",
                url: "{{ route('comment.edit') }}",
                data: {
                    id: $('.content-comment').data('id'),
                    content: content,
                },
                dataType: "json",
                success: function (response) {
                    $('#editComment').val('');
                    comment.getCmtHouse();
                    toastr["success"]("Đã đăng bình luận!")
                }
            });
            }else{
                toastr["warning"]("Chưa nhập bình luận.");
            }
        }

        comment.delete = function(data){
            bootbox.confirm({ 
                size: "small",
                message: "Bạn muốn xóa?",
            callback: function (result) {
                    if(result){
                        let id = $(data).data('id');
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('comment.delete') }}",
                            data: {
                                id: id,
                            },
                            dataType: "json",
                            success: function (data){
                                comment.getCmtHouse();
                                if(data == true){
                            toastr["warning"]("Đã xóa bình luận!")
                                }
                    
                            }
                        });
                    }
                }
            });
        }


        var vote = vote || {};
        
        vote.getRateHouse = function(){
            $.ajax({
                type: "GET",
                url: "{{ route('house.votes') }}",
                data: {
                    house_id: $('#commentHouse').data('id'),
                },
                dataType: "json",
                success: function (data) {                    
                    if(data['total'] != null){
                        
                        let point = (data.total/data.count).toFixed(1);
                        let result = point;                        
                        let calculatePoint = point.split('.');                                            
                        if(calculatePoint[1] == 5 ){
                            for(let k = 0; k < result; k++){
                                $(`.point i[data-point="${k+1}"]`).removeClass('far');
                                $(`.point i[data-point="${k+1}"]`).addClass('fas');
                            }
                            result =Math.round(point);
                            $(`.point i[data-point="${result}"]`).removeClass('far fa-star');
                            $(`.point i[data-point="${result}"]`).addClass('fas fa-star-half-alt');
                            
                        }else{
                            if(calculatePoint[1] > 5){
                                result = Math.round(point);
                                for(let k = 1; k <= result; k++){
                                    $(`.point i[data-point="${k}"]`).removeClass('far');
                                    $(`.point i[data-point="${k}"]`).addClass('fas');
                                }
                            }else{
                                result = Math.floor(point);
                                for(let k = 1; k <= result; k++){
                                    $(`.point i[data-point="${k}"]`).removeClass('far');
                                    $(`.point i[data-point="${k}"]`).addClass('fas');
                                }
                                
                            }
                        }
                        if(result < 5){
                            for(let i = result + 1; i <= 5; i++){
                                    $(`.point i[data-point="${i}"]`).removeClass('fas');
                                    $(`.point i[data-point="${i}"]`).addClass('far');
                                }
                        }
                        $('.point i .fas').css('color', '#ffc107');
                        $('#total').text(`${data.count} lượt đánh giá .`)
                    }
                }
            });
        }

        vote.getMyVote = function(){
            if($('#voteHouse').data('id') != 0){
                $.ajax({
                type: 'GET',
                url: "{{ route('house.vote') }}",
                data: {
                    user_id: $('#voteHouse').data('id'),
                    house_id: $('#commentHouse').data('id'),
                },
                dataType: "json",
                success: function (data) {
                    if(data != false){
                        let point = data.point;
                        for(let k = 1; k<= point; k++){
                            $(`.stars i[data-id='${k}']`).removeClass('far');
                            $(`.stars i[data-id='${k}']`).addClass('fas');
                            $(`.stars i[data-id='${k}']`).css('color', '#ffc107');
                        }
                        if(point < 5){
                            for(let i = point + 1; i <= 5; i++){
                                $(`.stars i[data-id='${i}']`).removeClass('fas');
                                $(`.stars i[data-id='${i}']`).addClass('far');
                                $(`.stars i[data-id='${i}']`).css('color', 'black');
                            }
                        }
                        $('#vote-desc').text('Cảm ơn đã đánh giá !');
                        $('#cate-rating .star i').hover(function(){
                                let number = $(this).data('id');
                                for(let k = 1; k <= number; k++ ){
                                    $(`.star i[data-id='${k}']`).css('color', '#ffc107');
                                }
                            },
                            function(){
                                $('.star i.fas').css('color', '#ffc107');
                                $('.star i.far').css('color', 'black');
                            }
                            
                        );
                    }
                }
            });
            }
            
        }

        vote.rating = function(data){
            if($('#voteHouse').data('id') != 0){
                    let rate = $(data).children('i:first').data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('vote.house') }}",
                    data: {
                        rate: rate,
                        user_id: $('#voteHouse').data('id'),
                        house_id: $('#commentHouse').data('id'),
                    },
                    dataType: "json",
                    success: function (data) {
                        vote.getMyVote();
                        vote.getRateHouse();
                        toastr["success"]("Thank you!");
                    }
                });
            }else{
                toastr["warning"]("Bạn chưa đăng nhập.");
            }
            
        }

        $(document).ready(function () {
            house.user();
            comment.getCmtHouse();
            vote.getRateHouse();
            vote.getMyVote();
            $('.star i').hover(function(){
                    let number = $(this).data('id');
                    for(let k = 1; k <= number; k++ ){
                        $(`.star i[data-id='${k}']`).css('color', '#ffc107');
                    }
                },
                function(){
                    $('.star i').css('color', 'black');
                }
            );
        });
</script>
@endpush