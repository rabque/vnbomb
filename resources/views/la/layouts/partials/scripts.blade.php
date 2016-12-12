<!-- REQUIRED JS SCRIPTS -->
<script>
    var BASE_URL = '<?php echo URL::to('/'.Config::get("laraadmin.adminRoute")); ?>'
</script>
<!-- jQuery 2.1.4 -->
<script src="{{ asset('la-assets/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('la-assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- jquery.validate + select2 -->
<script src="{{ asset('la-assets/plugins/jquery-validation/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/bootstrap-datetimepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<!-- bootstrap datepicker -->
<!-- AdminLTE App -->
<script src="{{ asset('la-assets/js/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('la-assets/plugins/stickytabs/jquery.stickytabs.js') }}" type="text/javascript"></script>
<script src="{{ asset('la-assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
<script src="{{ asset('la-assets/js/main.js?t='.Config::get("constants.VERSION_ASSETS")) }}" type="text/javascript"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="{{ asset('/js/fancybox/jquery.mousewheel-3.0.6.pack.js') }}"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="{{ asset('/js/fancybox/jquery.fancybox.js?v=2.1.5') }}"></script>
<script type="text/javascript" src="{{ asset('/js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
<script type="text/javascript" src="{{ asset('/js/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>
<script type="text/javascript" src="{{ asset('/js/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>


@stack('scripts')