<div class="section-first  grey-dark-alt-bg text-center  text-center foot-content">
    <div class="container">
        <ul class="social-links footer-social-link">
            @if(!empty($menuFooter))
                @foreach($menuFooter as $menu)
                    <li>
                        <a href=" {{ $menu->url.\Config::get("constants.PREFIX_URL")  }}">
                            {{ $menu->name  }}
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="block-content">
                    {{ $configs->footer  }}
                </div>
            </div>

        </div>
        <span class="copy-right dis-blk">© Copyright {{ date("Y") }} {{ $configs->name  }} <span></span></span>
        <ul class="social-links">
            @if(!empty($socials))
                @foreach($socials as $social)
                    <li> <a class="icon-social-{{ $social->icon  }}" href="{{ $social->url  }}"></a> </li>
                @endforeach
            @endif

        </ul>
    </div>
</div>