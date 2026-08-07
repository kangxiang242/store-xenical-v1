@extends('web.layout')
@php
    $comment_labels = $comment_labels->chunk(ceil(count($comment_labels)/1))
@endphp
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/goods.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        .g-icons{
            width: 60%;
            min-width: 340px;
            justify-content: space-between;
        }
        @media screen and (max-width: 1024px){
            .g-icons{
                width: 100%;
                min-width: 100%;
                justify-content: space-between;
            }
        }
    </style>
@stop

@section('header-class','sticky')

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.form.js') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('static/js/jquery.contip.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/lottie_svg.min.js') }}"></script>

    <script>
        function makeOrderLogs(){
            var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
            var current_time = Date.parse(new Date())/1000;


            var swiper_html = '';
            if(order_log_time>current_time){
                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+localStorage.getItem("order_log_nickname")+'</span><span class="time">剛剛</span></p></div>';
            }
            for(var i=0;i<10;i++){
                var str = "買家09****"+getRandomNum()+"已下單<span class='quit'>"+getRandomInt(1,10)+"</span>瓶";
                var time = "剛剛";


                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+str+'</span><span class="time">'+time+'</span></p></div>';
            }
            $('#order-logs-swiper').find('.swiper-wrapper').html(swiper_html);


        }
        makeOrderLogs();
        function getRandomNum(){
            var randomNum = Math.random()

            var checkCode = randomNum*9000
            checkCode +=1000;
            return parseInt(checkCode)
        }

        function getRandomInt(min,max){
            return Math.floor(Math.random()*(max-min+1))+min;
        }

        var is_run = false;
        setInterval(function(){
            var time = getRandomInt(6,18)*1000;


            if(!is_run){
                is_run = true;

                setTimeout(function(){
                    localStorage.removeItem("order_log_time");
                    $('#order-logs-next').click();
                    is_run=false;

                },time)
            }


        },1000)


       /* var current_goods_id = "{{ $goods->id }}";
        var current_order_buy_num = getGoodsSales(current_goods_id);
        if(current_order_buy_num){
            $('#buy_num').text(current_order_buy_num);
        }

        setGoodsSales(current_goods_id,parseInt($('#buy_num').text()));


        var mySwiper = new Swiper('#order-logs-swiper', {
            autoplay: false,
            loop:true,
            simulateTouch : false,
            allowTouchMove: false,
            direction: 'vertical',
            observer: true,
            height:58,
            navigation: {
                nextEl: '#order-logs-next',
            },
            on: {
                slideChangeTransitionStart: function(swiper){
                    var str = $('#order-logs-swiper .swiper-slide').eq(this.activeIndex).find('.nick').text();

                    localStorage.setItem("order_log_nickname",str);
                    var order_buy_num = getGoodsSales(current_goods_id);
                    if(!order_buy_num){
                        order_buy_num = parseInt($('#buy_num').text());
                    }
                    var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
                    var current_log_time = Date.parse(new Date())/1000;
                    if(!order_log_time || current_log_time>order_log_time){
                        localStorage.setItem("order_log_time",Date.parse(new Date())/1000);

                        var quit = $('#order-logs-swiper .swiper-slide').eq(this.activeIndex).find('.nick .quit').text()
                        quit = parseInt(quit)?parseInt(quit):1
                        setGoodsSales(current_goods_id,parseInt(order_buy_num)+quit);
                        $('#buy_num').text(order_buy_num+quit);
                    }
                },
            },
        })*/



    </script>

    <script>
        $(document).ready(function () {

            const page1 = $("#page1");
            const page2 = $("#page2");
            const page3 = $("#page3");
            const title1 = $("#title1");


            /*$('.page').each(function(){
                var height = $(this).find('div').outerHeight()+100;
                $(this).css('height',height+'px')
            })*/



            $("#title1").click(function () {
                $(".page").addClass("page1") .removeClass("page2 page3");

                $("#title1").addClass("title-on");
                $("#title2").removeClass("title-on");
                $("#title3").removeClass("title-on");
                $("#titlebar").removeClass("title-bar2");
                $("#titlebar").removeClass("title-bar3");

                $('.pagebox').height($('#page1').find('div').outerHeight()+100)


            });

            $("#title2").click(function () {
                $(".page").addClass("page2") .removeClass("page1 page3");

                $("#title1").removeClass("title-on");
                $("#title2").addClass("title-on");
                $("#title3").removeClass("title-on");
                $("#titlebar").addClass("title-bar2");
                $("#titlebar").removeClass("title-bar3");
                $('.pagebox').height($('#page2').find('div').outerHeight()+100)
            });

            /* $("#title3").click(function () {
                $(".page").addClass("page3") .removeClass("page1 page2");

                $("#title1").removeClass("title-on");
                $("#title2").removeClass("title-on");
                $("#title3").addClass("title-on");
                $("#titlebar").addClass("title-bar3");
                $('.pagebox').height($('#page3').find('div').outerHeight()+100)
            }); */

            page1.removeClass("active");
            title1.addClass("title-on");
        });
    </script>

    <script>
        let iconUp = document.querySelectorAll('.up');
        for (var i = 0; i < iconUp.length; i++) {
            let animationUp = bodymovin.loadAnimation({
                container: iconUp[i],
                renderer: 'svg',
                loop: false,
                autoplay: false,
                path: "/static/json/thumbUp.json"
            });

            var id = $(iconUp[i]).attr('data-id');
            var storage_key = 'comment_like_'+id;
            if(localStorage.getItem(storage_key)){
                $(iconUp[i]).attr('data-like',1);
                animationUp.setDirection(1);
                animationUp.play();
            }

            iconUp[i].addEventListener('click', (e) => {
                var _this = $(e.target).parents('.awesome');
                var id = _this.attr('data-id');
                var up = parseInt(_this.attr('data-up'));
                var storage_key = 'comment_like_'+id;
                if(_this.attr('data-like')){
                    var directionUp = -1;
                    _this.removeAttr('data-like');
                    localStorage.removeItem(storage_key);
                    up--;
                }else{
                    var directionUp = 1;
                    _this.attr('data-like',1);
                    localStorage.setItem(storage_key,1);
                    up++;

                }
                _this.attr('data-up',up)
                $.ajax({
                    url: '/api/comment/up',
                    type: 'POST',
                    data : {id:id,like:directionUp,_token:"{{ csrf_token() }}"},
                    dataType: 'json',
                });
                _this.next('.up-num').text("("+up+")")


                animationUp.setDirection(directionUp);
                animationUp.play();

            });
        }


    </script>


    <script>
        /*document.querySelector('a[href="#target"]').addEventListener('click', function(e) {
            e.preventDefault();
            const targetElement = document.querySelector('#target');
            if (targetElement) {
                const offset = -200;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                window.scrollTo({
                    top: targetPosition + offset,
                    behavior: 'smooth'
                });
            }
        });*/
    </script>

    <script>
        var page = 5;

        var currentPage = 1;
        var count = $('.rev').length;
        var pageNumber = Math.ceil(count/page);

        var pageLinkRender = function () {
            $('.history').append('<ul class="paging" id="paging"></ul>')
            var temp = '<li class="prev"><svg t="1695783674431" class="previcon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4168" width="200" height="200"><path d="M563.626667 490.666667L298.666667 229.376 358.186667 170.666667 682.666667 490.666667 358.186667 810.666667 298.666667 751.957333z" p-id="4169"></path></svg></li>';
            for (var i=0;i<pageNumber;i++){
                temp += '<li class="turn '+(i==0?'active':'')+'" data-page="'+(i+1)+'"><span>'+(i+1)+'</span></li>'
            }
            temp += '<li>···</li><li class="next"><svg t="1695783674431" class="nexticon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4168" width="200" height="200"><path d="M563.626667 490.666667L298.666667 229.376 358.186667 170.666667 682.666667 490.666667 358.186667 810.666667 298.666667 751.957333z" p-id="4169"></path></svg></li>';
            $('#paging').html(temp)
        }
        if(pageNumber>1){
            //pageLinkRender();
        }
        $('.rev').hide();
        var showLinkPage = function (show_page) {

            $('.rev').hide()
            var show_page = parseInt(show_page);
            for(var i=0;i<page;i++){
                var eq = i+(show_page-1)*page
                var rev = $('.rev').eq(eq);
                if(rev){
                    rev.show();
                }
            }
            currentPage = show_page;

            $("[data-page='"+show_page+"']").addClass('active').siblings().removeClass('active');


            $('#paging .prev').removeClass('disabled')
            $('#paging .next').removeClass('disabled')
            if(currentPage <= 1){
                $('#paging .prev').addClass('disabled');
            }
            if(currentPage >= pageNumber){
                $('#paging .next').addClass('disabled');
            }

        }
        showLinkPage(1);
        $('#paging .turn').click(function () {
            if(!$(this).hasClass('active')){
                var show_page = $(this).attr('data-page');
                showLinkPage(show_page);

            }
        })

        $('#paging .next').click(function () {
            let nextPage = currentPage+1;
            if(nextPage<=pageNumber){
                $('.reviews .loading').addClass('active')
                setTimeout(function () {
                    showLinkPage(nextPage)
                    $('.reviews .loading').removeClass('active')
                    $('.pagebox').height($('.comment-box').outerHeight() + 100)
                },500)

            }

        })

        $('#paging .prev').click(function () {
            let prevPage = currentPage-1;
            if(prevPage>=1){
                $('.reviews .loading').addClass('active')
                setTimeout(function () {
                    showLinkPage(prevPage)
                    $('.reviews .loading').removeClass('active')
                    $('.pagebox').height($('.comment-box').outerHeight() + 100)
                },500)
            }

        })

        $('.lord-more').click(function (){
            var nextPage = currentPage+1;
            if(nextPage<=pageNumber){
                showLinkPage(nextPage)
            }

            if(nextPage==pageNumber){
                $('.lord-more').hide();
            }

        })


    </script>

@stop

@section('content')


    <div class="container no-curtain">

        <div class="main">
            <div class="wrap">
                <div class="goods-body">

                    <div class="goods">

                        <div class="img-wrap">
                            <img src="{{ asset_upload($goods->img) }}" alt="{{ str_replace("<br />"," ",$goods->name) }}">
                        </div>
                        <div class="info-wrap">
                            <h1 class="name">{{ str_replace("<br />"," ",$goods->name) }}</h1>
                            {{--<p class="privacy">{!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('privacy_text')) !!}</p>--}}
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
                            <div class="foot">
                                <p class="price">
                                    <span class="now">NT${{ number_format(intval($goods->price)) }}</span>
                                    <span class="market">NT${{ number_format(intval($goods->market_price)) }}</span>
                                </p>
                                <a class="go-btn" href="{{ url('shopping/'.$goods->id) }}" data-observer="點擊購買-{{ $goods->name }}">點擊購買</a>
                            </div>
                            <div class="spec">
                                <div class="spec-item"><p class="head">藥品規格</p><p class="desc">{{ app('cache.config')->get('product_spec') }}</p></div>
                                <div class="spec-item"><p class="head">主要成分</p><p class="desc">{{ app('cache.config')->get('product_component') }}</p></div>
                                <div class="spec-item"><p class="head">生産廠家</p><p class="desc">{{ app('cache.config')->get('product_manufacturer') }}</p></div>
                                <div class="spec-item"><p class="head">適應症</p><p class="desc">{{ app('cache.config')->get('product_indication') }}</p></div>
                                <div class="spec-item"><p class="head">貯藏</p><p class="desc">{{ app('cache.config')->get('product_storage') }}</p></div>
                                <div class="spec-item"><p class="head">有效期</p><p class="desc">{{ app('cache.config')->get('product_valid') }}</p></div>
                            </div>
                            
                        </div>

                    </div>

                    <div class="info-page">
                        <div class="title-box" id="titlebar">
                            <p class="title" id="title1">詳情介紹</p>
                            <p class="title" id="title2">付款與售後</p>
                            <!-- <p class="title" id="title3"></p> -->
                        </div>
                        <div class="pagebox">
                            <div class="page" id="page1">
                                <div class="content">
                                    <div class="desc-images">
                                        @php
                                            $product_present_images = json_decode(app('cache.config')->get('product_present_images'),true);
                                        @endphp
                                        @if($product_present_images)
                                            @foreach($product_present_images as $image)
                                                <img src="{{ asset_upload(array_get($image,'img')) }}" alt="{{ array_get($image,'img_alt') }}">
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="desc-info">
                                        @php
                                            $product_present_texts = json_decode(app('cache.config')->get('product_present_texts'),true);
                                        @endphp
                                        @if($product_present_texts)
                                            @foreach($product_present_texts as $text)
                                                <div class="info-item">
                                                    <div class="info-item-header"><span>{{ array_get($text,'title') }}</span></div>
                                                    <div class="info-item-desc">

                                                        <p>{!! str_replace(PHP_EOL,"<br>",array_get($text,'content')) !!}</p>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>

                            </div>
                            {{--<div class="page" id="page2">
                                
                                <div class="comment-box" id="target">

                                <div class="comment">
                                    <div class="widg">
                                        <div class="amount-wrap">
                                            @php
                                                $commentGroup = $comment->groupBy('star');
                                                $star_5 = $commentGroup->get(5)?$commentGroup->get(5)->count():0;
                                                $star_4 = $commentGroup->get(4)?$commentGroup->get(4)->count():0;
                                                $star_3 = $commentGroup->get(3)?$commentGroup->get(3)->count():0;
                                                $star_2 = $commentGroup->get(2)?$commentGroup->get(2)->count():0;
                                                $star_1 = $commentGroup->get(1)?$commentGroup->get(1)->count():0;

                                                $count_comment = count($comment);

                                                $f_count_comment = $comment->count();

                                                $star_rate_5 = $count_comment?number_format($star_5/$count_comment,2)*100:0;
                                                $star_num_5 = intval(round($f_count_comment*($star_rate_5/100),0));

                                                $star_rate_4 = $count_comment?number_format($star_4/$count_comment,2)*100:0;
                                                $star_num_4 = intval(round($f_count_comment*($star_rate_4/100),0));

                                                $star_rate_3 = $count_comment?number_format($star_3/$count_comment,2)*100:0;
                                                $star_num_3 = intval(round($f_count_comment*($star_rate_3/100),0));

                                                $star_rate_2 = $count_comment?number_format($star_2/$count_comment,2)*100:0;
                                                $star_num_2 = intval(round($f_count_comment*($star_rate_2/100),0));

                                                $star_rate_1 = $count_comment?number_format($star_1/$count_comment,2)*100:0;
                                                $star_num_1 = intval(round($f_count_comment*($star_rate_1/100),0));

                                            @endphp
                                            <div class="total-box">

                                            
                                                <div class="total">
                                                    <!-- <p class="score-desc">買家平均評價</p> -->
                                                    <p class="score">4.{{ rand(5,9) }}</p>
                                                    <div class="stars">
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a3;</i>
                                                    </div>
                                                    <!-- <p class="text">共{{ $f_count_comment }}則評價</p> -->
                                                    <p class="text">共10536則評價</p>
                                                </div>
                                                <div class="histogram">
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: 78%"></span></div>
                                                        <div class="percentage">78%</div>
                                                        <div class="frequency">(8218)</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: 22%"></span></div>
                                                        <div class="percentage">22%</div>
                                                        <div class="frequency">(2408)</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: {{ $count_comment?number_format($star_3/$count_comment,2)*100:0 }}%"></span></div>
                                                        <div class="percentage">{{ $star_rate_3 }}%</div>
                                                        <div class="frequency">({{ $star_num_3 }})</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: {{ $count_comment?number_format($star_2/$count_comment,2)*100:0 }}%"></span></div>
                                                        <div class="percentage">{{ $star_rate_2 }}%</div>
                                                        <div class="frequency">({{ $star_num_2 }})</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: {{ $count_comment?number_format($star_1/$count_comment,2)*100:0 }}%"></span></div>
                                                        <div class="percentage">{{ $star_rate_1 }}%</div>
                                                        <div class="frequency">({{ $star_num_1 }})</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="label-sec">
                                                @foreach($comment_labels as $chunk)
                                                    <div class="label-box">
                                                        @foreach($chunk as $item)
                                                            <div class="label">{{ $item->name }}</div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- <div class="write-wrap">
                                                <form id="comment-form" action="{{ url('/comment/'.$goods->cate_id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="group-one">

                                                        <div class="form-group">
                                                            <p class="lab">您的訂單編號</p>
                                                            <input class="form-control" name="number" required type="tel">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <p class="lab">對本次購物評分</p>
                                                        <div class="stars hover pointer">
                                                            <i class="iconfont" title="1 Star" data-star="1">&#xe9a1;</i>
                                                            <i class="iconfont" title="2 Star" data-star="2">&#xe9a1;</i>
                                                            <i class="iconfont" title="3 Star" data-star="3">&#xe9a1;</i>
                                                            <i class="iconfont" title="4 Star" data-star="4">&#xe9a1;</i>
                                                            <i class="iconfont" title="5 Star" data-star="5">&#xe9a1;</i>
                                                        </div>
                                                        <input type="hidden" name="star" value="5">
                                                    </div>

                                                    <div class="form-group">
                                                        <p class="lab">評價內容</p>
                                                        <textarea class="form-control" required name="content" ></textarea>
                                                    </div>

                                                    <button class="submit-btn">提交評價</button>
                                                </form>
                                            </div>

                                            <div class="actions">
                                                <a class="write-btn" href="javascript:;">
                                                    <span>我要評價</span>

                                                    <svg t="1698290425926" class="writeicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="21246" width="200" height="200"><path d="M172.397714 709.339429h124.269715l432.493714-432.493715-124.342857-124.342857L172.470857 585.142857v124.269714z m144.091429 96.109714H124.342857a48.054857 48.054857 0 0 1-48.054857-48.054857V565.174857c0-12.726857 5.046857-24.941714 14.043429-34.011428l480.548571-480.548572a48.054857 48.054857 0 0 1 67.949714 0l192.219429 192.219429a48.054857 48.054857 0 0 1 0 68.022857l-480.548572 480.548571a48.054857 48.054857 0 0 1-33.938285 14.043429z m586.313143 192.219428H121.197714a48.054857 48.054857 0 1 1 0-96.109714h781.604572a48.054857 48.054857 0 1 1 0 96.109714z" fill="" p-id="21247"></path></svg>

                                                </a>
                                            </div> -->
                                        </div>


                                    </div>

                                    <div class="history">
                                        <div class="info-item-header">
                                            <span>最新買家評價</span>
                                        </div>
                                        <!-- <div class="label-sec">
                                            @foreach($comment_labels as $chunk)
                                                <div class="label-loop">
                                                    @for($i=0;$i<2;$i++)
                                                        <div class="label-box">
                                                            @foreach($chunk as $item)
                                                                <div class="label">{{ $item->name }}</div>
                                                            @endforeach
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endforeach
                                        </div> -->
                                        <div class="reviews">

                                            @foreach($comment as $item)
                                                <div class="rev">
                                                    <div class="name-box">
                                                        <div class="">

                                                        
                                                            <p class="nickname">
                                                                <span>買家09****{{ substr($item->phone,-4) }}</span>
                                                                <!-- @if($item->total_number == 1 || $item->total_number >= 4)
                                                                <span class="{{ $item->total_number==1?"new":"fans" }}">{{ $item->total_number==1?"首購返評":"瘦身達人" }}</span>
                                                                @endif -->
                                                            </p>
                                                            <div class="star-box">
                                                                <div class="stars">
                                                                    @for($i=1;$i<=5;$i++)
                                                                        <i class="iconfont">{{ $i<=$item->star?"&#xe9a1;":"&#xe9a2;" }}</i>
                                                                    @endfor
                                                                </div>
                                                                @if($item->time)<p class="date">{{ $item->time->format('Y/m/d') }}</p>@endif
                                                            </div>
                                                        </div>
                                                        <p class="today">{{ $item->time_at }}</p>
                                                    </div>

                                                    <!-- <p class="buy-text">本次已購 <span>{{ $item->current_purchase }}</span></p> -->

                                                    <p class="content" style="padding: 0;">
                                                        {{ $item->content }}
                                                    </p>
                                                    @if($item->comment_image)
                                                    <img class="content-pic" src="{{ asset_upload($item->comment_image) }}">
                                                    @endif
                                                    <div class="like-box">
                                                        <!-- <p class="doyou">這則評價對您有幫助嗎？</p> -->
                                                        <div class="up awesome" data-id="{{ $item->id }}" data-up="{{ $item->up }}"></div>
                                                        <span class="up-num">({{ $item->up }})</span>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="loading" ><img src="/static/img/loading.svg" alt="loading"></div>
                                        </div>

                                        <div class="switch" id="paging">
                                            <a class="prev" id="comment-prev" href="javascript:;">上一頁</a>
                                            <a class="next" id="comment-next" href="javascript:;">下一頁</a>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                            --}}
                                
                            <div class="page" id="page2">
                                <div style="padding: 30px 15px;">
                                    {!! app('cache.config')->get('goods_payment2') !!}
                                </div>

                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>



        </div>
    </div>




@endsection
