@extends("layouts.master")
@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row text-center">
                <h1 class="light-weight">@lang("website.affiliate_title")</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @lang("website.text_affiliate")
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputName2" placeholder="@lang("website.payment_address")">
                        </div>
                        <div class="form-group">
                        <button type="submit" style="margin-bottom: 0px" class="btn btn-primary">@lang("website.get_url")</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection