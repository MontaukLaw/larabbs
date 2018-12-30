<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand " href="{{ url('/') }}">
            LaraBBS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- 导航栏左边 -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ active_class(if_route('topics.index')) }}">
                    <a class="nav-link" href="{{ route('topics.index') }}">话题</a>
                </li>
                <li class="nav-item {{ category_nav_active(1) }}">
                    <a class="nav-link" href="{{ route('categories.show', 1) }}">分享</a>
                </li>
                <li class="nav-item {{ category_nav_active(2) }}">
                    <a class="nav-link" href="{{ route('categories.show', 2) }}">教程</a>
                </li>
                <li class="nav-item {{ category_nav_active(3) }}">
                    <a class="nav-link" href="{{ route('categories.show', 3) }}">问答</a>
                </li>
                <li class="nav-item {{ category_nav_active(4) }}">
                    <a class="nav-link" href="{{ route('categories.show', 4) }}">公告</a>
                </li>

                @if (isset($categories))
                    @foreach ($categories as $category)
                        <li class="nav-item"> {{ $category->name }}</li>
                    @endforeach
                @endif
            </ul>

            <!-- 导航栏右边 -->
            <ul class="navbar-nav navbar-right">
                <!-- 认证链接 -->
                {{--<li class="nav-item"><a class="nav-link" href="{{route('login')}}">登录</a></li>--}}
                {{--<li class="nav-item"><a class="nav-link" href="{{route('register')}}">注册</a></li>--}}
                {{-- 如果是游客, 就保持原来的状态, 如果登陆了, 就无需再注册啊登陆之类, 直接显示下弹框--}}
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                @else
                    {{-- 发帖链接 --}}
                    <li class="nav-item">
                        <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{Auth::user()->avatar}}" class="img-responsive img-circle" width="30px"
                                 height="30px">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">个人中心</a>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">编辑资料</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="#">
                                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                </form>
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>