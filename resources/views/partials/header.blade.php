<!-- End: Preloader section
========================== -->
<header id="header" class="white-alt-bg header">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="logo"> <a href="/"> <img src="{{ url($configs->logo) }}" alt=""></a> </div>
                <button class="menu visible-xs" id="menu"></button>
            </div>
            <div class="col-sm-10">
                <nav class="navigation nav navbar bootsnav">
                    <ul class="anchor-nav black-dark-bg" data-in="fadeInDown" data-out="fadeOutUp">
                        <li>
                            <a href="{{ url("/games?uuid=".$uuid)  }}">@lang("website.start_game")</a>
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

                        <?php $lang = config('app.locales');
                            if(!empty($lang) && count($lang) > 1){
                                ?>
                        <li>
                            <?php  foreach($lang as $k=>$v){ ?>
                           <a class="langicon" href="{{ url($k)  }}"><img src="{{ asset("/img/lang_$k.png") }}"> </a>
                        <?php } ?>
                        </li>
                                <?php
                            }
                        ?>

                    </ul>

                    <!---->
                </nav>
            </div>
        </div>
    </div>
</header>
