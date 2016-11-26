@extends("layouts.master")
@section("content")
    <div class="shadow"></div>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script src="{{ asset('/js/app.js?t='.time()) }}"></script>
    <section class="pad-large while-alt-bg">
        <div class="container">
            <div class="row">
                <div class="game_review">

                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="board_container1">
                            <div class="board_container2">
                                <ul class="board">
                                    <?php foreach(range(1,25) as $item){
                                            $normal = true;
                                            if(isset($dataMatch[$item])){
                                                if($dataMatch[$item] ==true){
                                                    echo '<li class="tile pressed"><i class="icon-check"></i></li>';
                                                }else{
                                                    echo '<li class="tile pressed bomb reveal"><i class="glyphicon glyphicon-certificate"></i></li>';
                                                }
                                            }else{
                                                echo '<li class="tile"></li>';
                                            }
                                    ?>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="game_info">
                            <h2>Game #{{ $match->id }}</h2>
                            <p class="player_name">
                                <span class="label">Player:</span>
                                <span class="val">{{ $match->players->username }}</span>
                            </p>
                            <div class="stat_row">
                                <span class="stat"><span class="label">Mines:</span> <span class="val">{{ $match->num_mines  }}</span></span>
                                <span class="stat"><span class="label">Guesses:</span> <span class="val">{{ count($match->matchClick)  }}</span></span>
                                <span class="stat"><span class="label">Bet:</span> <span title="Ƀ0.00003" class="val"><?php echo \App\Common\Utility::formatNumber($match->bet) ?></span></span>
                                <span class="stat"><span class="label">Lost::</span> <span title="Ƀ0.000161" class="val"><?php
                                        $lost = $match->stake - $match->bet;
                                     echo   \App\Common\Utility::formatNumber($lost)  ?></span></span>
                            </div>
                            <div class="stat_row">
                                <span class="stat">
                                    <span class="label">Game Type:</span>
                                    <span class="val">{{ $match->gametype  }}</span>
                                </span>
                                <span class="stat">
                                    <span class="label">Finished:</span>
                                    <span class="val">
                                        {{ $match->updated_at->format("M d, Y"). " at ".$match->updated_at->format("H:i")  }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @include('partials.live')
@endsection