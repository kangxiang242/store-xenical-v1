<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    @if(isset($layout['seo']))
        <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @else
        <title>@yield('title')</title>
    @endif

    @hasSection('keywords')
    <meta name="keywords" content="@yield('keywords')"/>
    @else
    <meta name="keywords" content="{{ isset($layout['seo'])?$layout['seo']->key_word:"" }}"/>
    @endif

    @hasSection('description')
    <meta name="description" content="@yield('description')"/>
    @else
    <meta name="description" content="{{ isset($layout['seo'])?$layout['seo']->description:"" }}"/>
    @endif
    <link rel="canonical" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}">
    <link rel="alternate" hreflang="zh-TW">
    <link rel="shortcut icon" href="{{ \App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico' }}?ver={{ config('app.asset_version') }}">
    @section('style')
        <style>
            :root{
                --back-color: {!! app('cache.config')->get('back_color') !!};
                --main-color: {!! app('cache.config')->get('main_color') !!};
                --auxiliary-color: {!! app('cache.config')->get('auxiliary_color') !!};
                --darken-main-color: {!! colorDarken(app('cache.config')->get('main_color'),10) !!};
                --section-back-color: {!! app('cache.config')->get('index_section_color') !!};
                --font-family:{!! app('cache.config')->get('font') !!};
            }
        </style>
        {{--<link rel="stylesheet" href="{{ asset('static/font/NotoSansSC.css') }}?family=Noto+Sans+SC:100,300,400,500,700,900">--}}
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/common.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('static/less/global.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" href="{{ asset('static/font_3122894_ix34x1wtlao/iconfont.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/swiper4/swiper.min.css') }}?ver={{ config('app.asset_version') }}">

    @show

    <script src="{{ asset('static/js/jquery.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/observer.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}?ver={{ config('app.asset_version') }}"></script>

    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '{!! session()->get('flash') !!}';

        if(flash_data){
            flash_data = JSON.parse('{!! session()->get('flash') !!}');

        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("{{ \App\Services\ConfigService::get('freight_where',0) }}");
        var free_shipping_freight = parseInt("{{ \App\Services\ConfigService::get('freight',0) }}");

    </script>


    @if(!config('app.debug'))
        <script>
            var host = window.location.host;
            var current_host = "{{ config('app.url') }}"
            var host_bool = current_host.search(host) != -1;
            if(!host_bool){
                window.location.href = current_host;
            }
        </script>
    @endif
    <style type="text/css">
        {!! app('cache.config')->get('theme_css') !!}
    </style>
</head>
<body class="@yield('body-class')">

<div class="global-loading hidden" id="loading">
    <img width="50" src="{{ asset_upload(app('cache.config')->get('loading_image')) }}" alt="loading">
</div>

<div class="main-body">
@section('header')
<header class="{{ request()->path() == '/'?"ef":"" }} @yield('header-class')">
    <div class="wrapper">
        <div class="logo-sec">
            <a href="{{ url('/') }}" class="lds-logo-lilly logo-red">
                <img height="100%" src="{{ app('cache.config')->get('logo')?asset_upload(app('cache.config')->get('logo')):asset('static/img/logo.jpg') }}" alt="{{ app('cache.config')->get('site_name') }}">
            </a>
        </div>
        <div class="drawer-btn">
            <i class="iconfont">&#xe62c;</i>
        </div>
        <div class="nav-sec">
            <ul class="base">
                @foreach($layout['nav'] as $nav)
                <li class="link-parent">
                    <a class="base-link {{ request()->path()==trim($nav->link,'/')?"activate":"" }}" href="{{ url($nav->link) }}">{{ $nav->name }}</a>
                </li>
                @endforeach
                <li class="link-parent pc-hide">
                    <a class="base-link" href="/payment-delivery">付款與配送</a>
                </li>
                <li class="link-parent pc-hide">
                    <a class="base-link" href="/after-sales">售後服務</a>
                </li>
            </ul>
            <div class="online"><a href="{{ url('product') }}">減肥藥購買</a></div>
        </div>
    </div>

</header>
@show


@section('banners')

    @if($layout['banners'] && !$layout['banners']->isEmpty())
        <section class="banner-section">
            <div class="banner-content">
                <div class="vis">
                    <div class="inner" style="background-image: url('{{ asset_upload($layout['banners']->first()->img) }}')"></div>

                </div>
                <div class="rep">
                    <p class="rep-sub">@yield('topic-sub')</p>
                    @hasSection('topic-title-p')
                        <p class="rep-title">@yield('topic-title')</p>
                    @else
                        <h1 class="rep-title">@yield('topic-title')</h1>
                    @endif

                    @yield('breadcrumb')

                </div>
            </div>
            @yield('banner-section-append')
        </section>
    @endif

@show



@yield('content')


@section('footer')
<footer>

    <div class="footer-inner">
        <div class="footer-nav">


            <ul class="menu-list">
                <li><a href="{{ url('product') }}">減肥藥購買</a></li>
                <li><a href="{{ url('news') }}" >{{ app('cache.config')->get('site_name') }}資訊</a></li>

                <li><a href="{{ url('check') }}">訂單查詢</a></li>

                <li><a href="{{ url('guide') }}" >訂購指南</a></li>

                <li><a href="{{ url('message') }}">聯繫我們</a></li>

                <li><a href="{{ url('payment-delivery') }}">付款與配送</a></li>

                <li><a href="{{ url('after-sales') }}">售後服務</a></li>

            </ul>
            <div class="office">

                {!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('foot_text')) !!}
            </div>

        </div>
    </div>
    <p class="copyright">{!! app('cache.config')->get('copyright') !!}</p>
    <p class="spot">{{ app('cache.config')->get('site_name_en') }}</p>
</footer>
@show
</div>
</body>

@section('script')
<script src="{{ asset('static/js/less.min.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/swiper4/swiper.min.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/js/jquery.cookie.js') }}?ver={{ config('app.asset_version') }}"></script>
<script src="{{ asset('static/js/xie.js') }}?ver={{ config('app.asset_version') }}"></script>

{!! \App\Services\ConfigService::get('google_ga') !!}

<script>
    function loading(is_show){
        if(is_show){
            $('body').addClass('_show_loading');
        }else{
            $('body').removeClass('_show_loading');
        }

    }
    $(document).scroll(function() {
        var scroH = $(document).scrollTop();  //滚动高度
        var viewH = $(window).height();  //可见高度
        var contentH = $(document).height();  //内容高度

        if(scroH>100){
            $('header').addClass('fixed')

        }

        if(scroH<100){
            $('header').removeClass('fixed')
        }

    });
    $('.drawer-btn').click(function(){
        if($('.nav-sec').hasClass('m-show')){
            $('.nav-sec').removeClass('m-show')
            $(this).find('i').html('&#xe62c;')
        }else{
            $('.nav-sec').addClass('m-show')
            $(this).find('i').html('&#xeca0;')
        }
    });
</script>
@show

</html>
