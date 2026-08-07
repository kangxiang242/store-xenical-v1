<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/index.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <style>
        .g-icons li{
            margin-right: 16px;
        }
        @media screen and (max-width: 1024px){
            .g-icons {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                transform: translateX(-16px);
            }
            .g-icons li{
                margin-right: 0;
            }
        }


    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body-class','_show_loading'); ?>
<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.marquee.min.js')); ?>"></script>
    <script>
        $(function(){
            $('#loading').animate({'visibility':'auto'},1000,function(){
                $('header').addClass('shown')
                $('#carouselMain').addClass('shown')

                loading(0)


            });

        });

        $('.scroll-target').waypoint(function(e) {
            $($(this)[0].element).addClass('show')

        }, { offset: '80%' });

    </script>
    <script>
        $('#loopWrap').marquee({
            //duration in milliseconds of the marquee

            speed:30,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover:true,
            startVisible:true,

        });


    </script>
    <script>
        $('.faq-item').click(function () {
            if($(this).find('.faq-title').hasClass('faq-show')){
                $(this).find('.faq-title').removeClass('faq-show');
            }else{
                $(this).find('.faq-title').addClass('faq-show');
            }
            $(this).find('.faq-desc').slideToggle();
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banners'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <section class="carousel" id="carouselMain">

        <div class="picture">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->img): ?>
                            <div class="swiper-slide">
                                <div class="topic">
                                    <div class="pic">
                                        <a href="<?php echo e($item->href?url($item->href):"javascript:;"); ?>">
                                            <div class="back" style="background-image: url(<?php echo e(asset('uploads/'.$item->img)); ?>)"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
        <div class="abbr">
            <div class="information">

                <div class="central">
                    <h1 class="slogan">
                        <span class="digit"><?php echo e(mb_substr(app('cache.config')->get('home_slogan'),0,1)); ?></span>
                        <span class="digit"><?php echo e(mb_substr(app('cache.config')->get('home_slogan'),1,1)); ?></span>
                        <span class="text"><?php echo e(mb_substr(app('cache.config')->get('home_slogan'),2)); ?></span>
                    </h1>
                    <p class="simple"><?php echo str_replace(PHP_EOL,"<br>",app('cache.config')->get('home_slogan2')); ?></p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app('cache.config')->get('home_pills')): ?>
                        <div class="pills"><img src="<?php echo e(asset_upload(app('cache.config')->get('home_pills'))); ?>" alt="藥丸"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

            </div>
            
            <div class="privacy">
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
        <div class="scroll">
            <p>購買<?php echo e(app('cache.config')->get('site_name')); ?></p>
            <div class="roll"></div>
        </div>
    </section>



    <section class="section left product-section scroll-target init">
        <div class="section-inner">
            <h2>
                <p class="en">SHOPPING ONLINE</p>
                <p class="cn">減肥藥購買</p>
            </h2>
            <div class="row-wrapper">
                <?php
                    $product_spec = app('cache.config')->get('product_spec');
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row scroll-target init ">
                    <ul>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="scroll-target-sp init show">
                            <div class="goods">
                                <figure>
                                    <p class="goods-img"><a href="<?php echo e(url('product/'.$goods->id)); ?>"><img src="<?php echo e(asset_upload($goods->img)); ?>" alt="<?php echo e(strip_tags($goods->name)); ?>"></a></p>
                                    <figcaption>
                                        <a href="<?php echo e(url('product/'.$goods->id)); ?>"><p class="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $goods->name; ?></font></font></p></a>
                                        <p class="spec"><?php echo e($product_spec); ?></p>
                                        <div class="price">
                                            <span class="now">NT$<?php echo e(number_format(round($goods->price))); ?></span>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($goods->market_price>$goods->price): ?>
                                            <span class="market">NT$<?php echo e(number_format(round($goods->market_price))); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <p class="go-btn"><a href="<?php echo e(url('shopping/'.$goods->id)); ?>" data-observer="點擊購買-<?php echo e($goods->name); ?>">點擊購買</a></p>
                                    </figcaption>
                                </figure>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="btn scroll-target init ">
                <a href="<?php echo e(url('product')); ?>" data-observer="查看全部優惠方案">
                    <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">查看全部優惠方案</font></font></p>
                </a>
            </div>


        </div>

    </section>

    <section class="section-about">
        <div class="section-inner">
            <h2>
                <p class="en">ABOUT</p>
                <p class="cn">關於<?php echo e(app('cache.config')->get('site_name')); ?></p>
            </h2>
            <div class="statement">
                <h2 class="about-title scroll-target init"><?php echo app('cache.config')->get('home_about_title'); ?></h2>
                <div class="about-text scroll-target init">
                    <?php echo str_replace(PHP_EOL,'<br>',app('cache.config')->get('home_about_text')); ?>

                </div>
            </div>


        </div>
    </section>

    <section class="section shipping-section scroll-target init">

        <div class="section-inner">
            <h2>
                <span class="en"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">NEWS</font></font></span>
                <span class="cn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">出貨公告</font></font></span>
            </h2>

            <div class="main scroll-target init" id="loopWrap">
                <div class="loop" >
                    <?php
                        $time = date('Y-m-d',strtotime('-1 day'));
                        $hs = [1,3,6,9,12,15,18];
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i=0;$i<=20;$i++): ?>
                    <div class="news">
                        <p class="cate"><?php echo e($time); ?></p>
                        <p class="text">顧客手機末三碼<?php echo e(rand(100,999)); ?>訂購<?php echo e(app('cache.config')->get('site_name')); ?>【<?php echo e(array_get($hs,array_rand($hs))); ?>盒】經過隱密包裝已發出，請留意手機簡訊查收！</p>
                    </div>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                </div>
            </div>
        </div>

    </section>

    <div class="news-category">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $article_cate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="section <?php echo e(!$key%2==0?"":"right"); ?> section-works scroll-target init">
            <div class="section-inner">
                <h2>
                    <span class="en"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo e($cate->sub_name); ?></font></font></span>
                    <span class="cn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo e($cate->name); ?></font></font></span>
                </h2>
                <div class="row-wrapper">
                    <div class="row scroll-target init ">
                        <ul>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cate->article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="scroll-target-sp init show">
                                <a href="<?php echo e(url($news->cate->uri.'/'.$news->id)); ?>">
                                    <figure>
                                        <p class="works-img"><img src="<?php echo e(asset_upload($news->img)); ?>" alt="<?php echo e($news->img_alt?:$news->title); ?>"></p>
                                        <figcaption>
                                            <p class="title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo e($news->title); ?></font></font></p>
                                            
                                        </figcaption>
                                    </figure>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="btn scroll-target init ">
                    <a href="<?php echo e(url($cate->uri)); ?>" data-observer="查看更多<?php echo e($cate->name); ?>">
                        <p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">查看更多<?php echo e($cate->name); ?></font></font></p>
                    </a>
                </div>
            </div>
        </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($faqs && !$faqs->isEmpty()): ?>
        <section class="section faqs-section scroll-target init">

            <div class="section-inner">
                <h2>
                    <span class="en"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FQAs</font></font></span>
                    <span class="cn"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">常見問題</font></font></span>
                </h2>
                <div class="main scroll-target init" >
                    <div class="faq-main">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="faq-item">
                                <div class="faq-title ">
                                    <p>Q<?php echo e(++$key); ?>：<?php echo e($item->questions); ?></p>
                                </div>
                                <p class="faq-desc">
                                    <?php echo e($item->answers); ?>

                                </p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>


                </div>
            </div>

        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app('cache.config')->get('home_foot_title')): ?>
    <div class="backdrop-text">
        <p class="p1"><?php echo e(app('cache.config')->get('home_foot_title')); ?></p>
        <p class="p2"><?php echo app('cache.config')->get('home_foot_text'); ?></p>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/store-xenical/store-xenical-v1/resources/views/web/index.blade.php ENDPATH**/ ?>