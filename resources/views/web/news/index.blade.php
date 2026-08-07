@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/news.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/pagination.css') }}?ver={{ config('app.asset_version') }}"/>
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


@section('title-before',$cate?$cate->name:"相關資訊")
@section('topic-title',$cate?$cate->name:"相關資訊")
@section('topic-sub',$cate?$cate->sub_name:"NEWS")

@section('banner-section-append')
    <div class="elevator">
        <a href="{{ url('product') }}">
            <p class="p1">購買{{ app('cache.config')->get('site_name') }}</p>
            <p class="ico"><i class="iconfont">&#xeb21;</i></p>
        </a>
    </div>
@stop

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首页</a></li>
        <li class="active">{{ $cate->name }}</li>
    </ul>
@stop

@section('content')
    <div class="container no-curtain">

        <div class="main">
            <div class="news-body">

                <ul class="news">
                    @foreach($news as $item)
                        <li class="item">

                            <a class="ls" href="{{ url($item->cate->uri.'/'.$item->id) }}">
                                <div class="yiv">
                                    @if($item->img)
                                    <div class="img-wrapper"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->img_alt?:$item->title }}"></div>
                                    @endif
                                    <div class="info">
                                        {{--<p class="date">{{$item->release_at->format('Y-m-d') }}</p>--}}
                                        <p class="new-title">{{ $item->title }}</p>
                                    </div>
                                    <div class="go"><span>more</span></div>
                                </div>

                            </a>

                        </li>
                    @endforeach
                </ul>
                <div class="pagination">
                    {!! $news->links() !!}
                </div>

            </div>
        </div>
    </div>



@endsection
