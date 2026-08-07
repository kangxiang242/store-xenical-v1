@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/index.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        .g-icons li{
            margin-right: 16px;
        }
        @media screen and (max-width: 1024px){
            .g-icons {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                transform: translateX(-16px);
            }
            .g-icons li{
                margin-right: 0;
            }
        }


    </style>
@stop
@section('body-class','_show_loading')
@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('static/js/jquery.marquee.min.js') }}"></script>
    <script>
        $(function(){
            $('#loading').animate({'visibility':'auto'},1000,function(){
                $('header').addClass('shown')
                $('#carouselMain').addClass('shown')

                loading(0)


            });

        });

        $('.scroll-target').waypoint(function(e) {
            $($(this)[0].element).addClass('show')

        }, { offset: '80%' });

    </script>
    <script>
        $('#loopWrap').marquee({
            //duration in milliseconds of the marquee

            speed:30,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover:true,
            startVisible:true,

        });


    </script>
    <script>
        $('.faq-item').click(function () {
            if($(this).find('.faq-title').hasClass('faq-show')){
                $(this).find('.faq-title').removeClass('faq-show');
            }else{
                $(this).find('.faq-title').addClass('faq-show');
            }
            $(this).find('.faq-desc').slideToggle();
        })
    </script>
@stop

@section('banners')
@stop

@section('content')
    <section class="carousel" id="carouselMain">

        <div class="picture">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    @foreach($banners as $item)
                        @if($item->img)
                            <div class="swiper-slide">
                                <div class="topic">
                                    <div class="pic">
                                        <a href="{{ $item->href?url($item->href):"javascript:;" }}">
                                            <div class="back" style="background-image: url({{ asset('uploads/'.$item->img) }})"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="abbr">
            <div class="information">

                <div class="central">
                    <h1 class="slogan">
                        <span class="digit">{{ mb_substr(app('cache.config')->get('home_slogan'),0,1) }}</span>
                        <span class="digit">{{ mb_substr(app('cache.config')->get('home_slogan'),1,1) }}</span>
                        <span class="text">{{ mb_substr(app('cache.config')->get('home_slogan'),2) }}</span>
                    </h1>
                    <p class="simple">{!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('home_slogan2')) !!}</p>
                    @if(app('cache.config')->get('home_pills'))
                        <div class="pills"><img src="{{ asset_upload(app('cache.config')->get('home_pills')) }}" alt="藥丸"></div>
                    @endif
                </div>

            </div>
            {{--<p class="privacy">{!! str_replace(PHP_EOL," ",app('cache.config')->get('privacy_text')) !!}</p>--}}
            <div class="privacy">
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
        <div class="scroll">
            <p>購買{{ app('cache.config')->get('site_name') }}</p>
            <div class="roll"></div>
        </div>
    </section>



    <section class="section left product-section scroll-target init">
        <div class="section-inner">
            <h2>
                <p class="en">SHOPPING ONLINE</p>
                <p class="cn">減肥藥購買</p>
            </h2>
            <div class="row-wrapper">
                @php
                    $product_spec = app('cache.config')->get('product_spec');
                @endphp
                @foreach($products as $key=>$row)
                <div class="row scroll-target init ">
                    <ul>
                        @foreach($row as $goods)
                        <li class="scroll-target-sp init show">
                            <div class="goods">
                                <figure>
                                    <p class="goods-img"><a href="{{ url('product/'.$goods->id) }}"><img src="{{ asset_upload($goods->img) }}" alt="{{ strip_tags($goods->name) }}"></a></p>
                                    <figcaption>
                                        <a href="{{ url('product/'.$goods->id) }}"><p class="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{!! $goods->name !!}</font></font></p></a>
                                        <p class="spec">{{ $product_spec }}</p>
                                        <div class="price">
                                            <span class="now">NT${{ number_format(round($goods->price)) }}</span>
                                            @if($goods->market_price>$goods->price)
                                            <span class="market">NT${{ number_format(round($goods->market_price)) }}</span>
                                            @endif
                                        </div>
                                        <p class="go-btn"><a href="{{ url('shopping/'.$goods->id) }}" data-observer="點擊購買-{{ $goods->name }}">點擊購買</a></p>
                                    </figcaption>
                                </figure>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>

            <div class="btn scroll-target init ">
                <a href="{{ url('product') }}" data-observer="查看全部優惠方案">
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">查看全部優惠方案</font></font></p>
                </a>
            </div>


        </div>

    </section>

    <section class="section-about">
        <div class="section-inner">
            <h2>
                <p class="en">ABOUT</p>
                <p class="cn">關於{{ app('cache.config')->get('site_name') }}</p>
            </h2>
            <div class="statement">
                <h2 class="about-title scroll-target init">{!! app('cache.config')->get('home_about_title') !!}</h2>
                <div class="about-text scroll-target init">
                    {!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('home_about_text')) !!}
                </div>
            </div>


        </div>
    </section>

    <section class="section shipping-section scroll-target init">

        <div class="section-inner">
            <h2>
                <span class="en"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">NEWS</font></font></span>
                <span class="cn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">出貨公告</font></font></span>
            </h2>

            <div class="main scroll-target init" id="loopWrap">
                <div class="loop" >
                    @php
                        $time = date('Y-m-d',strtotime('-1 day'));
                        $hs = [1,3,6,9,12,15,18];
                    @endphp
                    @for($i=0;$i<=20;$i++)
                    <div class="news">
                        <p class="cate">{{ $time }}</p>
                        <p class="text">顧客手機末三碼{{ rand(100,999) }}訂購{{ app('cache.config')->get('site_name') }}【{{ array_get($hs,array_rand($hs)) }}盒】經過隱密包裝已發出，請留意手機簡訊查收！</p>
                    </div>
                    @endfor


                </div>
            </div>
        </div>

    </section>

    <div class="news-category">
        @foreach($article_cate as $key=>$cate)
        <section class="section {{ !$key%2==0?"":"right" }} section-works scroll-target init">
            <div class="section-inner">
                <h2>
                    <span class="en"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $cate->sub_name }}</font></font></span>
                    <span class="cn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $cate->name }}</font></font></span>
                </h2>
                <div class="row-wrapper">
                    <div class="row scroll-target init ">
                        <ul>
                            @foreach($cate->article as $news)
                            <li class="scroll-target-sp init show">
                                <a href="{{ url($news->cate->uri.'/'.$news->id) }}">
                                    <figure>
                                        <p class="works-img"><img src="{{ asset_upload($news->img) }}" alt="{{ $news->img_alt?:$news->title }}"></p>
                                        <figcaption>
                                            <p class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $news->title }}</font></font></p>
                                            {{--<p class="tag"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">前往閲讀</font></font></p>
                                        --}}
                                        </figcaption>
                                    </figure>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="btn scroll-target init ">
                    <a href="{{ url($cate->uri) }}" data-observer="查看更多{{ $cate->name }}">
                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">查看更多{{ $cate->name }}</font></font></p>
                    </a>
                </div>
            </div>
        </section>
        @endforeach
    </div>

    @if($faqs && !$faqs->isEmpty())
        <section class="section faqs-section scroll-target init">

            <div class="section-inner">
                <h2>
                    <span class="en"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FQAs</font></font></span>
                    <span class="cn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">常見問題</font></font></span>
                </h2>
                <div class="main scroll-target init" >
                    <div class="faq-main">
                        @foreach($faqs as $key=>$item)
                            <div class="faq-item">
                                <div class="faq-title ">
                                    <p>Q{{ ++$key }}：{{ $item->questions }}</p>
                                </div>
                                <p class="faq-desc">
                                    {{ $item->answers }}
                                </p>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>

        </section>
    @endif

    @if(app('cache.config')->get('home_foot_title'))
    <div class="backdrop-text">
        <p class="p1">{{ app('cache.config')->get('home_foot_title') }}</p>
        <p class="p2">{!! app('cache.config')->get('home_foot_text') !!}</p>
    </div>
    @endif

@endsection
