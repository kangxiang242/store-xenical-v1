<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($layout['seo'])): ?>
        <title><?php echo e(isset($layout['seo'])?$layout['seo']->title:""); ?></title>
    <?php else: ?>
        <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('keywords')))): ?>
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>"/>
    <?php else: ?>
    <meta name="keywords" content="<?php echo e(isset($layout['seo'])?$layout['seo']->key_word:""); ?>"/>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if (! empty(trim($__env->yieldContent('description')))): ?>
    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>"/>
    <?php else: ?>
    <meta name="description" content="<?php echo e(isset($layout['seo'])?$layout['seo']->description:""); ?>"/>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <link rel="canonical" href="<?php echo e(config('app.url')); ?>/<?php echo e(trim(request()->path(),'/')); ?>">
    <link rel="alternate" hreflang="zh-TW">
    <link rel="shortcut icon" href="<?php echo e(\App\Services\ConfigService::get('favicon')?asset('uploads/'.\App\Services\ConfigService::get('favicon')):'/favicon.ico'); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
    <?php $__env->startSection('style'); ?>
        <style>
            :root{
                --back-color: <?php echo app('cache.config')->get('back_color'); ?>;
                --main-color: <?php echo app('cache.config')->get('main_color'); ?>;
                --auxiliary-color: <?php echo app('cache.config')->get('auxiliary_color'); ?>;
                --darken-main-color: <?php echo colorDarken(app('cache.config')->get('main_color'),10); ?>;
                --section-back-color: <?php echo app('cache.config')->get('index_section_color'); ?>;
                --font-family:<?php echo app('cache.config')->get('font'); ?>;
            }
        </style>
        
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/style.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/css/common.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/global.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('static/font_3122894_ix34x1wtlao/iconfont.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('static/swiper4/swiper.min.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>">

    <?php echo $__env->yieldSection(); ?>

    <script src="<?php echo e(asset('static/js/jquery.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/observer.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.waypoints.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>

    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '<?php echo session()->get('flash'); ?>';

        if(flash_data){
            flash_data = JSON.parse('<?php echo session()->get('flash'); ?>');

        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("<?php echo e(\App\Services\ConfigService::get('freight_where',0)); ?>");
        var free_shipping_freight = parseInt("<?php echo e(\App\Services\ConfigService::get('freight',0)); ?>");

    </script>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!config('app.debug')): ?>
        <script>
            var host = window.location.host;
            var current_host = "<?php echo e(config('app.url')); ?>"
            var host_bool = current_host.search(host) != -1;
            if(!host_bool){
                window.location.href = current_host;
            }
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <style type="text/css">
        <?php echo app('cache.config')->get('theme_css'); ?>

    </style>
</head>
<body class="<?php echo $__env->yieldContent('body-class'); ?>">

<div class="global-loading hidden" id="loading">
    <img width="50" src="<?php echo e(asset_upload(app('cache.config')->get('loading_image'))); ?>" alt="loading">
</div>

<div class="main-body">
<?php $__env->startSection('header'); ?>
<header class="<?php echo e(request()->path() == '/'?"ef":""); ?> <?php echo $__env->yieldContent('header-class'); ?>">
    <div class="wrapper">
        <div class="logo-sec">
            <a href="<?php echo e(url('/')); ?>" class="lds-logo-lilly logo-red">
                <img height="100%" src="<?php echo e(app('cache.config')->get('logo')?asset_upload(app('cache.config')->get('logo')):asset('static/img/logo.jpg')); ?>" alt="<?php echo e(app('cache.config')->get('site_name')); ?>">
            </a>
        </div>
        <div class="drawer-btn">
            <i class="iconfont">&#xe62c;</i>
        </div>
        <div class="nav-sec">
            <ul class="base">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $layout['nav']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="link-parent">
                    <a class="base-link <?php echo e(request()->path()==trim($nav->link,'/')?"activate":""); ?>" href="<?php echo e(url($nav->link)); ?>"><?php echo e($nav->name); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <li class="link-parent pc-hide">
                    <a class="base-link" href="/payment-delivery">付款與配送</a>
                </li>
                <li class="link-parent pc-hide">
                    <a class="base-link" href="/after-sales">售後服務</a>
                </li>
            </ul>
            <div class="online"><a href="<?php echo e(url('product')); ?>">減肥藥購買</a></div>
        </div>
    </div>

</header>
<?php echo $__env->yieldSection(); ?>


<?php $__env->startSection('banners'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout['banners'] && !$layout['banners']->isEmpty()): ?>
        <section class="banner-section">
            <div class="banner-content">
                <div class="vis">
                    <div class="inner" style="background-image: url('<?php echo e(asset_upload($layout['banners']->first()->img)); ?>')"></div>

                </div>
                <div class="rep">
                    <p class="rep-sub"><?php echo $__env->yieldContent('topic-sub'); ?></p>
                    <?php if (! empty(trim($__env->yieldContent('topic-title-p')))): ?>
                        <p class="rep-title"><?php echo $__env->yieldContent('topic-title'); ?></p>
                    <?php else: ?>
                        <h1 class="rep-title"><?php echo $__env->yieldContent('topic-title'); ?></h1>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php echo $__env->yieldContent('breadcrumb'); ?>

                </div>
            </div>
            <?php echo $__env->yieldContent('banner-section-append'); ?>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php echo $__env->yieldSection(); ?>



<?php echo $__env->yieldContent('content'); ?>


<?php $__env->startSection('footer'); ?>
<footer>

    <div class="footer-inner">
        <div class="footer-nav">


            <ul class="menu-list">
                <li><a href="<?php echo e(url('product')); ?>">減肥藥購買</a></li>
                <li><a href="<?php echo e(url('news')); ?>" ><?php echo e(app('cache.config')->get('site_name')); ?>資訊</a></li>

                <li><a href="<?php echo e(url('check')); ?>">訂單查詢</a></li>

                <li><a href="<?php echo e(url('guide')); ?>" >訂購指南</a></li>

                <li><a href="<?php echo e(url('message')); ?>">聯繫我們</a></li>

                <li><a href="<?php echo e(url('payment-delivery')); ?>">付款與配送</a></li>

                <li><a href="<?php echo e(url('after-sales')); ?>">售後服務</a></li>

            </ul>
            <div class="office">

                <?php echo str_replace(PHP_EOL,"<br>",app('cache.config')->get('foot_text')); ?>

            </div>

        </div>
    </div>
    <p class="copyright"><?php echo app('cache.config')->get('copyright'); ?></p>
    <p class="spot"><?php echo e(app('cache.config')->get('site_name_en')); ?></p>
</footer>
<?php echo $__env->yieldSection(); ?>
</div>
</body>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('static/js/less.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
<script src="<?php echo e(asset('static/swiper4/swiper.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
<script src="<?php echo e(asset('static/js/jquery.cookie.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
<script src="<?php echo e(asset('static/js/xie.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>

<?php echo \App\Services\ConfigService::get('google_ga'); ?>


<script>
    function loading(is_show){
        if(is_show){
            $('body').addClass('_show_loading');
        }else{
            $('body').removeClass('_show_loading');
        }

    }
    $(document).scroll(function() {
        var scroH = $(document).scrollTop();  //滚动高度
        var viewH = $(window).height();  //可见高度
        var contentH = $(document).height();  //内容高度

        if(scroH>100){
            $('header').addClass('fixed')

        }

        if(scroH<100){
            $('header').removeClass('fixed')
        }

    });
    $('.drawer-btn').click(function(){
        if($('.nav-sec').hasClass('m-show')){
            $('.nav-sec').removeClass('m-show')
            $(this).find('i').html('&#xe62c;')
        }else{
            $('.nav-sec').addClass('m-show')
            $(this).find('i').html('&#xeca0;')
        }
    });
</script>
<?php echo $__env->yieldSection(); ?>

</html>
<?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/store-xenical/store-xenical-v1/resources/views/web/layout.blade.php ENDPATH**/ ?>