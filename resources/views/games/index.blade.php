@extends("layouts.master")
@section('game-product')

    <Script>
        var minbet = 30;
        var maxbet = 1000000;
        var playerhash = '{{ $uuid }}';
        var games = [];
        var bdval = '1190';
    </Script>

@endsection
@section("menu-account")
    @include('partials.account')
@endsection

@section("content")
    <script src="{{ asset('/js/libraries.js?v='.time()) }}" type="text/javascript"></script>
    <script src="{{ asset('/js/btcbomb.js?v='.time()) }}" type="text/javascript"></script>
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
                <div class="feed">

                </div>
                <p class="player_info" style="border-color:#280;">
                    <strong>NEVER</strong>
                    share your unique player URL with any other person.
                </p>
                <p class="player_info">If you have a balance of 0, you can bet any amount to start a practice game.</p>
            </div>
        </div>


@endsection