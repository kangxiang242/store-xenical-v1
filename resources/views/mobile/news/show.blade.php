@extends('mobile.layout')
@if($news->seo_title)
    @section('title', $news->seo_title)
@else
    @section('title', $news->title.' | 禮來犀利士台灣官網')
@endif

@if($news->seo_keyword)
    @section('keywords', $news->seo_keyword)
@endif

@if($news->seo_description)
    @section('description', $news->seo_description)
@endif
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/news-desc.css') }}?ver={{ config('app.asset_version') }}"/>
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
@stop
@section('breadcrumb')
    <ul class="breadcrumb" style="display: none">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li><a href="{{ url('news') }}">{{ $news->cate->name }}</a></li>
        <li class="active">{{ $news->title }}</li>
    </ul>
@stop

@section('banners')@stop

@section('content')
    <div class="container clearfix">

        <div class="wrap">

            <div class="news">
                <div class="news-main clearfix">
                    <img class="news-img" src="{{ asset('uploads/'.$news->img) }}" alt="{{ $news->title }}">
                    <div class="news-body">
                        <h1 class="title">{{ $news->title }}</h1>
                        <div class="source-date">
                            <a class="text-underline" href="{{ url($news->cate->uri) }}">{{ $news->cate->name }}</a>
                            <span>{{ $news->release_at->format('M') }} {{ $news->release_at->format('d') }}, {{ $news->release_at->format('Y') }}</span>
                        </div>
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
    </div>

@endsection
