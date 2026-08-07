@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/product.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" href="{{ asset('static/swiper4/swiper.min.css') }}">

@stop

@section('script')
    @parent
    <script src="{{ asset('static/swiper4/swiper.min.js') }}"></script>
    <script>
        (function($){
            $.fn.toPosition = function(){
                var top = this.offset().top;

                $('body,html').animate({scrollTop:top}, 200);
            }
        })(jQuery)
    </script>
    <script>
        $('.accordion-header .a-title').click(function(){

            if($(this).parents('.accordion').hasClass('open')){

                $(this).parents('.accordion').removeClass('open')

            }else{
                $(this).parents('.accordion').addClass('open')
            }



        })

        $('.accordion').each(function(){
            var height = $(this).find('.accordion-content').outerHeight();
            $(this).css('--height',height+"px")
        })

        $('.view-all').click(function(){
            if(!$(this).attr('data-close')){
                $('.accordion').removeClass('open');
                $(this).attr('data-close',1)
                $(this).text('查看所有部分');
            }else{
                $('.accordion').addClass('open');
                $(this).removeAttr('data-close')
                $(this).text('隱藏所有部分');
            }

        });
    </script>
    <script>
        $('a[data-toggle="dropdown"]').click(function(){
            var id = $(this).attr('id');
            var dropdown_elem = $('ul[aria-labelledby="'+id+'"]');
            if(dropdown_elem.hasClass('show')){
                dropdown_elem.removeClass('show');
            }else{
                dropdown_elem.addClass('show');
            }

        });


        $('.spec-item2').click(function(){
            var text = $(this).attr('data-text');
            $(this).parent().addClass('activate').siblings().removeClass('activate');
            $('#dropdownMenu1').find('.text').text(text);
            $('.dropdown').removeClass('show')

            var eq = $(this).parent().index();
            $('.spec-item').parent().eq(eq).addClass('activate').siblings().removeClass('activate');

            changeCover($(this).parent().index());
        });

        function changeCover(){
            var eq = $('.spec-item').parent('.activate').index();
            $('.image img').eq(eq).show().siblings().hide()
        }

        $('.go-checkout').click(function(){
            var id = $(this).attr('data-id');
            var spec = $('.spec-main li.activate').find('a').attr('data-spec');

            window.location.href = "{{ url('checkout') }}/"+id+"?spec="+spec;

        });
        $('.view-btn').click(function(){
            $('.scheme').toPosition();
        });

        $('.prescribe a').click(function(){
            $('.prescribe-container').toPosition();
        });

        var mySwiper = new Swiper('#goods-swiper', {
            autoplay: false,
            allowTouchMove: false,
            initialSlide:0,
        })

        $('.spec-item').click(function(){
            var text = $(this).attr('data-text');
            $(this).parent().addClass('activate').siblings().removeClass('activate');
            $('#dropdownMenu1').find('.text').text(text);
            $('.dropdown').removeClass('show')
            changeCover($(this).parent().index());
        });

        function changeCover(to){
            mySwiper.slideTo(to, 500, true);
        }
    </script>
@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>
        <li class="active">訂購犀利士</li>
    </ul>
@stop
@section('title-before','訂購犀利士')
@section('banners')@stop

@section('content')
<div class="container">
    <section class="basic">
        <div class="wrap">
            <div class="goods">
                <div class="image">
                    <div class="swiper-container" id="goods-swiper">
                        <div class="swiper-wrapper">
                            @foreach($spec as $key=>$item)
                                <div class="swiper-slide">
                                    <img class="activate" src="{{ asset_upload(array_get($item,'img')) }}" alt="{{ array_get($item,'name') }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="info">
                    <h1 class="goods-title">{{ app('cache.config')->get('page_product_title') }}</h1>
                    <p class="sub">{{ app('cache.config')->get('page_product_title_en') }}</p>
                    <div class="indication">
                        <p class="p1">適應症：</p>
                        <ul>
                            @foreach($adapt as $item)
                            <li><span>{{ array_get($item,'text') }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="spec">
                        <p class="p1">劑型和規格：</p>
                        <div class="nape">
                            <p class="key">錠劑：</p>
                            <ul class="spec-main">
                                @foreach($spec as $key=>$item)
                                    <li class="{{ $key==0?"activate":"" }}"><a class="spec-item" data-text="{{ array_get($item,'name') }}" data-spec="{{ str_replace('mg','',array_get($item,'name')) }}"  href="javascript:;">{{ array_get($item,'name') }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <p class="prescribe"><a class="text-underline" href="javascript:;">閱讀更多犀利士處方訊息</a></p>
                    <button class="view-btn">查看價格方案</button>
                </div>
            </div>

            <div class="scheme">
                <div class="card">
                    <p class="hero-title">價格方案</p>
                    <div class="main">
                        <div class="norms">
                            <p class="text">禮來犀利士膜衣錠</p>
                            <div class="selected">
                                <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown" id="dropdownMenu1">
                                    <span class="text">20mg</span>
                                    <i class="iconfont">&#xe644;</i>
                                </a>
                                <ul class=" dropdown" aria-labelledby="dropdownMenu1">
                                    <li class="activate"><a class="spec-item2" data-text="20mg" href="javascript:;" >20mg</a></li>
                                    <li><a class="spec-item2" data-text="10mg" href="javascript:;" >10mg</a></li>
                                    <li><a class="spec-item2" data-text="5mg" href="javascript:;">5mg</a></li>
                                    <li><a class="spec-item2" data-text="2.5mg" href="javascript:;">2.5mg</a></li>
                                </ul>
                            </div>
                        </div>

                        <ul class="products">
                            @foreach($products as $goods)
                            <li>
                                <div class="tity"><p class="quantity">{{ $goods->quantity }}盒（{{ $goods->quantity*4 }}錠）</p></div>
                                <div class="fit">
                                    <div class="cost">
                                        <p class="price">NT$ {{ number_format(round($goods->price)) }}</p>
                                        <p class="freight">免配送服務費</p>
                                    </div>
                                    <div class="button"><a class="go-checkout" data-id="{{ $goods->id }}">選購該方案</a></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>

            <div class="prescribe-container">
                <h2 class="hero-title">處方訊息</h2>
                <p class="toggle-link"><a href="javascript:;" class="view-all">隱藏所有部分</a></p>
                <div class="prescribe-content">

                    <div class="accordion open">
                        <div class="accordion-header"><p class="a-title"><span class="accordion-icon" title="Show"></span><span class="text">1 適應症及用法</span></p></div>
                        <div class="accordion-content" style="display: block;"><a name="s2"></a><a name="section-1"></a><p></p>

                            <div data-sectioncode="42229-5" class="Section"><a name="s3"></a><a name="section-1.1"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.1 勃起功能障礙</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS </font></font><span class="Sup"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">®</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">適用於治療勃起功能障礙 (ED)。
                                        </font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s3a"></a><a name="section-1.2"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.2 良性前列腺增生
                                        </font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            CIALIS 適用於治療良性前列腺增生 (BPH) 的體徵和症狀。
                                        </font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s3b"></a><a name="section-1.3"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.3 勃起功能障礙和良性前列腺增生
                                        </font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            CIALIS 適用於治療 ED 和 BPH (ED/BPH) 的體徵和症狀。
                                        </font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s3c"></a><a name="section-1.4"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1.4 使用限制
                                        </font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">如果 CIALIS 與非那雄胺一起用於啟動 BPH 治療，建議使用長達 &ZeroWidthSpace;&ZeroWidthSpace;26 週，因為 CIALIS 的增量益處從 4 週減少到 26 週，並且 CIALIS 超過 26 週的增量益處未知</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見臨床研究（</font></font><a href="#s122a"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">14.3</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                        </font></font></p>
                            </div>
                            <p class="hide-link"><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隱藏</font></font></a></p></div>
                    </div>


                    <div class="accordion open">
                        <div class="accordion-header"><p class="a-title"><span class="accordion-icon" title="Show"></span><span class="text">2 用法用量</span></p></div>
                        <div class="accordion-content" style="display: block;"><a name="s4"></a><a name="section-2"></a><p></p>
                            <p class="First"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">不要拆分 CIALIS 平板電腦；</font><font style="vertical-align: inherit;">應服用全部劑量。</font></font></span></p>
                            <div data-sectioncode="42229-5" class="Section"><a name="s5"></a><a name="section-2.1"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.1 CIALIS 用於勃起功能障礙的需要</font></font></h2>
                                <ul class="Disc">
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">大多數患者根據需要使用的 CIALIS 推薦起始劑量為 10 mg，在預期的性活動之前服用。</font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">根據個體療效和耐受性，劑量可增加至 20 mg 或減少至 5 mg。</font><font style="vertical-align: inherit;">大多數患者的最大推薦給藥頻率為每天一次。</font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">與安慰劑相比，根據需要使用的 CIALIS 可在給藥後長達 36 小時內改善勃起功能。</font><font style="vertical-align: inherit;">因此，在建議患者最佳使用 CIALIS 時，應考慮到這一點。</font></font></li>
                                </ul>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s7"></a><a name="section-2.2"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.2 CIALIS 每日一次用於勃起功能障礙</font></font></h2>
                                <ul class="Disc">
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日使用一次的推薦起始劑量為 2.5 毫克，每天大約在同一時間服用，不考慮性活動的時間。</font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                根據個體療效和耐受性，每日使用一次的 CIALIS 劑量可增加到 5 mg。
                                            </font></font></li>
                                </ul>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s7a"></a><a name="section-2.3"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.3 CIALIS 每日一次用於良性前列腺增生
                                        </font></font></h2>
                                <ul class="Disc">
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">每天使用一次的 CIALIS 推薦劑量為 5 毫克，每天大約在同一時間服用。</font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">當用 CIALIS 和非那雄胺開始治療 BPH 時，推薦的 CIALIS 每日使用劑量為 5 mg，每天大約在同一時間服用，最多 26 週。</font></font></li>
                                </ul>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s7b"></a><a name="section-2.4"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.4 CIALIS 每日一次用於勃起功能障礙和良性前列腺增生
                                        </font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">每天使用一次的 CIALIS 推薦劑量為 5 毫克，每天大約在同一時間服用，不考慮性活動的時間。
                                        </font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s8"></a><a name="section-2.5"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.5 與食物一起使用</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 可以在不考慮食物的情況下服用。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s9"></a><a name="section-2.6"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.6 在特定人群中使用</font></font></h2>
                                <div data-sectioncode="42229-5" class="Section"><a name="s10"></a><a name="section-2.6.1"></a><p></p>
                                    <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">腎功能不全</font></font></span></p>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s11"></a><a name="section-2.6.1.1"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 按需使用</font></font></span></p>
                                        <ul class="Disc">
                                            <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        肌酐清除率 30 至 50 mL/min：建議起始劑量為 5 mg，每天不超過一次，最大劑量為 10 mg，每 48 小時不超過一次。
                                                    </font></font></li>
                                            <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                        肌酐清除率低於 30 mL/min 或血液透析：最大劑量為 5 mg，每 72 小時不超過一次</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s33"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和在特定人群中使用 ( </font></font><a href="#s78"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                    </font></font></li>
                                        </ul>
                                    </div>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s12"></a><a name="section-2.6.1.2"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日一次</font></font></span></p>
                                        <div data-sectioncode="42229-5" class="Section"><a name="s12a"></a><a name="section-2.6.1.2.1"></a><p></p>
                                            <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">勃起功能障礙</font></font></span></p>
                                            <ul class="Disc">
                                                <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            肌酐清除率低於 30 mL/min 或血液透析：不建議每天使用一次 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s33"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和在特定人群中使用 ( </font></font><a href="#s78"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                        </font></font></li>
                                            </ul>
                                        </div>
                                        <div data-sectioncode="42229-5" class="Section"><a name="s12b"></a><a name="section-2.6.1.2.2"></a><p></p>
                                            <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">良性前列腺增生和勃起功能障礙/良性前列腺增生</font></font></span></p>
                                            <ul class="Disc">
                                                <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            肌酐清除率 30 至 50 mL/min：建議起始劑量為 2.5 mg。</font><font style="vertical-align: inherit;">根據個人反應，可考慮增加至 5 mg。
                                                        </font></font></li>
                                                <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肌酐清除率低於 30 mL/min 或血液透析：不建議每天使用一次 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s33"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和在特定人群中使用 ( </font></font><a href="#s78"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                        </font></font></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s13"></a><a name="section-2.7"></a><p></p>
                                <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肝功能損害</font></font></span></p>
                                <div data-sectioncode="42229-5" class="Section"><a name="s14"></a><a name="section-2.7.1"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 按需使用</font></font></span></p>
                                    <ul class="Disc">
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">輕度或中度（Child Pugh A 或 B 級）：劑量不應超過 10 毫克，每天一次。</font><font style="vertical-align: inherit;">CIALIS 每天一次的使用尚未在肝功能不全患者中進行廣泛評估，因此建議謹慎使用。
                                                </font></font></li>
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">嚴重（Child Pugh C 級）：不推薦使用 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[參見警告和注意事項 ( </font></font><a href="#s36"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.8</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和在特定人群中使用 ( </font></font><a href="#s77"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></li>
                                    </ul>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s15"></a><a name="section-2.7.2"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日一次</font></font></span></p>
                                    <ul class="Disc">
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">輕度或中度（Child Pugh A 或 B 級）：每日使用一次的 CIALIS 尚未在肝受損患者中進行廣泛評估。</font><font style="vertical-align: inherit;">因此，如果向這些患者開具每日一次的 CIALIS 處方，建議謹慎使用。
                                                </font></font></li>
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">嚴重（Child Pugh C 級）：不推薦使用 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[參見警告和注意事項 ( </font></font><a href="#s36"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.8</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和在特定人群中使用 ( </font></font><a href="#s77"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></li>
                                    </ul>
                                </div>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s17"></a><a name="section-2.8"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.7 伴隨藥物</font></font></h2>
                                <div data-sectioncode="42229-5" class="Section"><a name="s18"></a><a name="section-2.8.1"></a><p></p>
                                    <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">硝酸鹽</font></font></span></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">禁止同時使用任何形式的硝酸鹽</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見禁忌證( </font></font><a href="#s25"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                            </font></font></p>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s19"></a><a name="section-2.8.2"></a><p></p>
                                    <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">α-阻斷劑</font></font></span></p>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s19a"></a><a name="section-2.8.2.1"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ED</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> — 當 CIALIS 與 α 受體阻滯劑在接受 ED 治療的患者中共同給藥時，患者在開始治療前應在 α 受體阻滯劑治療中保持穩定，並且 CIALIS 應以最低推薦劑量開始</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s32"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) , 藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ), 和臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></p>
                                    </div>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s19b"></a><a name="section-2.8.2.2"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BPH</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> — 不建議將 CIALIS 與 α 受體阻滯劑聯合用於治療 BPH </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s32"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )、藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></p>
                                    </div>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s20"></a><a name="section-2.8.3"></a><p></p>
                                    <p class="First"><span class="Underline">CYP3A4 抑製劑</span></p>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s21"></a><a name="section-2.8.3.1"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">根據需要使用 CIALIS</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> — 對於同時服用 CYP3A4 強效抑製劑（如酮康唑或利托那韋）的患者，CIALIS 的最大推薦劑量為 10 mg，每 72 小時不超過一次</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s40"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.10</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和藥物相互作用 ( </font></font><a href="#s55"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                    </div>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s22"></a><a name="section-2.8.3.2"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日使用一次</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">— 對於同時服用 CYP3A4 強效抑製劑（如酮康唑或利托那韋）的患者，最大推薦劑量為 2.5 mg </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s40"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.10</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和藥物相互作用 ( </font></font><a href="#s55"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                    </div>
                                </div>
                            </div>
                            <p class="hide-link"><a href="#">Hide</a></p></div>
                    </div>

                    <div class="accordion open">
                        <div class="accordion-header"><p class="a-title"><span class="accordion-icon" title="Show"></span><span class="text">3 劑型和規格</span></p></div>
                        <div class="accordion-content" style="display: block;"><a name="s23"></a><a name="section-3"></a><p></p>
                            <h1 style="display: none;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3 劑型和規格</font></font></h1>
                            <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">四種強度的杏仁形片劑有不同尺寸和不同深淺的黃色可供選擇：
                                    </font></font></p>
                            <dl>
                                <dt>&nbsp;</dt>
                                <dd><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.5 mg 壓有“C 2 1/2”的片劑</font></font></dd>
                                <dt>&nbsp;</dt>
                                <dd><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5 毫克片劑，壓有“C 5”</font></font></dd>
                                <dt>&nbsp;</dt>
                                <dd><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10 毫克片劑，壓有“C 10”</font></font></dd>
                                <dt>&nbsp;</dt>
                                <dd><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">20 毫克片劑，刻有“C 20”</font></font></dd>
                            </dl>
                            <p class="hide-link"><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隱藏</font></font></a></p></div>
                    </div>

                    <div class="accordion open">
                        <div class="accordion-header"><p class="a-title"><span class="accordion-icon" title="Show"></span><span class="text">4 禁忌症</span></p></div>
                        <div class="accordion-content" style="display: block;"><a name="s24"></a><a name="section-4"></a><p></p>

                            <div data-sectioncode="42229-5" class="Section"><a name="s25"></a><a name="section-4.1"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4.1 硝酸鹽</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">禁止定期和/或間歇性地向使用任何形式有機硝酸鹽的患者施用 CIALIS。</font><font style="vertical-align: inherit;">在臨床藥理學研究中，CIALIS 被證明可增強硝酸鹽的降血壓作用</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s25a"></a><a name="section-4.2"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4.2 超敏反應</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 禁用於已知對他達拉非（CIALIS 或 ADCIRCA </font></font><span class="Sup"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">®</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">）嚴重過敏的患者。</font><font style="vertical-align: inherit;">已報告超敏反應，包括 Stevens-Johnson 綜合徵和剝脫性皮炎</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見不良反應 ( </font></font><a href="#s48"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s25b"></a><a name="section-4.3"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4.3 伴隨的鳥苷酸環化酶 (GC) 刺激劑</font></font></h2>
                                <p class="First" style="border-left:1px solid;"><span class="XmChange"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">不要在使用 GC 刺激器（如 riociguat）的患者中使用 CIALIS。</font><font style="vertical-align: inherit;">PDE5 抑製劑，包括 CIALIS，可能會增強 GC 刺激劑的降壓作用。</font></font></p>
                            </div>
                            <p class="hide-link"><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隱藏</font></font></a></p></div>
                    </div>

                    <div class="accordion open">
                        <div class="accordion-header"><p class="a-title"><span class="accordion-icon" title="Show"></span><span class="text">5 警告和注意事項</span></p></div>
                        <div class="accordion-content" style="display: block;"><a name="s26"></a><a name="section-5"></a><p></p>

                            <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">勃起功能障礙和 BPH 的評估應包括適當的醫學評估，以確定潛在的潛在原因以及治療方案。</font></font></p>
                            <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在開 CIALIS 之前，請務必注意以下事項：</font></font></p>
                            <div data-sectioncode="42229-5" class="Section"><a name="s27"></a><a name="section-5.1"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.1 心血管</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">醫生應考慮患者的心血管狀況，因為性活動存在一定程度的心臟風險。</font><font style="vertical-align: inherit;">因此，包括 CIALIS 在內的勃起功能障礙治療不應用於因潛在心血管狀況而不宜進行性活動的男性。</font><font style="vertical-align: inherit;">應建議在開始性活動時出現症狀的患者停止進一步的性活動並立即就醫。</font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">如果患者在服用 CIALIS 後出現需要硝酸甘油的心絞痛胸痛，醫生應與患者討論適當的措施。</font><font style="vertical-align: inherit;">在服用 CIALIS 的此類患者中，在醫學上認為硝酸鹽給藥對於危及生命的情況是必要的，在考慮給予硝酸鹽之前，在最後一劑 CIALIS 後至少應經過 48 小時。</font><font style="vertical-align: inherit;">在這種情況下，硝酸鹽仍應僅在密切的醫療監督和適當的血流動力學監測下給藥。</font><font style="vertical-align: inherit;">因此，服用 CIALIS 後出現心絞痛胸痛的患者應立即就醫。</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[參見禁忌症 ( </font></font><a href="#s25"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和患者諮詢信息 ( </font></font><a href="#s127"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">17.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">左心室流出道梗阻（如主動脈瓣狹窄和特發性肥厚性主動脈瓣下狹窄）患者可能對血管擴張劑（包括 PDE5 抑製劑）的作用敏感。</font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">以下心血管疾病患者組未包括在 CIALIS 的臨床安全性和有效性試驗中，因此在獲得進一步信息之前，不建議將 CIALIS 用於以下患者組：
                                        </font></font></p>
                                <ul class="Disc">
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">過去 90 天內心肌梗塞
                                            </font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">性交時發生不穩定型心絞痛或心絞痛
                                            </font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">過去 6 個月內紐約心臟協會 2 級或以上心力衰竭
                                            </font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">不受控制的心律失常、低血壓（&lt;90/50 mm Hg）或不受控制的高血壓
                                            </font></font></li>
                                    <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">過去 6 個月內中風。
                                            </font></font></li>
                                </ul>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">與其他 PDE5 抑製劑一樣，他達拉非具有輕微的全身血管擴張特性，可能導致血壓短暫下降。</font><font style="vertical-align: inherit;">在一項臨床藥理學研究中，與安慰劑相比，他達拉非 20 mg 在健康受試者中導致仰臥位血壓平均最大降低 1.6/0.8 mm Hg </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font><font style="vertical-align: inherit;">雖然這種影響對大多數患者來說不應該是後果，但在開具 CIALIS 之前，醫生應仔細考慮其患有潛在心血管疾病的患者是否會受到這种血管舒張作用的不利影響。</font><font style="vertical-align: inherit;">血壓自主控制嚴重受損的患者可能對血管擴張劑（包括 PDE5 抑製劑）的作用特別敏感。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s28"></a><a name="section-5.2"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.2 每日一次服用 CIALIS 時藥物相互作用的可能性</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">醫生應該意識到，每天使用一次的 CIALIS 可提供持續的血漿他達拉非水平，並且在評估與藥物（例如硝酸鹽、α-受體阻滯劑、抗高血壓藥和強效 CYP3A4 抑製劑）相互作用的可能性以及大量消耗酒精</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> , </font></font><a href="#s55"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> , </font></font><a href="#s63"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.3</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s29"></a><a name="section-5.3"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.3 長時間勃起</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">對於此類化合物，很少有關於勃起超過 4 小時和陰莖異常勃起（疼痛性勃起持續時間超過 6 小時）的報導。</font><font style="vertical-align: inherit;">陰莖異常勃起，如果不及時治療，會對勃起組織造成不可逆轉的損害。</font><font style="vertical-align: inherit;">勃起持續時間超過 4 小時的患者，無論是否疼痛，都應尋求緊急醫療救助。</font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">患有可能導致陰莖異常勃起的患者（如鐮狀細胞性貧血、多發性骨髓瘤或白血病）或陰莖解剖變形（如成角、海綿體纖維化或佩羅尼氏症）的患者應謹慎使用 CIALIS疾病）。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s30"></a><a name="section-5.4"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.4 對眼睛的影響</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">醫生應建議患者停止使用所有 5 型磷酸二酯酶 (PDE5) 抑製劑，包括 CIALIS，並在一隻或兩隻眼睛突然喪失視力的情況下尋求醫療救助。</font><font style="vertical-align: inherit;">這種事件可能是非動脈炎性前部缺血性視神經病變 (NAION) 的徵兆，這是一種罕見的疾病，是視力下降的原因，包括永久性視力喪失，在上市後很少報導與使用所有 PDE5 的時間相關抑製劑。</font><font style="vertical-align: inherit;">根據已發表的文獻，在≥50歲的男性中，NAION的年發病率為每10萬人2.5-11.8例。
                                        </font></font></p>
                                <p style="border-left:1px solid;"><span class="XmChange"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">一項觀察性病例交叉研究評估了當 PDE5 抑製劑作為一類使用發生在 NAION 發作前（5 個半衰期內）時，與前一段時間使用 PDE5 抑製劑相比，NAION 的風險。</font><font style="vertical-align: inherit;">結果表明 NAION 的風險增加了大約 2 倍，風險估計值為 2.15 (95% CI 1.06, 4.34)。</font><font style="vertical-align: inherit;">一項類似的研究報告了一致的結果，風險估計值為 2.27 (95% CI 0.99, 5.20)。</font><font style="vertical-align: inherit;">NAION 的其他風險因素，例如“擁擠”視盤的存在，可能在這些研究中促成了 NAION 的發生。
                                        </font></font></p>
                                <p style="border-left:1px solid;"><span class="XmChange"></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">罕見的上市後報告以及觀察性研究中 PDE5 抑製劑使用與 NAION 的關聯均未證實 PDE5 抑製劑使用與 NAION 之間存在因果關係</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見不良反應 ( </font></font><a href="#s48"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                        </font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">醫生應考慮其潛在 NAION 風險因素的患者是否會因使用 PDE5 抑製劑而受到不利影響。</font><font style="vertical-align: inherit;">已經經歷過 NAION 的個體發生 NAION 復發的風險增加。</font><font style="vertical-align: inherit;">因此，在這些患者中應謹慎使用 PDE5 抑製劑，包括 CIALIS，並且僅在預期益處大於風險時使用。</font><font style="vertical-align: inherit;">與普通人群相比，具有“擁擠”視盤的個體也被認為具有更大的 NAION 風險；</font><font style="vertical-align: inherit;">然而，證據不足以支持對 PDE5 抑製劑（包括 CIALIS）的潛在使用者進行篩查以應對這種不常見的情況。</font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">患有已知遺傳性退行性視網膜疾病（包括色素性視網膜炎）的患者未包括在臨床試驗中，因此不建議在這些患者中使用。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s31"></a><a name="section-5.5"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.5 突發性聽力損失</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">醫生應建議患者停止服用 PDE5 抑製劑，包括 CIALIS，並在聽力突然下降或喪失時立即就醫。</font><font style="vertical-align: inherit;">據報導，這些可能伴有耳鳴和頭暈的事件與 PDE5 抑製劑（包括 CIALIS）的攝入存在時間關聯。</font><font style="vertical-align: inherit;">無法確定這些事件是否與使用 PDE5 抑製劑或其他因素直接相關</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見不良反應 ( </font></font><a href="#s45"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> , </font></font><a href="#s48"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s32"></a><a name="section-5.6"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.6 α-受體阻滯劑和抗高血壓藥</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">醫生應與患者討論 CIALIS 增強 α 受體阻滯劑和抗高血壓藥物的降血壓作用的潛力</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">當 PDE5 抑製劑與 α 受體阻滯劑合用時，建議謹慎。</font><font style="vertical-align: inherit;">PDE5 抑製劑，包括 CIALIS 和 α-腎上腺素能阻滯劑都是具有降血壓作用的血管擴張劑。</font><font style="vertical-align: inherit;">當血管擴張劑聯合使用時，可能會對血壓產生累加效應。</font><font style="vertical-align: inherit;">在一些患者中，同時使用這兩種藥物可以顯著降低血壓</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">，這可能導致症狀性低血壓（例如昏厥）。</font><font style="vertical-align: inherit;">應考慮以下方面：</font></font></p>
                                <div data-sectioncode="42229-5" class="Section"><a name="s32a"></a><a name="section-5.6.1"></a><p></p>
                                    <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ED</font></font></span></p>
                                    <ul class="Disc">
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在開始使用 PDE5 抑製劑之前，患者應穩定接受 α 受體阻滯劑治療。</font><font style="vertical-align: inherit;">在單獨使用 α 受體阻滯劑治療時表現出血流動力學不穩定的患者在同時使用 PDE5 抑製劑時出現症狀性低血壓的風險增加。
                                                </font></font></li>
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">對於 α 受體阻滯劑治療穩定的患者，應以最低推薦劑量開始使用 PDE5 抑製劑。
                                                </font></font></li>
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在那些已經服用優化劑量的 PDE5 抑製劑的患者中，應該以最低劑量開始 α 受體阻滯劑治療。</font><font style="vertical-align: inherit;">服用 PDE5 抑製劑時，逐步增加 α 受體阻滯劑的劑量可能與進一步降低血壓有關。
                                                </font></font></li>
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">聯合使用 PDE5 抑製劑和 α 受體阻滯劑的安全性可能會受到其他變量的影響，包括血管內容量減少和其他抗高血壓藥物。</font></font></li>
                                    </ul>
                                    <p><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見劑量和給藥方法 ( </font></font><a href="#s17"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s32b"></a><a name="section-5.6.2"></a><p></p>
                                    <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">前列腺增生症</font></font></span></p>
                                    <ul class="Disc">
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">α-受體阻滯劑和 CIALIS 聯合給藥治療 BPH 的療效尚未得到充分研究，並且由於聯合使用導致血壓降低的潛在血管舒張作用，不推薦 CIALIS 和 α-受體阻滯劑的聯合用藥用於治療 BPH。</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見劑量和給藥方法 ( </font></font><a href="#s17"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )、藥物相互作用 ( </font></font><a href="#s50"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> ) 和臨床藥理學 ( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> .)]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></li>
                                        <li><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">接受 α 受體阻滯劑治療 BPH 的患者應在開始使用 CIALIS 前至少一天停用其 α 受體阻滯劑，每日一次用於治療 BPH。
                                                </font></font></li>
                                    </ul>
                                </div>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s33"></a><a name="section-5.7"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.7 腎損傷</font></font></h2>
                                <div data-sectioncode="42229-5" class="Section"><a name="s34"></a><a name="section-5.7.1"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 按需使用</font></font></span></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">對於肌酐清除率低於 30 mL/min 或血液透析終末期腎病的患者，CIALIS 應限制在每 72 小時不超過一次 5 mg。</font><font style="vertical-align: inherit;">肌酐清除率 30-50 mL/min 患者的 CIALIS 起始劑量應為 5 mg，每天不超過一次，最大劑量應限制為每 48 小時不超過 10 mg。</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[參見在特定人群中的使用 ( </font></font><a href="#s78"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s35"></a><a name="section-5.7.2"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日一次</font></font></span></p>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s35a"></a><a name="section-5.7.2.1"></a><p></p>
                                        <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ED</font></font></span></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">由於他達拉非暴露量（AUC）增加，臨床經驗有限，以及缺乏影響透析清除的能力，因此不建議肌酐清除率低於 30 mL/min 的患者每天使用一次 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見特殊人群中的使用（</font></font><a href="#s78"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></p>
                                    </div>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s35b"></a><a name="section-5.7.2.2"></a><p></p>
                                        <p class="First"><span class="Underline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">BPH 和 ED/BPH</font></font></span></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">由於他達拉非暴露量（AUC）增加、臨床經驗有限以及缺乏影響透析清除的能力，因此不建議肌酐清除率低於 30 mL/min 的患者每天使用一次 CIALIS。</font><font style="vertical-align: inherit;">在肌酐清除率 30 – 50 mL/min 的患者中，每天一次以 2.5 mg 開始給藥，並根據個體反應將劑量增加到每天一次 5 mg </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見劑量和給藥方法 ( </font></font><a href="#s9"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )，在特定人群中使用 ( </font></font><a href="#s78"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )，和臨床藥理學（</font></font><a href="#s101"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.3</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">）]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                                </font></font></p>
                                    </div>
                                </div>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s36"></a><a name="section-5.8"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.8 肝功能損害</font></font></h2>
                                <div data-sectioncode="42229-5" class="Section"><a name="s37"></a><a name="section-5.8.1"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 按需使用</font></font></span></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在有輕度或中度肝功能不全的患者中，CIALIS 的劑量不應超過 10 mg。</font><font style="vertical-align: inherit;">由於嚴重肝受損患者的信息不足，不建議在該組中使用 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見特殊人群中使用 ( </font></font><a href="#s77"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s38"></a><a name="section-5.8.2"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日一次</font></font></span></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                每日使用一次的 CIALIS 尚未在輕度或中度肝功能不全患者中進行廣泛評估。</font><font style="vertical-align: inherit;">因此，如果向這些患者開具每日一次的 CIALIS 處方，建議謹慎使用。</font><font style="vertical-align: inherit;">由於嚴重肝受損患者的信息不足，不建議在該組中使用 CIALIS </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見特殊人群中使用 ( </font></font><a href="#s77"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.6</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。
                                            </font></font></p>
                                </div>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s39"></a><a name="section-5.9"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.9 酒精</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">應讓患者意識到酒精和 CIALIS（一種 PDE5 抑製劑）都可作為溫和的血管擴張劑。</font><font style="vertical-align: inherit;">當聯合使用溫和的血管擴張劑時，可能會增加每種化合物的降血壓作用。</font><font style="vertical-align: inherit;">因此，醫生應告知患者大量飲酒（例如 5 單位或更多）與 CIALIS 聯合使用會增加出現直立體徵和症狀的可能性，包括心率增加、站立血壓降低、頭暈和頭痛</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。見臨床藥理學( </font></font><a href="#s83"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">12.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s40"></a><a name="section-5.10"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.10 同時使用細胞色素 P450 3A4 (CYP3A4) 的強效抑製劑</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 主要由肝臟中的 CYP3A4 代謝。</font><font style="vertical-align: inherit;">在服用 CYP3A4 強效抑製劑如利托那韋、酮康唑和伊曲康唑的患者中，根據需要使用的 CIALIS 劑量應限制在 10 mg 不超過每 72 小時一次</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見藥物相互作用 ( </font></font><a href="#s55"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">7.2</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font><font style="vertical-align: inherit;">在每天使用一次有效的 CYP3A4 和 CIALIS 抑製劑的患者中，最大推薦劑量為 2.5 mg </font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見劑量和給藥方法 ( </font></font><a href="#s17"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2.7</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s41"></a><a name="section-5.11"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.11 與其他 PDE5 抑製劑或勃起功能障礙療法聯合使用</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                            尚未研究 CIALIS 和其他 PDE5 抑製劑組合或治療勃起功能障礙的安全性和有效性。</font><font style="vertical-align: inherit;">告知患者不要將 CIALIS 與其他 PDE5 抑製劑（包括 ADCIRCA）一起服用。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s42"></a><a name="section-5.12"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.12 對出血的影響</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">體外</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">研究</font><font style="vertical-align: inherit;">表明，他達拉非是 PDE5 的選擇性抑製劑。</font><font style="vertical-align: inherit;">PDE5 存在於血小板中。</font><font style="vertical-align: inherit;">當與阿司匹林聯合使用時，他達拉非 20 mg 與單獨使用阿司匹林相比，不會延長出血時間。</font><font style="vertical-align: inherit;">CIALIS 尚未用於有出血性疾病或明顯活動性消化性潰瘍的患者。</font><font style="vertical-align: inherit;">儘管在健康受試者中未顯示 CIALIS 會增加出血時間，但在有出血性疾病或明顯活動性消化性潰瘍的患者中使用應基於仔細的風險收益評估和謹慎。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s43"></a><a name="section-5.13"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.13 就性傳播疾病向患者提供諮詢</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">使用 CIALIS 不能預防性傳播疾病。</font><font style="vertical-align: inherit;">應考慮向患者諮詢預防性傳播疾病（包括人類免疫缺陷病毒 (HIV)）所需的保護措施。</font></font></p>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s43a"></a><a name="section-5.14"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.14 在開始 BPH 治療之前考慮其他泌尿系統疾病
                                        </font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在開始使用 CIALIS 治療 BPH 之前，應考慮可能導致類似症狀的其他泌尿系統疾病。</font><font style="vertical-align: inherit;">此外，前列腺癌和 BPH 可能並存。
                                        </font></font></p>
                            </div>
                            <p class="hide-link"><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隱藏</font></font></a></p></div>
                    </div>

                    <div class="accordion open">
                        <div class="accordion-header"><p class="a-title"><span class="accordion-icon" title="Show"></span><span class="text">6 不良反應</span></p></div>
                        <div class="accordion-content" style="display: block;"><a name="s44"></a><a name="section-6"></a><p></p>
                            <div data-sectioncode="42229-5" class="Section"><a name="s45"></a><a name="section-6.1"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.1 臨床試驗經驗</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">由於臨床試驗是在廣泛不同的條件下進行的，因此在一種藥物的臨床試驗中觀察到的不良反應率不能直接與另一種藥物的臨床試驗中的發生率進行比較，並且可能無法反映在實踐中觀察到的發生率。
                                        </font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在全球臨床試驗期間，他達拉非被用於 9000 多名男性。</font><font style="vertical-align: inherit;">在每日使用一次的 CIALIS 試驗中，共有 1434、905 和 115 名患者分別接受了至少 6 個月、1 年和 2 年的治療。</font><font style="vertical-align: inherit;">對於按需使用的 CIALIS，超過 1300 和 1000 名受試者分別接受了至少 6 個月和 1 年的治療。
                                        </font></font></p>
                                <div data-sectioncode="42229-5" class="Section"><a name="s46"></a><a name="section-6.1.1"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用於 ED 所需的 CIALIS</font></font></span></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在為期 12 週的 8 項主要安慰劑對照臨床研究中，平均年齡為 59 歲（範圍為 22 至 88 歲），接受他達拉非 10 或 20 mg 治療的患者因不良事件而停藥的率為 3.1%，而 1.4%安慰劑治療的患者。
                                            </font></font></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">當按照安慰劑對照臨床試驗中的建議服用時，CIALIS 報告了以下不良反應（</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">見表</font></font></span><a href="#t1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">），根據需要使用：
                                            </font></font></p><a name="t1"></a><table width="100%">
                                        <caption><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">表 1：在 8 項主要安慰劑對照臨床研究（包括糖尿病患者研究）中，≥2% 接受 CIALIS（10 或 20 mg）治療且藥物治療比安慰劑更頻繁的患者報告的治療中出現的不良反應用於 ED 所需的 CIALIS
</font></font></span></caption>
                                        <colgroup><col width="30.254%" align="left">
                                            <col width="16.457%" align="left">
                                            <col width="16.457%" align="left">
                                            <col width="18.416%" align="left">
                                            <col width="18.416%" align="left">
                                        </colgroup><tfoot>
                                        <tr class="First Last">
                                            <td colspan="5" align="left" valign="top">
                                                <p class="First Footnote"><span class="Sup"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">a</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">術語潮紅包括：面部潮紅和潮紅
                                                        </font></font></p>
                                            </td>
                                        </tr>
                                        </tfoot>
                                        <tbody class="Headless">
                                        <tr class="First">
                                            <td class="Botrule Lrule Rrule Toprule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">不良反應</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">安慰劑</font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=476)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 5 mg (N=151)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 10 mg (N=394)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 20 mg (N=635)</font></font></span></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">頭痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">11%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">11%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">15%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">消化不良</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">10%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">背疼</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肌痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">鼻塞</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">沖洗</font></font><span class="Sup"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">一個</font></font></span></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr class="Last">
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肢體疼痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div data-sectioncode="42229-5" class="Section"><a name="s47"></a><a name="section-6.1.2"></a><p></p>
                                    <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 每日一次用於 ED</font></font></span></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在為期 12 週或 24 週的三項安慰劑對照臨床試驗中，平均年齡為 58 歲（範圍為 21 至 82 歲），他達拉非治療組因不良事件而停藥的率為 4.1%，而安慰劑組為 2.8%患者。
                                            </font></font></p>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在為期 12 週的臨床試驗中
                                            </font><font style="vertical-align: inherit;">報告了以下不良反應（</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">見表</font></font></span><a href="#t2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2 ）：</font></font></a><font style="vertical-align: inherit;"></font></p><a name="t2"></a><table width="100%">
                                        <caption><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">表 2：在為期 12 週的三項主要安慰劑對照 3 期研究中，每天使用一次（2.5 或 5 毫克）的 CIALIS 治療患者報告的治療中出現的不良反應和使用藥物比安慰劑更頻繁的 2% 的患者（包括糖&ZeroWidthSpace;&ZeroWidthSpace;尿病患者的研究）用於 CIALIS 每日一次用於 ED
</font></font></span></caption>
                                        <colgroup><col width="39.400%" align="left">
                                            <col width="20.200%" align="left">
                                            <col width="20.200%" align="left">
                                            <col width="20.200%" align="left">
                                        </colgroup><tbody class="Headless">
                                        <tr class="First">
                                            <td class="Botrule Lrule Rrule Toprule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">不良反應</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">安慰劑</font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=248)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 2.5 mg </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=196)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 5 mg </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=304)</font></font></span></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">頭痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">消化不良</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">鼻咽炎</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">背疼</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上呼吸道感染</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">法拉盛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肌痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">咳嗽</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">腹瀉</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">鼻塞</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">四肢疼痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">尿路感染</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">胃食管反流病</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                        </tr>
                                        <tr class="Last">
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">腹痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在一項安慰劑對照臨床研究中，在 24 周治療期間
                                            </font><font style="vertical-align: inherit;">報告了以下不良反應（</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">見表</font></font></span><a href="#t3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3 ）：</font></font></a><font style="vertical-align: inherit;"></font></p><a name="t3"></a><table width="100%">
                                        <caption><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">表 3：在一項針對 CIALIS 治療持續時間為 24 週的安慰劑對照臨床研究中，每天使用一次（2.5 或 5 mg）的 CIALIS 治療患者報告的治療中出現的不良反應（2.5 或 5 mg）和用藥頻率高於安慰劑每日一次用於 ED
</font></font></span></caption>
                                        <colgroup><col width="51.750%" align="left">
                                            <col width="12.900%" align="left">
                                            <col width="18.525%" align="left">
                                            <col width="16.825%" align="left">
                                        </colgroup><tbody class="Headless">
                                        <tr class="First">
                                            <td class="Botrule Lrule Rrule Toprule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">不良反應</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">安慰劑</font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=94)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 2.5 mg </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=96)</font></font></span></td>
                                            <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">他達拉非 5 mg </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=97)</font></font></span></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">鼻咽炎</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">腸胃炎</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">背疼</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">上呼吸道感染</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">消化不良</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">胃食管反流病</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肌痛</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">2%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                        </tr>
                                        <tr>
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">高血壓</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">1%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">3%
                                                    </font></font></td>
                                        </tr>
                                        <tr class="Last">
                                            <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">鼻塞</font></font></span></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0%
                                                    </font></font></td>
                                            <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4%
                                                    </font></font></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div data-sectioncode="42229-5" class="Section"><a name="s47a"></a><a name="section-6.1.2.1"></a><p></p>
                                        <p class="First"><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">CIALIS 用於 BPH 和 ED 和 BPH 的每日一次使用</font></font></span></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在為期 12 週的三項安慰劑對照臨床試驗中，兩項在 BPH 患者中，一項在 ED 和 BPH 患者中，平均年齡為 63 歲（範圍 44 至 93 歲），因不良事件導致的停藥率他達拉非為 3.6%，而安慰劑治療的患者為 1.6%。</font><font style="vertical-align: inherit;">至少 2 名接受他達拉非治療的患者報告導致停藥的不良反應包括頭痛、上腹痛和肌痛。</font><font style="vertical-align: inherit;">報告了以下不良反應（</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">見表</font></font></span><a href="#t4"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">4</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">）。
                                                </font></font></p><a name="t4"></a><table width="100%">
                                            <caption><span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
表 4：在 12 周治療期間的三項安慰劑對照臨床研究中，≥1% 接受 CIALIS 治療的患者報告的治療中出現的不良反應每天使用一次（5 毫克），並且比安慰劑更頻繁，其中包括兩項研究CIALIS 用於 BPH 的每日一次使用和 ED 和 BPH 的一項研究
</font></font></span></caption>
                                            <colgroup><col width="39.487%" align="left">
                                                <col width="30.257%" align="left">
                                                <col width="30.257%" align="left">
                                            </colgroup><tbody class="Headless">
                                            <tr class="First">
                                                <td class="Botrule Lrule Rrule Toprule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
不良反應
</font></font></span></td>
                                                <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
安慰劑</font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=576)
</font></font></span></td>
                                                <td class="Botrule Rrule Toprule" align="center" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
他達拉非 5 mg </font></font><br><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">(N=581)
</font></font></span></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
頭痛
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            2.3%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            4.1%
                                                        </font></font></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
消化不良
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            0.2%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            2.4%
                                                        </font></font></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
背疼
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.4%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            2.4%
                                                        </font></font></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
鼻咽炎
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.6%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            2.1%
                                                        </font></font></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
腹瀉
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.0%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.4%
                                                        </font></font></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
四肢疼痛
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            0.0%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.4%
                                                        </font></font></td>
                                            </tr>
                                            <tr>
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
肌痛
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            0.3%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.2%
                                                        </font></font></td>
                                            </tr>
                                            <tr class="Last">
                                                <td class="Botrule Lrule Rrule" align="left" valign="top"><span class="Bold"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
頭暈
</font></font></span></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            0.5%
                                                        </font></font></td>
                                                <td class="Botrule Rrule" align="center" valign="top"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                                            1.0%
                                                        </font></font></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">此外，在 CIALIS 用於 BPH 或 ED 和 BPH 的對照臨床試驗中報告的不太常見的不良反應（&lt;1%）包括：胃食管反流病、上腹痛、噁心、嘔吐、關節痛和肌肉痙攣。
                                                </font></font></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">背痛或肌痛報告的發病率見表 1 至表 4。在他達拉非臨床藥理學試驗中，背痛或肌痛通常在給藥後 12 至 24 小時發生，通常在 48 小時內消退。</font><font style="vertical-align: inherit;">與他達拉非治療相關的背痛/肌痛的特點是瀰漫性雙側下腰椎、臀肌、大腿或胸腰椎肌肉不適，並因臥床而加劇。</font><font style="vertical-align: inherit;">一般來說，疼痛的嚴重程度被報告為輕度或中度，無需藥物治療即可緩解，但報告的嚴重背痛頻率較低（&lt;所有報告的 5%）。</font><font style="vertical-align: inherit;">需要藥物治療時，對乙酰氨基酚或非甾體類抗炎藥一般有效；</font><font style="vertical-align: inherit;">然而，在一小部分需要治療的受試者中，使用了溫和的麻醉劑（例如，可待因）。</font><font style="vertical-align: inherit;">全面的，</font><font style="vertical-align: inherit;">由於背痛/肌痛，接受 CIALIS 治療的按需使用的所有受試者中約有 0.5% 停止治療。</font><font style="vertical-align: inherit;">在為期 1 年的開放標籤擴展研究中，分別有 5.5% 和 1.3% 的患者報告了背痛和肌痛。</font><font style="vertical-align: inherit;">診斷測試，包括對炎症、肌肉損傷或腎損傷的測量，未發現有醫學意義的潛在病理學證據。</font><font style="vertical-align: inherit;">表 2、3 和 4 描述了每日一次使用 CIALIS 治療 ED、BPH 和 BPH/ED 的發生率。在每日一次使用 CIALIS 的研究中，背痛和肌痛的不良反應通常為輕度或中度並停藥所有適應症的比率&lt;1%。</font><font style="vertical-align: inherit;">在為期 1 年的開放標籤擴展研究中，分別有 5.5% 和 1.3% 的患者報告了背痛和肌痛。</font><font style="vertical-align: inherit;">診斷測試，包括對炎症、肌肉損傷或腎損傷的測量，未發現有醫學意義的潛在病理學證據。</font><font style="vertical-align: inherit;">表 2、3 和 4 描述了每日一次使用 CIALIS 治療 ED、BPH 和 BPH/ED 的發生率。在每日一次使用 CIALIS 的研究中，背痛和肌痛的不良反應通常為輕度或中度並停藥所有適應症的比率&lt;1%。</font><font style="vertical-align: inherit;">在為期 1 年的開放標籤擴展研究中，分別有 5.5% 和 1.3% 的患者報告了背痛和肌痛。</font><font style="vertical-align: inherit;">診斷測試，包括對炎症、肌肉損傷或腎損傷的測量，未發現有醫學意義的潛在病理學證據。</font><font style="vertical-align: inherit;">表 2、3 和 4 描述了每日一次使用 CIALIS 治療 ED、BPH 和 BPH/ED 的發生率。在每日一次使用 CIALIS 的研究中，背痛和肌痛的不良反應通常為輕度或中度並停藥所有適應症的比率&lt;1%。
                                                </font></font></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在根據需要使用 CIALIS 用於 ED 的安慰劑對照研究中，65 歲及以上接受 CIALIS 治療的患者（2.5% 的患者）報告腹瀉的頻率更高</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見特殊人群中的使用 ( </font></font><a href="#s76"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">8.5</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在所有使用任何 CIALIS 劑量的研究中，關於色覺變化的報告很少見（&lt;0.1% 的患者）。
                                                </font></font></p>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">以下部分確定了在 CIALIS 的對照臨床試驗中報告的額外的、頻率較低的事件 (&lt;2%)，每天使用一次或根據需要使用。</font><font style="vertical-align: inherit;">這些事件與 CIALIS 的因果關係尚不確定。</font><font style="vertical-align: inherit;">此列表不包括那些輕微的事件，那些與吸毒沒有合理關係的事件，以及報告太不精確以至於沒有意義：
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">全身</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——虛弱、面部水腫、疲勞、疼痛、外周水腫
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">心血管</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——心絞痛、胸痛、低血壓、心肌梗塞、體位性低血壓、心悸、暈厥、心動過速
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">消化</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——肝功能檢查異常、口乾、吞嚥困難、食管炎、胃炎、GGTP升高、便溏、噁心、上腹痛、嘔吐、胃食管反流病、痔出血、直腸出血
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">肌肉骨骼</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——關節痛、頸部疼痛
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">神經</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——頭暈、感覺遲鈍、失眠、感覺異常、嗜睡、眩暈
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">腎臟和泌尿系統</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——腎功能不全
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">呼吸系統</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——呼吸困難、鼻出血、咽炎
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">皮膚和附件</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——瘙癢、皮疹、出汗
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">眼科</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——視力模糊、色覺改變、結膜炎（包括結膜充血）、眼痛、流淚增多、眼瞼腫脹
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">耳科</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——聽力突然下降或喪失、耳鳴
                                                </font></font></p>
                                        <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">泌尿生殖系統</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——勃起增加，陰莖自發勃起
                                                </font></font></p>
                                    </div>
                                </div>
                            </div>
                            <div data-sectioncode="42229-5" class="Section"><a name="s48"></a><a name="section-6.2"></a><p></p>
                                <h2><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">6.2 售後經驗</font></font></h2>
                                <p class="First"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">在 CIALIS 批准後使用期間，已發現以下不良反應。</font><font style="vertical-align: inherit;">由於這些反應是由數量不確定的人群自願報告的，因此並不總是能夠可靠地估計它們的頻率或建立與藥物暴露的因果關係。</font><font style="vertical-align: inherit;">選擇這些事件是因為它們的嚴重性、報告頻率、缺乏明確的替代因果關係或這些因素的組合。
                                        </font></font></p>
                                <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">心血管和腦血管</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">— 據報導，嚴重心血管事件，包括心肌梗死、心源性猝死、中風、胸痛、心悸和心動過速，在上市後與他達拉非的使用存在時間相關性。</font><font style="vertical-align: inherit;">大多數（但不是全部）這些患者都有預先存在的心血管危險因素。</font><font style="vertical-align: inherit;">據報導，其中許多事件發生在性活動期間或之後不久，據報導少數發生在使用 CIALIS 後不久發生性活動而沒有性活動。</font><font style="vertical-align: inherit;">據報導，其他人發生在使用 CIALIS 和性活動後數小時至數天。</font><font style="vertical-align: inherit;">無法確定這些事件是否與 CIALIS、性活動、患者潛在的心血管疾病、這些因素的組合或其他因素直接相關</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[參見警告和注意事項 ( </font></font><a href="#s27"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.1</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">全身</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——過敏反應，包括蕁麻疹、史蒂文斯-約翰遜綜合徵和剝脫性皮炎
                                        </font></font></p>
                                <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">神經</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">性——偏頭痛、癲癇發作和癲癇復發、短暫性全失憶
                                        </font></font></p>
                                <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">眼科</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">——視野缺損、視網膜靜脈阻塞、視網膜動脈阻塞
                                        </font></font></p>
                                <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">非動脈炎性前部缺血性視神經病變 (NAION) 是導致視力下降（包括永久性視力喪失）的原因，在上市後很少報導與使用 PDE5 抑製劑（包括 CIALIS）的時間相關。</font><font style="vertical-align: inherit;">這些患者中的大多數（但不是全部）具有導致 NAION 發展的潛在解剖或血管危險因素，包括但不一定限於：低杯盤比（“擁擠的盤”）、50 歲以上、糖尿病、高血壓、冠狀動脈疾病、高脂血症和吸煙</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項( </font></font><a href="#s30"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.4</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">耳科</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">— 據報導，上市後聽力突然下降或喪失的病例與使用 PDE5 抑製劑（包括 CIALIS）的時間相關。</font><font style="vertical-align: inherit;">在某些情況下，據報導，醫療條件和其他因素也可能在耳科不良事件中發揮作用。</font><font style="vertical-align: inherit;">在許多情況下，醫療隨訪信息是有限的。</font><font style="vertical-align: inherit;">無法確定這些報告的事件是否與 CIALIS 的使用、患者聽力損失的潛在風險因素、這些因素的組合或其他因素直接相關</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s31"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.5</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                                <p><span class="Bold Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">泌尿生殖系統</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">— 陰莖異常勃起</font></font><span class="Italics"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">[見警告和注意事項 ( </font></font><a href="#s29"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">5.3</font></font></a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> )]</font></font></span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">。</font></font></p>
                            </div>
                            <p class="hide-link"><a href="#"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隱藏</font></font></a></p></div>
                    </div>

                </div>

                <p class="toggle-link"><a href="{{ url('product/'.$goods->id) }}">查看更多處方訊息</a></p>
            </div>

        </div>

    </section>
</div>
@endsection
