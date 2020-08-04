<div class="logo-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light row justify-content-md-center">
        <div class="col col-lg-2">
            <a class="navbar-brand" href="#">
                <img src="https://mayanhxachtaynhat.com/wp-content/uploads/2018/12/lay-net-01.png" width="30"
                    height="30" alt="">
            </a>
        </div>
        <div class="collapse navbar-collapse col-md-auto" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">TRANG CHỦ <span class="sr-only">(current)</span></a>
                </li>
                @if (!empty($businessType))

                @foreach ($businessType as $item)
                <li class="nav-item active">
                    <a class="nav-link" href="#">{{ $item['typeName'] }}</a>
                </li>
                @endforeach

                @endif
                <li class="nav-item active">
                    <a class="nav-link" href="#">TIN TỨC</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item active">
                    <a class="nav-link" href="#" title="Đăng nhập"><i class="fas fa-user-circle"></i></a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item active">
                    <a class="nav-link" href="#">Đăng ký</a>
                </li>
                @endif
                @else
                <li class="nav-item active">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#"><i class="far fa-address-card"></i><span>Thông tin cá
                                    nhân</span></a>
                            <a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i>Thay đổi mật khẩu</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-crown"></i><span>VIP</span></a>
                            <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i><Span>Đăng
                                    xuất</Span></a>
                        </div>
                    </div>
                </li>
                @endguest
                <li class="nav-item active">
                    <a class="nav-link disabled btn button" href="#">ĐĂNG TIN</i></a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="search">
    <nav class="navbar navbar-dark bg-dark row" id="search">
        <select class="custom-select col">
            <option selected>Thể loại</option>
            @if (!empty($businessType))
            @foreach ($businessType as $item)

            <option value="{{ $item['id'] }}">{{ $item['typeName'] }}</option>

            @endforeach
            @endif
        </select>
        <select class="custom-select col" id="address">
            <option selected>Tỉnh / Thành</option>
            {{-- @if (!empty($listAddress))
                onchange="selectAddress()"
            @foreach ($listAddress as $item)
            <option value="{{ $item['id'] }}" >{{ $item['address'] }}</option>
            @endforeach
            @endif --}}
        </select>
        <select class="custom-select col" id="district" onchange="selectDistrict()">
            <option selected>Quận / Huyện</option>
            @if (!empty($listAddressDetails))
            @foreach ($listAddressDetails as $item)
            <option value="{{ $item['id'] }}">{{ $item['address'] }}</option>
            @endforeach
            @endif
        </select>
        <select class="custom-select col">
            <option selected>Diện tích</option>
            <option value="1">Dưới 20 m2</option>
            <option value="2">20 m2 - 30 m2</option>
            <option value="3">30 m2 - 40 m2</option>
            <option value="4">40 m2 - 50 m2</option>
            <option value="5">50 m2 - 100 m2</option>
            <option value="6">Lớn hơn 100 m2</option>
        </select>
        <button class="btn btn-warning"><i class="fas fa-search"></i></button>
    </nav>
</div>

@push('header')
<script>
    // function selectAddress(){
        //     let id = $('#address').val();

        // //     return id;
        // //     // $.ajax({
        // //     //     dataType: "json",
        // //     //     url: "http://127.0.0.1:8000/api/getaddressdetails/" + id,
        // //     //     success: function (data){
        // //     //         $('#district').empty();
        // //     //         $.each(data, function (i, item) {
        // //     //             $('#district').append($('<option>', { 
        // //     //                 value: item.id,
        // //     //                 text : item.address 
        // //     //             }));
        // //     //         });
        // //     //     }
        // //     // });
        // return id;
        // }
        
        function getAddress(){
            $.ajax({
                dataType: "json",
                url: "http://127.0.0.1:8000/api/listadress",
                success: function (data){
                    // console.log(data);
                    $.each(data, function (i, item) {
                        $('#address').append($('<option>', { 
                            value: item.id,
                            text : item.address 
                        }));
                    });

                return data;
                }
            });
        
        }
        
        
        function getAddressDetails(){
            $.ajax({
                dataType: "json",
                url: "http://127.0.0.1:8000/api/listaddressdetails",
                success: function (data){
                    // console.log(data);
                    $.each(data, function (i, item) {
                        $('#district').append($('<option>', { 
                            value: item.id,
                            text : item.address 
                        }));
                    });

                }
            });
        }

    $(document).ready(function() {
        getAddress();
        getAddressDetails();
       
    });




</script>
@endpush