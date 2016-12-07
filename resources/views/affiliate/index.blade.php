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
                    <form class="form-inline affiliate">
                        <div class="form-group">
                            <input type="text" class="form-control" id="address" name="address" placeholder="@lang("website.payment_address")">
                        </div>
                        <div class="form-group">
                        <button type="submit" style="margin-bottom: 0px"  class="btn btn-primary">@lang("website.get_url")</button>
                        </div>
                        <Div class="clearfix"></Div>

                        <div class="form-group">
                            <div id="affiliate_result" class="response"></div>


                            <div class="premade_affiliate_images">
                                <h2>Premade images for your website or forum signature.</h2>
                                <div class="premade img_large_rectangle">
                                    <img src="{{ asset("/img/large-rectangle.png") }}" alt="">
                                    <p class="premade_label">Large Rectangle</p>
                                    <p class="premade_size">336x280</p>
                                    <textarea><a href="{{ url("/") }}"><img src="{{ url("/") }}img/large-rectangle.png" alt="Satoshi Mines"></a></textarea>
                                </div>
                                <div class="premade img_medium_rectangle">
                                    <img src="{{ asset("/img/medium-rectangle.png") }}" alt="">
                                    <p class="premade_label">Medium Rectangle</p>
                                    <p class="premade_size">300x250</p>
                                    <textarea><a href="{{ url("/") }}"><img src="{{ url("/") }}img/medium-rectangle.png" alt="Satoshi Mines"></a></textarea>
                                </div>
                                <div class="premade img_leaderboard">
                                    <img src="{{ asset("/img/leaderboard.png") }}" alt="">
                                    <p class="premade_label">Leaderboard / Signature</p>
                                    <p class="premade_size">728x90</p>
                                    <textarea><a href="{{ url("/") }}"><img src="{{ url("/") }}img/leaderboard.png" alt="Satoshi Mines"></a></textarea>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>
    <Script>


        $('form button').removeAttr('disabled');
        $('form.affiliate').submit(function(e){
            e.preventDefault();
            $.ajax({
                method: "POST",
                dateType: "JSON",
                data: {address: $("#address").val()},
                url: BASE_URL + "/api/action/newaffiliate"
            }).done(function(xhr){
                if (xhr.status == 'success'){
                    $('.error').remove();
                    $('.response').append('<div class="yourlink">Your affiliate link: <a href="'+ BASE_URL +'/game/'+xhr.code+'">'+ BASE_URL +'/game/'+xhr.code+'</a></div>');
                   /* $('.response').append('<div class="yourlink">Monitor Your Stats: <a href="'+ BASE_URL +'/game/'+xhr.code+'/'+xhr.secret+'">'+ BASE_URL +'/game/'+xhr.code+'/'+xhr.secret+'</a></div>');*/
                    $('.response').append('<p>You will be paid 10% of the profit that Satoshi Mines makes from players who play through this URL.</p>');
                    $('form.affiliate button').attr('disabled', 'disabled');

                    $('.img_large_rectangle textarea').html('<a href="'+ BASE_URL +'/game/'+xhr.code+'"><img src="'+ BASE_URL +'/img/large-rectangle.png" alt="Satoshi Mines"></a>');
                    $('.img_medium_rectangle textarea').html('<a href="'+ BASE_URL +'/game/'+xhr.code+'"><img src="'+ BASE_URL +'/img/medium-rectangle.png" alt="Satoshi Mines"></a>');
                    $('.img_leaderboard textarea').html('<a href="'+ BASE_URL +'/game/'+xhr.code+'"><img src="'+ BASE_URL +'/img/leaderboard.png" alt="Satoshi Mines"></a>');
                    setTimeout(function(){
                        $('.premade_affiliate_images').fadeIn(1000);
                    }, 2000);

                } else {
                    if (xhr.status == 'error'){
                        $('.response').append('<div class="error">'+xhr.message+'</div>');
                    } else {
                        $('.response').append('<div class="error">Unknown error</div>');
                    }
                }
            });
        });
    </Script>
@endsection