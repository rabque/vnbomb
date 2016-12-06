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
    <div class="shadow"></div>
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
                                <span class="headerbalance">@lang("website.balance")</span>
                                <span class="val"><span class="num" title="Ƀ0.000000">{!! \App\Common\Utility::formatNumber($player->amount)  !!}</span></span>
                                </Center>
                            </div>
                        </div>
                        <div class="bottom_row">
                            <div class="center_block">
                                <Center>
                                <button class="dw" id="deposit_withdraw">@lang("website.withdraw")</button>
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
                                <input class="bet" id="bet" type="number" pattern="[0-9]*" pattern="[$" placeholder="@lang("website.bet")" value="">
                            </div>
                            <div class="c40 cell">
                                <button id="start_game" class="btn btn-danger">@lang("website.play")</button>
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
                    @lang("website.text_player_info1")

                </p>
                <p class="player_info">@lang("website.text_player_info2")</p>
            </div>
        </div>
        <div class="modal">
            <div class="io_menu">
                <ul>
                    <li class="selected" id="io_in">Deposit</li>
                    <li id="io_out">Withdraw</li>
                </ul>
            </div>
            <div class="io_in io">
                <p class="deposit_to">Deposit bitcoins to:</p>
                <p class="btcaddr"></p>
                <div class="addr_details">
                </div>
                <button class="line_btn line_btn_red close_all">Cancel</button>
                <button class="line_btn line_btn_green refresh_bal">I deposited</button>
            </div>
            <div class="io_out io">
                <p>You have <strong class="out_bits">0</strong> bits. That's exactly <strong>Ƀ<span class="out_bitcoins">0.</span></strong></p>
                <form class="withdraw_form" action="/action/full_cashout.php" method="POST">
                    <label>
                        <span>Amount: </span>
                        <input type="text" value="0" size="12" class="amount">
                    </label>
                    <label>
                        <span>To: </span>
                        <input type="text" value="" class="payto_address" placeholder="Bitcoin Address" size="35">
                    </label>
                </form>
                <button class="line_btn line_btn_red close_all" style="margin-top:0em;">Cancel</button>
                <button class="line_btn line_btn_green withdraw" style="margin-top:0em;">Withdraw</button>
                <div class="withdraw_messages"></div>
            </div>
            <div class="modal_load">
                <div class="icon"></div>
                <div class="content"></div>
            </div>
        </div>

@endsection