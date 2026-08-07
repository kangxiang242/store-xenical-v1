@extends('web.layout')
@php
    $freight_where = \App\Services\ConfigService::get('freight_where',0);
    $freight_price = \App\Services\ConfigService::get('freight',0);

    $delivery_type_all = \App\Services\ConfigService::get('delivery_type',[]);
    if($delivery_type_all){
        $delivery_type_all = json_decode(\App\Services\ConfigService::get('delivery_type',[]),true);
    }
@endphp
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/checkout.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        footer{
            display: none;
        }
        .pc-flex{
            display: flex;
            width: 72vw;
            margin: 0 auto;
            margin-bottom: 20px;

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

@section('header')
@stop
@section('customer-service')
@stop
@section('banners')
@stop

{{--@section('title-before',$goods->name)--}}

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.contip.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/relx.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/xarea.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        $(".form-input").focus(function(){
            if(!$(this).hasClass(focus)){
                $(this).addClass('focus');
            }

        })
        $(".form-input").blur(function(){
            if(!$(this).val()){
                $(this).removeClass('focus');
            }
        });
        $('.label').click(function(){
            $(this).prev().focus();
        })

        $('input[name="order_type"]').click(function(){
            if($(this).val()>0){
                $('#rel-order-type').text("取貨付款");
            }else{
                $('#rel-order-type').text("貨到付款");
            }

        })


    </script>

@stop


@section('content')
    <div class="header">
        <div class="c-logo">
            <a href="{{ url('/') }}" class="lds-logo-lilly logo-red">
                <img src="{{ app('cache.config')->get('checkout_logo')?asset_upload(app('cache.config')->get('checkout_logo')):asset_upload(app('cache.config')->get('logo')) }}" alt="logo">
            </a>
        </div>
    </div>

    <div class="container">
        <div class="intro">
            <h1 class="title">快速結帳</h1>
            <p class="sub">CHECKOUT</p>
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
            <form onsubmit="return orderStore();" method="POST" action="{{ url('order') }}" id="order-form">
                {{ csrf_field() }}
                <input type="hidden" value="{{ request()->keyt }}" name="keyt">
                <input type="hidden" value="{{ $form_token }}" name="form_token">
                <input type="hidden" value="{{ $goods->id }}" name="goods_id">
                <div class="wrap">

                    <div class="checkout-body">
                        <div class="unusual">
                            <div class="group">
                                <div class="must">確認訂單</div>
                                <div class="content">
                                    <div class="goods">
                                        <p class="name">{{ str_replace("<br />"," ",$goods->name) }}</p>
                                        <div class="count">
                                            <dl>
                                                <dt>商品售價：</dt>
                                                <dd><span class="red">NT$ {{ number_format(round($goods->price)) }}</span></dd>
                                            </dl>
                                            <dl>
                                                <dt>運費：</dt>
                                                <dd><span class="red">NT$ {{ number_format($goods->price>=$freight_where?0:$freight_price) }}</span></dd>
                                            </dl>
                                            <dl>
                                                <dt>支付總額：</dt>
                                                <dd><span class="red">NT$ {{ number_format(round($goods->price>=$freight_where?$goods->price:$goods->price+$freight_price)) }}</span></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="group">
                                <div class="must">配送方式</div>
                                <div class="content">
                                    <div class="radio-group">
                                        <label for="order_type_1">
                                            <input type="radio" name="order_type" value="1" id="order_type_1" checked>
                                            <span class="text s-711">7-11超商 取貨付款</span>
                                        </label>
                                        <label for="order_type_0">
                                            <input type="radio" name="order_type" value="0" id="order_type_0">
                                            <span class="text s-heimao">宅配到府 貨到付款</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="must">配送地址</div>
                                <div class="content">
                                    <div class="form-box">
                                        <label>選擇縣市</label>
                                        <div class="load-select" id="load-1" >
                                            <select name="city" id="city" data-verify="required" data-verify-message="required:請選擇縣市">
                                                <option value="">點我選擇縣市</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-box">
                                        <label>選擇地區</label>
                                        <div class="load-select" id="load-2" >
                                            <select name="county" id="county" data-verify="required" data-verify-message="required:請選擇地區">
                                                <option value="">點我選擇地區</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-box">
                                        <label>選擇路段</label>
                                        <div class="load-select" id="load-3" >
                                            <select name="street" id="street" data-verify="required" data-verify-message="required:請選擇路段">
                                                <option value="">點我選擇路段</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-box" id="form-address-row">
                                        <label>詳細地址</label>
                                        <div class="fl">
                                            <input type="text" name="address" data-verify="required" data-react-verify="order_type:0" data-verify-message="required:請填寫詳細地址">
                                        </div>
                                    </div>

                                    <div class="form-box" id="form-store-row">
                                        <label>選擇門市</label>
                                        <div class="load-select" id="load-4" >
                                            <select name="store_id" id="show-store-shop" data-verify="required" data-react-verify="order_type:1" data-verify-message="required:請選擇路段">
                                                <option value="">點我選擇門市</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="must">收貨人</div>
                                <div class="content">
                                    <div class="department">
                                        <input type="text" name="name" data-verify="required" data-verify-message="required:請填寫收貨人">
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="must">聯絡電話</div>
                                <div class="content">
                                    <div class="department">
                                        <input type="number" name="phone" pattern="[0-9]*" data-verify="required|phone" data-verify-message="required:請填寫聯絡電話|phone:聯絡電話格式錯誤,如：0912345678">
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <div class="must">訂單留言</div>
                                <div class="content">
                                    <div class="department">
                                        <input type="text" name="remarks" >
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="others-sec">
                                <div class="others">
                                    <p class="title">隱私保護說明</p>
                                    <div class="other-sub">
                                        <div class="sub">
                                            <p style="line-height: 1.5;">為促進環境保護，我們將採用<strong>紙盒全新包裝</strong>。包裝外無任何標識字樣及顧客個資，請放心選購。</p>
                                            <svg version="1.1" class="packageicon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 400 400" enable-background="new 0 0 400 400" xml:space="preserve">
                                                <g style="transform: translate(-380px,-560px);">
                                                    <polygon fill="#CFB594" points="593.681,654.906 690.7,701.207 565.869,738.273 467.468,688.141 	"/>
                                                    <polygon fill="#BCA286" points="690.126,833.889 565.641,878.104 565.641,737.836 690.7,701.207 	"/>
                                                    <polygon fill="#F0DCC0" points="467.468,688.141 467.731,818.383 565.641,878.104 565.641,737.836 	"/>
                                                    <polygon fill="#E0D3C2" points="503.856,706.543 631.332,672.873 644.787,679.277 518.163,713.838 	"/>
                                                    <polygon fill="#E0D3C2" points="522.395,673.727 619.738,721.99 636.41,717.201 537.614,669.707 	"/>
                                                    <polygon fill="#DAC4AE" points="619.738,721.99 636.41,717.201 636.41,755.25 620.336,762.26 	"/>
                                                    <polygon fill="#F7E8D5" points="503.856,706.543 518.163,713.838 518.163,754.994 503.799,746.102 	"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="sub">
                                            <p style="line-height: 1.5;">為保障交易隱私安全，訂購時建議使用代稱。</br>商品送達後<strong>僅透過簡訊</strong>通知取貨，簡訊內容亦<strong>不會提及</strong>內容物及店家，<strong>絕不會致電打擾</strong>，請顧客及時留意簡訊即可。</p>
                                            <img src="/static/img/message.jpg" alt="">
                                        </div>
                                        
                                    </div>
                                </div>
                              
                            </div> -->
                        </div>

                        <div class="bottom">
                            <button type="submit" class="btn form-btn" data-observer="送出">
                                <div>
                                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">送出</font></font></p>
                                </div>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection




