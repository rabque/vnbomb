<div class="section-first  grey-dark-alt-bg text-center  text-center foot-content">
    <div class="container">
        <ul class="social-links footer-social-link">
            <?php if(!empty($menuFooter)): ?>
                <?php $__currentLoopData = $menuFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li>
                        <a href=" <?php echo e($menu->url.\Config::get("constants.PREFIX_URL")); ?>">
                            <?php echo e($menu->name); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="block-content">
                    <?php echo e($configs->footer); ?>

                </div>
            </div>

        </div>
        <span class="copy-right dis-blk">© Copyright <?php echo e(date("Y")); ?> <?php echo e($configs->name); ?> <span></span></span>
        <ul class="social-links">
            <?php if(!empty($socials)): ?>
                <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li> <a class="icon-social-<?php echo e($social->icon); ?>" href="<?php echo e($social->url); ?>"></a> </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php endif; ?>

        </ul>
    </div>
</div>