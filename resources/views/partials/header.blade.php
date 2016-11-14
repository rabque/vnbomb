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
                        @section("menu-account")
                        @show
                    </ul>

                    <!---->
                </nav>
            </div>
        </div>
    </div>
</header>
