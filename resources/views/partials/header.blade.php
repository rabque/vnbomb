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
                <nav class="navigation">
                    <ul class="anchor-nav black-dark-bg">
                        @if(!empty($menuTop))
                            @foreach($menuTop as $menu)
                                <li>
                                    <a href=" {{ $menu->url.\Config::get("constants.PREFIX_URL")  }}">
                                        {{ $menu->name  }}
                                    </a>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                    <!---->
                </nav>
            </div>
        </div>
    </div>
</header>
