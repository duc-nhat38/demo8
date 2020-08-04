<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Trang chủ')</title>
    @include('partials.Head')
</head>
<body>
    <div class="header">
        @include('user.Header')
    </div>
    <div class="content">
        @yield('content')
    </div>

    @include('partials.Js')
</body>
</html>