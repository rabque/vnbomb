<!-- End: Preloader section
========================== -->
<header id="header" class="white-alt-bg header">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="logo"> <a href="/"> <img src="{{ $configs->logo }}" alt=""></a> </div>
                <button class="menu visible-xs" id="menu"></button>
            </div>
            <div class="col-sm-10">
                <nav class="navigation nav navbar bootsnav">
                    <ul class="anchor-nav black-dark-bg" data-in="fadeInDown" data-out="fadeOutUp">
                        <li>
                            <a href="{{ url("/games?uuid=".$uuid)  }}">Start game</a>
                        </li>
                        @if(!empty($menuTop))
                            @foreach($menuTop as $menu)
                                <li>
                                    <a href=" {{ $menu->url.\Config::get("constants.PREFIX_URL")  }}">
                                        {{ $menu->name  }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                        <li class="dropdown megamenu-fw">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Your Account</a>
                            <ul class="dropdown-menu megamenu-content" role="menu">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="" method="post" class="form-inline" role="form">
                                                <div class="form-group mb20">
                                                    <p>To access your account you may return to your unique URL at any time. Do not share your player URL as this will compromise your account. You may also protect your URL by locking it with a password.</p>
                                                    <hr>
                                                </div>

                                                <div class="form-group mb20">
                                                    <label for="">Your display name </label>
                                                    <input type="text" class="form-control" name="" id="username" placeholder="{{ $uuid_name }}" value="{{ $uuid_name }}">
                                                </div>

                                                <div class="clearfix"></div>
                                                <div class="form-group mb20">
                                                    <label for="">Your password </label>
                                                    <input type="password" class="form-control" name="" id="password" placeholder="" value="">
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group mb20">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div><!-- end row -->
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!---->
                </nav>
            </div>
        </div>
    </div>
</header>
