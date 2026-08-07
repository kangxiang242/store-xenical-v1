@extends('web.layout')

@section('style')
    @parent
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news-desc.css') }}?ver={{ config('app.asset_version') }}"/>--}}
    <style>
        .news-body .news-content a {
            color: var(--main-color) !important;
        }
        .page-item{
            margin-bottom: 40px;
        }
        .page-item .list li{
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }
        .page-item .list li .info-wrap{
            margin-left: 20px;
        }
    </style>
@stop


@section('title-before','網站地圖')
@section('topic-title','網站地圖')
@section('topic-sub','sitemap')
@section('header-class','sticky')

@section('content')

    <div class="container no-curtain">

        <div class="main">
            <div class="wrap">
                <div class="news-body">


                    <h2 class="title">網站地圖</h2>

                    <div class="news-content">
                        <div class="p_list">
                            <div class="list_cont">
                                <div class="showcont">
                                    <div class="page_editor">

                                        <div class="page-item">
                                            <h3>產品</h3>
                                            <p><a style="margin-right:10px;" href="/goods/">{{ app('cache.config')->get('site_name') }}訂購</a></p>
                                        </div>

                                        <div class="page-item">
                                            <h3>文章</h3>
                                            <p>
                                                @foreach($article_cate as $cate)
                                                    <a style="margin-right:10px;" href="{{ url($cate->uri) }}">{{ $cate->name }}</a>
                                                @endforeach

                                                <a style="margin-right:10px;" href="{{ url('news') }}">相關資訊</a>
                                            </p>
                                        </div>

                                        <div class="page-item">
                                            <h3>頁面</h3>
                                            <p>
                                                @foreach($pages as $page)
                                                <a style="margin-right:10px;" href="{{ url($page->uri) }}">{{ $page->title }}</a>
                                                @endforeach
                                            </p>
                                        </div>
                                        <div class="page-item">
                                            <h3>其他</h3>
                                            <p>
                                                <a style="margin-right:10px;" href="/">首頁</a>
                                                <a style="margin-right:10px;" href="/guestbook/">在線諮詢</a>
                                                <a style="margin-right:10px;" href="/check/">訂單查詢</a>
                                                <a style="margin-right:10px;" href="/sitemap/">網站地圖</a>
                                            </p>
                                        </div>

                                        <div class="page-item">
                                            <h2 style="font-weight:bold;">「{{ app('cache.config')->get('site_name') }}產品展示」</h2>
                                            <ul class="list">
                                                @foreach($products as $goods)
                                                <li>

                                                    <div class="img-wrap"><img src="{{ asset_upload($goods->img) }}" alt="{{ strip_tags($goods->name) }}" width="205px"></div>

                                                    <div class="info-wrap">
                                                        <h2>{!! $goods->name !!}</h2>
                                                        <p class="p_tips">包裝絕對隱密外觀絕無與{{ app('cache.config')->get('site_name') }}相關之任何字樣，宅配人員並不會知道您所訂購的商品，請安心選購</p>
                                                        <p class="yj">原價：<font>NT${{ $goods->market_price }}</font></p>
                                                        <p>
                                                            <span class="pice">NT${{ $goods->price }}</span>
                                                        </p>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- //showcont -->
                            </div>
                            <!--//list_cont -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




@endsection
