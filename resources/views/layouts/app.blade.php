<!DOCTYPE html>
{{-- 这个app()函数获取的是config/app.php里面的local选项 --}}
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- 这个@yield可能跟vue里面那个自定义标签是一个意思. 第二个参数就是默认值, 没人定制就采用这个默认值 --}}
    <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>

    {{-- mix('css/app.css') 会根据 webpack.mix.js 的逻辑来生成 CSS 文件链接。 --}}
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
{{-- 自定义辅助函数, 具体见helpers --}}
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

        @include('shared._messages')

        @yield('content')

    </div>

    @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>