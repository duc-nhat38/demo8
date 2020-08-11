<div class="logo-navbar">
    <nav class="navbar navbar-expand-sm bg-light navbar-light">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">
            <img src="bird.jpg" alt="logo" style="width:40px;">
        </a>
    
        <!-- Links -->
        <ul class="nav nav-tabs navbar-nav text-uppercase">
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
                <a class="nav-link" href="{{ route('login') }}" title="Đăng nhập"><i class="fas fa-user-circle"></i></a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
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
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i><Span>Đăng
                                xuất</Span></a>
                    </div>
                </div>
            </li>
            @endguest
            <li class="nav-item active">
                <a class="nav-link disabled btn button" href="#">ĐĂNG TIN</i></a>
            </li>
        </ul>
        
    </nav>
</div>