<!DOCTYPE html>
<html>

<head>
    @include('partials.meta')
    @include('partials.script')
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
@include('partials.header')
<!-- Main Content -->
@yield('content')
<!-- /Main Content -->
@include('partials.footer')
</div>

</body>
</html>
