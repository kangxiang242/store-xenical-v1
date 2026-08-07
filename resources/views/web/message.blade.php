@extends('web.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/message.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.contip.js') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>



@stop
@section('title-before','聯繫我們')
@section('topic-title','聯繫我們')

@section('topic-sub','CONTACT')

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首页</a></li>
        <li class="active">聯繫我們</li>
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
                <div class="message-body">
                    <form action="" method="post" onsubmit="return messageStore()" id="message-form">
                        {{ csrf_field() }}
                        <div class="form-main">
                            <div class="form-group">
                                <label>姓名：</label>
                                <input class="form-control" type="text" name="name" placeholder="請輸入你的稱呼">
                            </div>

                            <div class="form-group">
                                <label>聯絡電話：</label>
                                <input class="form-control" type="text" name="phone" placeholder="請輸入聯絡你的電話號碼">
                            </div>
                            <div class="form-group">
                                <label>E-mail：</label>
                                <input class="form-control" type="text" name="email" placeholder="請輸入聯絡你的電子郵箱">
                            </div>
                            <div class="form-group">
                                <label>留言類型：</label>
                                <select class="form-control" name="type">
                                    <option value="1">售前咨詢</option>
                                    <option value="2">劑量咨詢</option>
                                    <option value="3">修改訂單資訊</option>
                                    <option value="5">意見或建議</option>
                                    <option value="6">退換貨</option>
                                    <option value="0" selected>其它</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>留言內容：</label>
                                <textarea class="form-control form-textarea" name="content" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn form-btn">
                                    <div>
                                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">送出</font></font></p>
                                    </div>
                                </button>
                            </div>

                        </div>
                        <p class="protect">
                            此頁面受到reCAPTCHA 保護<br>並適用<a href="https://policies.google.com/privacy" target="_blank">Google 隱私政策</a>及<a href="https://policies.google.com/terms" target="_blank">服務條款</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
