<!DOCTYPE html>
<html>

<head>
    <?php echo $__env->make('partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>
<!-- Start: Preloader section
        ========================== -->
<div id="loader-wrapper" class="loader-wrapper">
    <div class="loader-inner">
        <div class="ball-scale-multiple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<div class="wrapper">
<?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Main Content -->
<?php echo $__env->yieldContent('content'); ?>
<!-- /Main Content -->
<?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php echo $__env->make('partials.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
