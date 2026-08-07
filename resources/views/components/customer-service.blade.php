<div class="customer-service ">
    <div class="entrance">
        <i class="iconfont" id="customer-icon">&#xe637;</i>
    </div>
    <div class="chat-window close-chat-main">
        <div class="with">
            <div class="avatar-wrap">
                <img id="kf-avatar" src="{{ asset_upload(app('cache.config')->get('manual_customer_avatar')) }}" alt="人工客服">
            </div>
            <div class="user">
                <p class="nickname">{{ app('cache.config')->get('manual_customer_nickname') }}</p>
                <p class="status">
                    <span class="dots on"></span>
                    <span class="text">Online</span>
                </p>
            </div>
            <a class="close-chat" href="javascript:;"></a>
        </div>
        <div class="chat-main" id="message-content">



            {{--<div class="message propose ">
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
            </div>

            <div class="queue"><span class="label"><i class="iconfont">&#xe603;</i>当前有100+人正在排队</span></div>

            <div class="message reply">
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
            </div>--}}



        </div>
        <div class="send">
            <div class="message">
                <form onsubmit="return sendMessage()">
                    <input id="customer-content" name="search" placeholder="提出問題..." />
                </form>
            </div>
            <div class="over" id="send-message"><i class="iconfont">&#xe604;</i></div>
        </div>
    </div>
</div>
