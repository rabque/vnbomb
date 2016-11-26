<li class="dropdown megamenu-fw">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang("website.your_account")</a>
    <ul class="dropdown-menu megamenu-content" role="menu">
        <li>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="" id="account" method="post" class="form-inline" role="form">
                        <div class="form-group mb20">
                            <p>@lang("website.text_account")</p>
                            <hr>
                        </div>
                        <div id="account_msg"></div>
                        <div class="form-group mb20">
                            <label for="">@lang("website.username") </label>
                            <input type="text" class="form-control" name="" id="username" placeholder="{{ $player->username }}" value="{{ $player->username }}">
                        </div>

                        <div class="clearfix"></div>
                        <?php $isUpdate =0 ?>
                        @if(!empty($player->password))
                            <div class="form-group mb20">
                                <label for="">@lang("website.current_password") </label>
                                <input type="password" class="form-control" name="" id="current_password" placeholder="" value="">
                            </div>
                            <?php $isUpdate =1 ?>
                            <div class="clearfix"></div>
                        @endif
                        <div class="form-group mb20">
                            <label for="">@lang("website.password") </label>
                            <input type="password" class="form-control" name="" id="password" placeholder="" value="">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group mb20">
                            <button type="button" class="btn btn-primary" onclick="account(<?php echo $isUpdate ?>)">@lang("website.submit")</button>
                        </div>

                    </form>
                </div>
            </div><!-- end row -->
        </li>
    </ul>
</li>