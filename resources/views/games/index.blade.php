@extends("layouts.master")
@section("content")
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row text-center">
                <h1 class="light-weight">Games</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="sticky-wrapper" style="height: 112px;"><div class="cp">
                            <div class="balance">
                                <div class="top_row">
                                    <div class="c100 cell">
                                        <span class="headed">Balance</span>
                                        <span class="val"><span class="num" title="Ƀ0.000000">0</span></span>
                                    </div>
                                </div>
                                <div class="bottom_row">
                                    <div class="c100 cell">
                                        <button class="dw" id="deposit_withdraw">Deposit / Withdraw</button>
                                    </div>
                                </div>
                            </div>
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
                                    <!--
                                                    <li class="cell"><button class="button_zero">0</button></li>
                                                    <li class="cell"><button>MIN</button></li>
                                                    <li class="cell"><button>MAX</button></li>
                                                    <li class="cell"><button class="button_plus">+100</button></li>
                                                    <li class="cell"><button class="button_plus">+1000</button></li>
                                                    <li class="cell"><button class="button_x">x2</button></li>
                                                    <li class="cell"><button class="button_minus">-100</button></li>
                                                    <li class="cell"><button class="button_minus">-1000</button></li>
                                    -->
                                    <li class="cell"><button class="button_edit">EDIT</button></li>
                                </ul>
                            </div>
                            <div class="starter">
                                <div class="top_row">
                                    <div class="c60 cell">
                                        <input class="bet" id="bet" pattern="[0-9]*" placeholder="Bet" class="form-control" type="number">
                                    </div>
                                    <div class="c40 cell">
                                        <button id="start_game">Play</button>
                                    </div>
                                </div>
                                <div class="bottom_row mine_options">
                                    <div class="quarter cell">
                                        <button><span><i class="icon-alert"></i></span>1</button>
                                    </div>
                                    <div class="quarter cell">
                                        <button class="active"><span><i class="icon-alert"></i></span>3</button>
                                    </div>
                                    <div class="quarter cell">
                                        <button><span><i class="icon-alert"></i></span>5</button>
                                    </div>
                                    <div class="quarter cell">
                                        <button><span><i class="icon-alert"></i></span>24</button>
                                    </div>
                                </div>
                            </div>
                        </div></div>
                    <div class="feed">
                        <p class="player_info" style="border-color:#280;"><strong>NEVER</strong> share your unique player URL with any other person.</p>
                        <p class="player_info">If you have a balance of 0, you can bet any amount to start a practice game.</p>
                    </div>

                </div>
            </div>

        </div>
    </section>



@endsection