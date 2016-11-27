@extends("layouts.master")

@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row">

                <div class="big_err">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="hugemine"><i class="icon-lock"></i></div>
                        <h2>@lang("website.protect_player")</h2>
                        <p>@lang("website.enter_password")</p>
                        <form action="{{ url("/games/login") }}" class="form-inline" method="POST">
                            @if(!empty($error))
                                <div class="form-group">
                                <div class="alert alert-danger">{{$error}}</div>

                                </div>
                                <div class="clearfix"></div>
                            @endif
                            <div class="form-group">
                            {{ csrf_field() }}
                            <input type="hidden" name="secret" value="{{ $uuid }}">
                            <input class="form-control" name="password" placeholder="@lang('website.password')" type="password">
                            <button type="submit" class="btn btn-primary">@lang("website.Login")</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection