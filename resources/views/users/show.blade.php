{{-- 首先引入layouts布局 --}}
@extends('layouts.app')

{{-- 输入title --}}
@section('title', $user->name . ' 的个人中心')

{{-- 相当于vue里面的template, 填充到父组件的内容 --}}
@section('content')

    <div class="row">

        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card ">
                <img class="card-img-top" src="{{$user->avatar}}" alt="{{ $user->name }}">
                {{--<img class="card-img-top" src="https://iocaffcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/600/h/600" alt="{{ $user->name }}">--}}
                <div class="card-body">
                    <h5><strong>个人简介</strong></h5>
                    <p>{{ $user->introduction }} </p>
                    <hr>
                    <h5><strong>注册于</strong></h5>
                    {{ $user->created_at->diffForHumans() }}
                    {{--<p>{{ $user->create_at }} </p>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    {{-- 用$user->直接读取对象属性 --}}
                    <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </div>
            </div>
            <hr>

            {{-- 用户发布的内容 --}}
            <div class="card ">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link bg-transparent {{ active_class(if_query('tab', null)) }}" href="{{ route('users.show', $user->id) }}">
                                Ta 的话题
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
                                Ta 的回复
                            </a>
                        </li>
                    </ul>
                    {{-- 这里分了个tab出来 --}}
                    @if (if_query('tab', 'replies'))
                        @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
                    @else
                        @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop