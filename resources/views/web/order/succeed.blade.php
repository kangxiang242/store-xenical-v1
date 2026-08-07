@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/checkout.css') }}"/>
    <style>
        .success-ico{

        }
        .circle {
            stroke-dasharray: 1194;
            stroke-dashoffset: 1194;
            transform: rotate(-67deg)translate(-274px,10px);
        }
        .tick {
            stroke-dasharray: 350;
            stroke-dashoffset: 350;
            transform: translate(-30px,-100px);

        }
        svg .tick {
            animation: tick .8s ease-out;
            animation-fill-mode: forwards;
            animation-delay: .95s;
        }
        svg .circle {
            animation: circle 1s ease-in-out;
            animation-fill-mode: forwards;
        }
        @keyframes circle {
            from {
                stroke-dashoffset: 1194;
            }
            to {
                stroke-dashoffset: 2288;
            }
        }

        @keyframes tick {
            from {
                stroke-dashoffset: 350;
            }
            to {
                stroke-dashoffset: 0;
            }
        }

    </style>
@stop

@section('script')
    @parent

@stop
@section('banners')@stop
@section('header')
@stop
@section('footer')
@stop

@section('title-before','訂單已安全建立')

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
            <h1 class="title">送出成功</h1>
            <p class="sub">FINISH</p>
        </div>
        <div class="main">
            <div class="wrap">
                <div class="success-body">
                    <div class="success-ico">
                        <svg width="300" height="300">
                            <circle fill="none" stroke="#28A32C" stroke-width="13" cx="200" cy="200" r="100" class="circle" stroke-linecap="round" />
                            <polyline fill="none" stroke="#28A32C" stroke-width="13" points="149,239 187,281 291,180" stroke-linecap="round" stroke-linejoin="round" class="tick"  />
                        </svg>
                    </div>
                    <p class="text">訂單已安全建立，請耐心等候配送</p>
                    <p><a class="home-btn" href="{{ url('/') }}">返回首頁</a></p>
                    <p><a class="order-btn" href="{{ url('order/'.$order->no) }}">查看訂單詳情</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
