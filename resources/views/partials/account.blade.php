<li class="dropdown megamenu-fw">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang("website.your_account")</a>
    <ul class="dropdown-menu megamenu-content" role="menu">
        <li>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="" method="post" class="form-inline" role="form">
                        <div class="form-group mb20">
                            <p>@lang("website.text_account")</p>
                            <hr>
                        </div>

                        <div class="form-group mb20">
                            <label for="">@lang("website.username") </label>
                            <input type="text" class="form-control" name="" id="username" placeholder="{{ $uuid_name }}" value="{{ $uuid_name }}">
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group mb20">
                            <label for="">@lang("website.password") </label>
                            <input type="password" class="form-control" name="" id="password" placeholder="" value="">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group mb20">
                            <button type="submit" class="btn btn-primary">@lang("website.submit")</button>
                        </div>

                    </form>
                </div>
            </div><!-- end row -->
        </li>
    </ul>
</li>