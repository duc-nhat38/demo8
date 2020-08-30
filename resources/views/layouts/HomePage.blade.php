<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{!! asset("uploads/images/LogoFavicon.png") !!}">
    <title>@yield('title', 'Trang chủ')</title>
    @include('partials.Head')
</head>
<body class="bg-light w-100" >
       
    <div class="header border-bottom border-dark">
        @include('user.Header')
    </div>
    
    <div class="content w-100" style="padding-top: 68px;">
        @yield('content')
    </div>
    
    <div class="footer">
        @include('user.Footer')
    </div>
    @include('partials.Js')
</body>
</html>