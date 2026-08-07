@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/check.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.contip.js') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>


@stop


@section('topic-title','訂單查詢')

@section('topic-sub','CHECK')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首页</a></li>
        <li class="active">訂單查詢</li>
    </ul>
@stop
@section('content')

    <div class="container">
        <div class="intro">
            <p class="text">
                {!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('contact_page_text')) !!}
            </p>
        </div>
        <div class="main">
            <div class="wrap">
                <div class="check-body">
                    <div class="form-main">
                        <form action="" id="check-form" method="post" onsubmit="return orderCheck()">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>訂購姓名：</label>
                                <input class="form-control" type="text" name="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>訂購電話：</label>
                                <input class="form-control" type="tel" name="phone" placeholder="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn form-btn">
                                    <div>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">送出</font></font></p>
                                    </div>
                                </button>
                            </div>
                        </form>
                        <p class="protect"><span>此頁面受到reCAPTCHA 保護</span><span>並適用<a href="https://policies.google.com/privacy" target="_blank">Google 隱私政策</a>及<a href="https://policies.google.com/terms" target="_blank">服務條款</a></span></p>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
