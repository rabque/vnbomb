@extends("layouts.master")
@section('game-product')

    <Script>
        var minbet = 30;
        var maxbet = 1000000;
        var playerhash = '6a6a18f8fcd9e8a3e456563ee1949d12c186b05f';
        var games = [];
        var bdval = '1190';
    </Script>

@endsection

@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row">
                <div style="margin: 0 auto;width: 70%">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="balance">
                        <div class="top_row">
                            <div class="center_block">
                                <Center>
                                <span class="headerbalance">Balance</span>
                                <span class="val"><span class="num" title="Ƀ0.000000">0</span></span>
                                </Center>
                            </div>
                        </div>
                        <div class="bottom_row">
                            <div class="center_block">
                                <Center>
                                <button class="dw" id="deposit_withdraw">Deposit / Withdraw</button>
                                </Center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="presets">
                        <ul class="bets">
                            <li class="cell"><button class="button_zero">0</button></li>
                            <li class="cell"><button>MIN</button></li>
                            <li class="cell"><button>MAX</button></li>
                            <li class="cell"><button class="button_plus">+100</button></li>
                            <li class="cell"><button class="button_plus">+1000</button></li>
                            <li class="cell"><button class="button_multiply">x2</button></li>
                            <li class="cell"><button class="button_minus">-100</button></li>
                            <li class="cell"><button class="button_minus">-1000</button></li>

                            <li class="cell">{{--<button class="button_edit">EDIT</button>--}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4">
                    <div class="starter">
                        <div class="top_row">
                            <div class="c60 cell">
                                <input class="bet" id="bet" type="number" pattern="[0-9]*" pattern="[$" placeholder="Bet" value="">
                            </div>
                            <div class="c40 cell">
                                <button id="start_game" class="btn btn-danger">Play</button>
                            </div>
                        </div>
                        <div class="bottom_row mine_options">
                            <div class="quarter cell">
                                <button class="btn  btn-success"><span><i class="glyphicon glyphicon-certificate" style="color:red"></i></span>1</button>
                            </div>
                            <div class="quarter cell">
                                <button class="btn  btn-success active"><span><i class="glyphicon glyphicon-certificate" style="color:red"></i></span>3</button>
                            </div>
                            <div class="quarter cell">
                                <button class="btn  btn-success"><span><i class="glyphicon glyphicon-certificate" style="color:red"></i></span>5</button>
                            </div>
                            <div class="quarter cell">
                                <button class="btn  btn-success"><span><i class="glyphicon glyphicon-certificate" style="color:red"></i></span>24</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="load_game">
                <script src="{{ asset('/js/BetMineBuild/TemplateData/UnityProgress.js') }}" type="text/javascript"></script>
                <div class="block_game">
                    <div class="row">

                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                            <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="360px" width="420px"></canvas>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <div class="cash_view">
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <p class="standing_label">Next:</p>
                                    <p class="stand_next">1</p>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <p class="standing_label">STAKE:</p>
                                    <p class="stand_next"><span>0</span></p>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <div class="game_messages">
                                <!-- <p class="alert alert-danger" style="">You cannot make any more guesses. This game is already over</p>
                                <p style=""><label>Share this game: </label><input value="https://satoshimines.com/s/125050039/lsqNnXuZ4VkB/" type="text"></p>
                                <p style=""><label>Secret: </label> 25-9-22-lsqNnXuZ4VkB</p>
                                <!-- <p class="bomb" style="">Game over! You hit a mine on tile 9 and lost 1,130,909 bits.</p>
                                <p class="find" style="">You found <span>130,909 bits</span> in tile 10</p>
                                <p class="first" style="">A 3-mine game for 1,000,000 bits has started. Secret hash: <span class="secret_hash">af194d810bb44e950a8fb013542ad4b281a0d9e35dd362f51aa2cb100f1b9884</span></p>
                                 -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <script type='text/javascript'>
                    var Module = {
                        TOTAL_MEMORY: 268435456,
                        errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
                        compatibilitycheck: null,
                        dataUrl: "{{ asset('/js/BetMineBuild/Release/BetMineBuild.data')  }}",
                        codeUrl: "{{ asset('/js/BetMineBuild/Release/BetMineBuild.js')  }}",
                        memUrl:"{{ asset('/js/BetMineBuild/Release/BetMineBuild.mem')  }}"

                    };


                    InitMathStats = function (betAmount, numberOfMine)
                    {
                        // Khi nguoi choi lua chon so luong dat coc va so luong min thi goi ham nay
                        SendMessage ('jsHandler', 'InitStats', betAmount, numberOfMine);
                    }

                    RevealAllMinePosition = function(minePositionStrings)
                    {
                        // string vidu: "(1x3),(4x4),(2x4)"
                        console.log(minePositionStrings);
                        SendMessage ('jsHandler', 'RevealAllMinePosition', minePositionStrings);
                    }

                    CellClicked = function (x, y)
                    {
                        // This is and example of how to send message to the game

                        var e = parseFloat(parseInt($("#bet").val().replace(/[^0-9]+/g, ""))),
                                t = $(".mine_options button.active").text().replace(/[^0-9]+/g, "");

                        var randomValue = 0.6*Math.random();
                        var request = $.ajax({
                            url: "{{ url("api/match")  }}",
                            type: 'POST',
                            method: "POST",
                            data: {
                                uuid : '{{ $uuid  }}',
                                username : $("#username").val(),
                                password : $("#password").val(),
                                clickMatch : {x:x,y:y},
                                betAmount : e,
                                numberOfMine : t,
                                token : $('meta[name="_token"]').attr('content')
                            },
                            dataType: "JSON"
                        });

                        request.done(function( data ) {
                            var point = 0;
                            var lastClick = "";
                            var mathClick = data.click;
                            $(mathClick).each(function( index,val ) {
                                        point = parseInt(point + val.point)
                                        lastClick = val.position
                            });
                            point = parseInt(point + data.betAmount);
                            $("#bet").val(data.betAmount)
                            if(data.success == true){
                                html = '<div class="alert alert-success" role="alert"> You found '+point+' bits (clicked cell (' + lastClick +  '))</div>';
                            }else{
                                html = '<div class="alert alert-danger" role="alert"> Game over! You hit a mine lost '+point+' bits. (clicked cell (' + lastClick + '))</div>';
                            }

                            $(".stand_next span").html(point);
                            if(data.minePositions){
                                var dataMine = data.minePositions;
                                if(dataMine != ""){
                                    RevealAllMinePosition(dataMine);
                                }
                            }


                            $( ".game_messages" ).prepend(html );
                        });

                        request.fail(function( jqXHR, textStatus ) {
                            html = '<div class="alert alert-danger" role="alert">' + textStatus +  ')</div>';
                            $( ".game_messages" ).prepend(html );
                        });

                        SendClickResult(Math.round(randomValue));

                        //
                    }

                    SendClickResult = function(result)
                    {
                        // clicked on mine, result = 1. clicked on normal cell, result = 0
                        SendMessage ('jsHandler', 'ClickResultListener', result);
                    }


                </script>
                <script src="{{ asset('/js/BetMineBuild/Release/UnityLoader.js') }}" type="text/javascript"></script>
                <script src="{{ asset('/template/ethersmine/js/game.js') }}" type="text/javascript"></script>
            </div>
        </div>


@endsection