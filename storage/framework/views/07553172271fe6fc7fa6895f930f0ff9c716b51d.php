<!-- End: Preloader section
========================== -->
<header id="header" class="white-alt-bg header">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="logo"> <a href="/"> <img src="<?php echo e($configs->logo); ?>" alt=""></a> </div>
                <button class="menu visible-xs" id="menu"></button>
            </div>
            <div class="col-sm-10">
                <nav class="navigation">
                    <ul class="anchor-nav black-dark-bg">
                        <?php if(!empty($menuTop)): ?>
                            <?php $__currentLoopData = $menuTop; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <li>
                                    <a href=" <?php echo e($menu->url.\Config::get("constants.PREFIX_URL")); ?>">
                                        <?php echo e($menu->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php endif; ?>

                    </ul>
                    <!---->
                </nav>
            </div>
        </div>
    </div>
</header>
