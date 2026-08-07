<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/product.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <style>
        .g-icons{
            justify-content: space-around;
        }
        .g-icons li{
            margin-right: 20px;
        }
        .g-icons li .p2 {
            font-size: 14px;
        }
        @media screen and (max-width: 1024px){
            .g-icons li{
                margin-right: 0;
            }

        }
    </style>
<?php $__env->stopSection(); ?>

<?php
    $privacy_text = str_replace(PHP_EOL,"<br>",app('cache.config')->get('privacy_text'));
?>
<?php $__env->startSection('title-before',app('cache.config')->get('site_name').'訂購'); ?>
<?php $__env->startSection('topic-title','減肥藥購買'); ?>
<?php $__env->startSection('topic-sub','SHOPPING ONLINE'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首页</a></li>
        <li class="active">減肥藥購買</li>
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

                <div class="product-body">
                    <?php
                        $product_spec = app('cache.config')->get('product_spec');
                        $product_component = app('cache.config')->get('product_component');
                        $product_manufacturer = app('cache.config')->get('product_manufacturer');
                        $product_valid = app('cache.config')->get('product_valid');
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="goods">
                            <div class="img-wrap">
                                <a href="<?php echo e(url('product/'.$goods->id)); ?>"><img src="<?php echo e(asset_upload($goods->img)); ?>" alt="<?php echo e(strip_tags($goods->name)); ?>"></a>
                            </div>
                            <div class="info">
                                <div class="base">
                                    <a href="<?php echo e(url('product/'.$goods->id)); ?>"><h2 class="name"><?php echo str_replace("<br />"," ",$goods->name); ?></h2></a>
                                    <div class="spec">
                                        <p class="item">【規格】<?php echo e($product_spec); ?></p>
                                        <p class="item">【成份】<?php echo e($product_component); ?></p>
                                        <p class="item">【產地】<?php echo e($product_manufacturer); ?></p>
                                        <p class="item">【有效期】<?php echo e($product_valid); ?></p>
                                    </div>
                                    
                                    <div class="secret">
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
                                </div>

                                <div class="buy">
                                    <div class="price">
                                        <span class="now">NT$<?php echo e(number_format(round($goods->price))); ?></span>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->market_price>$goods->price): ?>
                                        <span class="market">NT$<?php echo e(number_format(round($goods->market_price))); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <p class="go-btn"><a href="<?php echo e(url('shopping/'.$goods->id)); ?>"  data-observer="點擊購買-<?php echo e($goods->name); ?>">點擊購買</a></p>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                </div>

                <div class="product-description">
                    <p class="description-warp">
                        <?php echo app('cache.config')->get('product_page_text2'); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/store-xenical/store-xenical-v1/resources/views/web/product/index.blade.php ENDPATH**/ ?>