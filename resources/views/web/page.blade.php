@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/page.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        .container .intro{
            padding-top: 0px;
        }
        .container:before{
            background-color: var(--main-color);
        }
        .pc-flex{
            display: flex;
            width: 72vw;
            margin: 0 auto;
            margin-bottom: 60px;

        }
        .g-icons{
            width: 50%;
            flex-shrink: 0;
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-around;
        }


        .g-icons li .p1{
            border-color: #fff;
            color: #fff;
        }
        .g-icons li .p2{
            font-size: 20px;
            color: #fff;
        }
        @media screen and (max-width: 1024px){
            .pc-flex{
                width: 100%;
                flex-direction: column;
                padding: 0 2vw;
                margin-bottom: 40px;
            }
            .g-icons{
                width: 100%;

            }

            .g-icons li .p2{
                font-size: 14px;
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


@stop
@section('title-before',$page->title)
@section('topic-title',$page->title)
@section('topic-sub',$page->en_title)
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首页</a></li>
        <li class="active">{{ $page->title }}</li>
    </ul>
@stop
@section('content')


    <div class="container">
        <div class="intro">
            <p class="text">
                {!! str_replace(PHP_EOL,"<br>",$page->desc) !!}
            </p>
        </div>
        <div class="pc-flex">
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
            </ul>
            <ul class="g-icons">

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
        <div class="main">
            <div class="wrap">
                <div class="page-body">


                    <h2 class="title">{{ $page->title }}</h2>

                    <div class="news-content">
                        @if(isset($html_code) && $html_code)
                            <iframe  id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload('article_html/'.str_replace('.zip','',$html_code).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
                        @else
                            {!! $page->content !!}
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>




@endsection
