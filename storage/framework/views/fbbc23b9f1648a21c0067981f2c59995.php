<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/check.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.contip.js')); ?>"></script>
    <script src="<?php echo e(asset('static/js/sweetalert2.js')); ?>"></script>
    <script src="<?php echo e(asset('static/js/api.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('topic-title','訂單查詢'); ?>

<?php $__env->startSection('topic-sub','CHECK'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首页</a></li>
        <li class="active">訂單查詢</li>
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
                <div class="check-body">
                    <div class="form-main">
                        <form action="" id="check-form" method="post" onsubmit="return orderCheck()">
                            <?php echo e(csrf_field()); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/store-xenical/store-xenical-v1/resources/views/web/order/check.blade.php ENDPATH**/ ?>