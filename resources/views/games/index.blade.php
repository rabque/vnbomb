@extends("layouts.master")
@section('game-product')
    TemplateData
    <script src="{{ asset('/js/BetMineBuild/TemplateData/UnityProgress.js') }}" type="text/javascript"></script>

@endsection

@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row text-center">
                <h1 class="light-weight">Games</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        User
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                <form action="" method="post" class="form-inline" role="form">
                                    <div class="form-group mb20">
                                        <p>To access your account you may return to your unique URL at any time. Do not share your player URL as this will compromise your account. You may also protect your URL by locking it with a password.</p>
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
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Point
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse  in" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                <div id="point">

                                </div>
                                    </div>
                            </div>
                        </div>

                    </div>




                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <center>
                        <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="500px" width="500px"></canvas>
                    </center>
                    </div>
            </div>
        </div>
    </section>
    <script type='text/javascript'>
        var Module = {
            TOTAL_MEMORY: 268435456,
            errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
            compatibilitycheck: null,
            dataUrl: "{{ asset('/js/BetMineBuild/Release/BetMineBuild.data')  }}",
            codeUrl: "{{ asset('/js/BetMineBuild/Release/BetMineBuild.js')  }}",
            memUrl:"{{ asset('/js/BetMineBuild/Release/BetMineBuild.mem')  }}"

        };

        CellClicked = function (x, y) {

            // This is and example of how to send message to the game
            var randomValue = 0.6*Math.random();
            //window.alert("clicked cell " + x + "x" + y + ", result: " + randomValue);
            var request = $.ajax({
                url: "{{ url("api/match")  }}",
                type: 'POST',
                method: "POST",
                data: {
                    uuid : '{{ $uuid  }}',
                    username : $("#username").val(),
                    password : $("#password").val(),
                    clickMatch : {x:x,y:y,result:randomValue}
                },
                dataType: "JSON"
            });

            request.done(function( data ) {
                html = '<div class="alert alert-success" role="alert">(clicked cell ' + data.x + 'x' + data.y + ', result: ' + data.result+ ')</div>';
                $( "#point" ).append(html );
            });

            request.fail(function( jqXHR, textStatus ) {
                html = '<div class="alert alert-error" role="alert">' + textStatus +  ')</div>';
                $( "#point" ).append(html );
            });
            SendClickResult(Math.round(randomValue));
        }

        SendClickResult = function(result)
        {
            // clicked on mine, result = 1. clicked on normal cell, result = 0
            SendMessage ('jsHandler', 'ClickResultListener', result);
        }

    </script>
    <script src="{{ asset('/js/BetMineBuild/Release/UnityLoader.js') }}" type="text/javascript"></script>


@endsection