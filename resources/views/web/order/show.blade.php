@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/checkout.css') }}"/>
@stop


@section('banners')@stop
@section('header')@stop
@section('footer')@stop

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
            <h1 class="title">訂單詳情</h1>
            <p class="sub">ORDER</p>
        </div>
        <div class="main">

            <div class="wrap">

                <div class="details-body">
                    <div class="order">
                        <dl>
                            <dt>訂單編號</dt>
                            <dd>{{ $order->no }}</dd>
                        </dl>
                        <dl>
                            <dt>訂單狀態</dt>
                            <dd>{{ \Illuminate\Support\Arr::get(\App\Models\Order::STATUS_TXT,$order->status) }}</dd>
                        </dl>
                        <dl>
                            <dt>訂購商品</dt>
                            <dd>
                                {{ $order->products->first()->product_name }}
                            </dd>
                        </dl>
                        <dl>
                            <dt>支付總額</dt>
                            <dd>NT${{ round($order->total_price) }}<span class="freight">（{{ $order->freight>0?"含運費NT$".round($order->freight):"免運費" }}）</span></dd>
                        </dl>
                        <dl>
                            <dt>收貨姓名</dt>
                            <dd>{{ $order->name }}</dd>
                        </dl>
                        <dl>
                            <dt>聯絡電話</dt>
                            <dd>{{ $order->phone }}</dd>
                        </dl>
                        <dl>
                            <dt>收貨方式</dt>
                            <dd>
                                @if($order->delivery_type == 1)
                                    超商(7-11) 取貨付款
                                @elseif($order->delivery_type == 2)
                                    @if($order->shop_type == 2)
                                        超商(全家) 取貨付款
                                    @elseif($order->shop_type == 3)
                                        超商(OK) 取貨付款
                                    @else
                                        超商(萊爾富) 取貨付款
                                    @endif
                                @else
                                    快遞宅配 貨到付款
                                @endif
                            </dd>
                        </dl>
                        @if($order->delivery_type>0)
                            <dl>
                                <dt>門市號</dt>
                                <dd>{{ $order->shop_no }}</dd>
                            </dl>
                            <dl>
                                <dt>門市名稱</dt>
                                <dd>{{ $order->shop_name }}</dd>
                            </dl>
                        @endif
                        <dl>
                            <dt>{{ $order->delivery_type>0?'門市':'收貨' }}地址</dt>
                            <dd>{{ $order->city.$order->county.$order->street.$order->address }}</dd>
                        </dl>
                        <dl>
                            <dt>訂單備注</dt>
                            <dd>{{ $order->remarks?:"無" }}</dd>
                        </dl>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
