<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/message.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.contip.js')); ?>"></script>
    <script src="<?php echo e(asset('static/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('static/js/api.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('title-before','聯繫我們'); ?>
<?php $__env->startSection('topic-title','聯繫我們'); ?>

<?php $__env->startSection('topic-sub','CONTACT'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首页</a></li>
        <li class="active">聯繫我們</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="intro">
            <p class="text">
                <?php echo str_replace(PHP_EOL,"<br>",app('cache.config')->get('contact_page_text')); ?>

            </p>
        </div>
        <div class="main">
            <div class="wrap">
                <div class="message-body">
                    <form action="" method="post" onsubmit="return messageStore()" id="message-form">
                        <?php echo e(csrf_field()); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/store-xenical/store-xenical-v1/resources/views/web/message.blade.php ENDPATH**/ ?>