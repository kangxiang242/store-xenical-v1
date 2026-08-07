@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/product.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        .g-icons{
            justify-content: space-around;
        }
        .g-icons li{
            margin-right: 20px;
        }
        .g-icons li .p2 {
            font-size: 14px;
        }
        @media screen and (max-width: 1024px){
            .g-icons li{
                margin-right: 0;
            }

        }
    </style>
@stop

@php
    $privacy_text = str_replace(PHP_EOL,"<br>",app('cache.config')->get('privacy_text'));
@endphp
@section('title-before',app('cache.config')->get('site_name').'訂購')
@section('topic-title','減肥藥購買')
@section('topic-sub','SHOPPING ONLINE')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首页</a></li>
        <li class="active">減肥藥購買</li>
    </ul>
@stop
@section('content')


    <div class="container">
        <div class="intro">
            <p class="text">
                {!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('contact_page_text')) !!}
            </p>
        </div>
        <div class="main">
            <div class="wrap">

                <div class="product-body">
                    @php
                        $product_spec = app('cache.config')->get('product_spec');
                        $product_component = app('cache.config')->get('product_component');
                        $product_manufacturer = app('cache.config')->get('product_manufacturer');
                        $product_valid = app('cache.config')->get('product_valid');
                    @endphp
                    @foreach($products as $goods)
                        <div class="goods">
                            <div class="img-wrap">
                                <a href="{{ url('product/'.$goods->id) }}"><img src="{{ asset_upload($goods->img) }}" alt="{{ strip_tags($goods->name) }}"></a>
                            </div>
                            <div class="info">
                                <div class="base">
                                    <a href="{{ url('product/'.$goods->id) }}"><h2 class="name">{!! str_replace("<br />"," ",$goods->name) !!}</h2></a>
                                    <div class="spec">
                                        <p class="item">【規格】{{ $product_spec }}</p>
                                        <p class="item">【成份】{{ $product_component }}</p>
                                        <p class="item">【產地】{{ $product_manufacturer }}</p>
                                        <p class="item">【有效期】{{ $product_valid }}</p>
                                    </div>
                                    {{--<p class="secret">{!! $privacy_text !!}</p>--}}
                                    <div class="secret">
                                    <ul class="g-icons">

                                        <li>
                                            <p class="p1"><i class="iconfont">&#xeb67;</i></p>
                                            <p class="p2">官方正品</p>
                                        </li>

                                        <li>
                                            <p class="p1"><i class="iconfont">&#xebb9;</i></p>
                                            <p class="p2">隱密包裝</p>
                                        </li>

                                        <li>
                                            <p class="p1"><i class="iconfont">&#xe60f;</i></p>
                                            <p class="p2">當天出貨</p>
                                        </li>

                                        <li>
                                            <p class="p1"><i class="iconfont">&#xe63f;</i></p>
                                            <p class="p2">鄉民推薦</p>
                                        </li>

                                        <li>
                                            <p class="p1"><i class="iconfont">&#xe624;</i></p>
                                            <p class="p2">免費換貨</p>
                                        </li>

                                        <li>
                                            <p class="p1"><i class="iconfont">&#xe88c;</i></p>
                                            <p class="p2">安全結賬</p>
                                        </li>

                                    </ul>
                                    </div>
                                </div>

                                <div class="buy">
                                    <div class="price">
                                        <span class="now">NT${{ number_format(round($goods->price)) }}</span>
                                        @if($goods->market_price>$goods->price)
                                        <span class="market">NT${{ number_format(round($goods->market_price)) }}</span>
                                        @endif
                                    </div>
                                    <p class="go-btn"><a href="{{ url('shopping/'.$goods->id) }}"  data-observer="點擊購買-{{ $goods->name }}">點擊購買</a></p>
                                </div>

                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="product-description">
                    <p class="description-warp">
                        {!! app('cache.config')->get('product_page_text2') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>


@endsection
