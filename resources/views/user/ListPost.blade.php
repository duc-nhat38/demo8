<div class=" p-2 w-100">
    <div class="text-center bg-warning p-2 rounded">
        <h5>Tin tức</h5>
    </div>
    <div class="showListPost">
        @if ($posts)
        @foreach ($posts as $item)            
        <div class="w-100 d-flex border p-1 mt-2 rounded div-hover">
            <div class="col-3 m-auto p-0">
                <img src="{{ asset('uploads/images/posts/'.$item['coverImage']) }}" alt="">
            </div>
            <div class="col-9">
                <p class="text-wrap"><a class="text-decoration-none" href="{{ route('post.show', $item['id']) }}">{{ $item['title'] }}</a></p>
                <span>Lượt xem : {{ $item['view'] }} <i class="fas fa-eye"></i></span><br>
                <span><small>Ngày đăng : {{ $item['day_create'] }}</small></span>
            </div>
        </div>
        @endforeach        
        @endif        
    </div>
    <div class="d-flex justify-content-center mt-2">
        <a href="{{ route('post.all') }}" class="btn btn-warning text-dark ">Xem thêm >></a>
    </div>
</div>

