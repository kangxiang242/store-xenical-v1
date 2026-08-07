@extends('web.layout')
@if($news->seo_title)
    @section('title', $news->seo_title)
@else
    @section('title', $news->title)
@endif

@if($news->seo_keyword)
    @section('keywords', $news->seo_keyword)
@endif

@if($news->seo_description)
    @section('description', $news->seo_description)
@endif
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news-desc.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        @media screen and (min-width: 1024px) {
            .guide-scroll{
                display: none;
            }
        }
    </style>
@stop

@section('script')
    @parent
    <script>
        document.domain = "{{ getMainDomain() }}";
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }}
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>
    <script>

        $(document).ready(function(){
            const $ScrollWrap = $(window)
            // 监听滚动停止
            let t1 = 0;
            let t2 = 0;
            let timer = null; // 定时器
            $ScrollWrap.on("touchstart", function(){

                // 触摸开始 ≈ 滚动开始
            })
            $ScrollWrap.on("scroll", function(){
                $('.elevator').addClass('slipOut')

                // 滚动
                clearTimeout(timer)
                timer = setTimeout(isScrollEnd, 300)
                t1 = $ScrollWrap.scrollTop()
                if(t1<=0){

                }else{

                }
            })
            function isScrollEnd() {
                t2 = $ScrollWrap.scrollTop();
                if(t2 == t1){
                    $('.elevator').removeClass('slipOut')

                    clearTimeout(timer)
                }

            }


        })
    </script>
@stop

@section('topic-title',$news->cate->name)
@section('topic-sub',$news->cate->sub_name)
@section('topic-title-p',1)

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首页</a></li>
        <li><a href="{{ url('news') }}">{{ $news->cate->name }}</a></li>
        <li class="active">{{ $news->title }}</li>
    </ul>
@stop

@section('banner-section-append')
    <div class="elevator">
        <a href="{{ url('product') }}">
            <p class="p1">購買{{ app('cache.config')->get('site_name') }}</p>
            <p class="ico"><i class="iconfont">&#xeb21;</i></p>
        </a>
    </div>
@stop

@section('content')

    <div class="container no-curtain">

        <div class="main">
            <div class="wrap">
                <div class="news-body">
                    <h1 class="title">{{ $news->title }}</h1>
                    <div class="news-content">
                        @if($news->html_file)
                            <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload(str_replace('.zip','',$news->html_file).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                        @else
                            {!! $news->content !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
