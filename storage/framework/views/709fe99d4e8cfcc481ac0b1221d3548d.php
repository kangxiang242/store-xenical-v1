<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/news.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/pagination.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <style>
        @media screen and (min-width: 1024px) {
            .guide-scroll{
                display: none;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script>

        $(document).ready(function(){
            const $ScrollWrap = $(window)
            // 监听滚动停止
            let t1 = 0;
            let t2 = 0;
            let timer = null; // 定时器
            $ScrollWrap.on("touchstart", function(){

                // 触摸开始 ≈ 滚动开始
            })
            $ScrollWrap.on("scroll", function(){
                $('.elevator').addClass('slipOut')

                // 滚动
                clearTimeout(timer)
                timer = setTimeout(isScrollEnd, 300)
                t1 = $ScrollWrap.scrollTop()
                if(t1<=0){

                }else{

                }
            })
            function isScrollEnd() {
                t2 = $ScrollWrap.scrollTop();
                if(t2 == t1){
                    $('.elevator').removeClass('slipOut')

                    clearTimeout(timer)
                }

            }


        })
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title-before',$cate?$cate->name:"相關資訊"); ?>
<?php $__env->startSection('topic-title',$cate?$cate->name:"相關資訊"); ?>
<?php $__env->startSection('topic-sub',$cate?$cate->sub_name:"NEWS"); ?>

<?php $__env->startSection('banner-section-append'); ?>
    <div class="elevator">
        <a href="<?php echo e(url('product')); ?>">
            <p class="p1">購買<?php echo e(app('cache.config')->get('site_name')); ?></p>
            <p class="ico"><i class="iconfont">&#xeb21;</i></p>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>">首页</a></li>
        <li class="active"><?php echo e($cate->name); ?></li>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container no-curtain">

        <div class="main">
            <div class="news-body">

                <ul class="news">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="item">

                            <a class="ls" href="<?php echo e(url($item->cate->uri.'/'.$item->id)); ?>">
                                <div class="yiv">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->img): ?>
                                    <div class="img-wrapper"><img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->img_alt?:$item->title); ?>"></div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="info">
                                        
                                        <p class="new-title"><?php echo e($item->title); ?></p>
                                    </div>
                                    <div class="go"><span>more</span></div>
                                </div>

                            </a>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
                <div class="pagination">
                    <?php echo $news->links(); ?>

                </div>

            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/store-xenical/store-xenical-v1/resources/views/web/news/index.blade.php ENDPATH**/ ?>