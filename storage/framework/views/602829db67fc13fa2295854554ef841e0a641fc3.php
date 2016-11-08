<head>
    <meta charset="UTF-8">
    <title><?php if (! empty(trim($__env->yieldContent('htmlheader_title')))): ?><?php echo $__env->yieldContent('htmlheader_title'); ?> - <?php endif; ?><?php echo e(LAConfigs::getByKey('sitename')); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo e(asset('la-assets/css/bootstrap.css')); ?>" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo e(asset('la-assets/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <link href="<?php echo e(asset('la-assets/css/ionicons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    
    <!-- Theme style -->
    <link href="<?php echo e(asset('la-assets/css/AdminLTE.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?php echo e(asset('la-assets/css/skins/'.LAConfigs::getByKey('skin').'.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo e(asset('la-assets/plugins/iCheck/square/blue.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('la-assets/css/main.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/js/fancybox/jquery.fancybox.css?v=2.1.5')); ?>" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/js/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5')); ?>" />
    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/js/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7')); ?>" />
    <!-- Add Media helper (this is optional) -->



    <?php echo $__env->yieldPushContent('styles'); ?>
    
</head>
