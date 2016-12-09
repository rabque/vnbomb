@extends("la.layouts.app")

@section("contentheader_title", "Dashboard")
@section("contentheader_description", "Dashboard")
@section("section", "Dashboard")
@section("sub_section", "Dashboard")
@section("htmlheader_title", "Dashboard")

@section("headerElems")
    Dashboard
@endsection

@section("main-content")

    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-game-controller-b"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tổng trân đấu </span>
                        <span class="info-box-number">{{ $count_match }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-retweet" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Affiliate</span>
                        <span class="info-box-number">{{ $count_affiliate }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Người chơi</span>
                        <span class="info-box-number">{{ $count_players }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tỷ lệ game </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <?php
                                $win = $lose = $cashout = $affiliate = 0;
                                if(!empty($allGame)){
                                    foreach($allGame as $data){
                                        $bet = ($data->type == 2)?$data->amounts:0;
                                        if($data->type == 3){
                                            if($data->amounts > $bet){
                                                $win = $win + $data->amounts;
                                            }else{
                                                $lose = $lose + $data->amounts;
                                            }
                                        }

                                        if($data->type == 5){
                                            $affiliate = $affiliate + $data->amounts;
                                        }
                                        if($data->type == 4){
                                            $cashout = $cashout + $data->amounts;
                                        }

                                    }
                                }

                            ?>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i></span>
                                    <h5 class="description-header">{{ \App\Common\Utility::formatNumber($win) }}</h5>
                                    <span class="description-text">THẮNG</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->

                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-green"><i class="fa fa-caret-left"></i></span>
                                    <h5 class="description-header">{{ \App\Common\Utility::formatNumber($cashout) }}</h5>
                                    <span class="description-text">CASHOUT</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <span class="description-percentage text-red"><i class="fa fa-caret-left"></i></span>
                                    <h5 class="description-header">{{ \App\Common\Utility::formatNumber($affiliate)  }}</h5>
                                    <span class="description-text">AFFILIATES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->

                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-warning ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Người chơi thắng nhiều nhất </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Amount</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($topPlayer)){ ?>
                                @foreach($topPlayer as $player)
                                <tr>
                                    <td>{{ $player->username }}</td>
                                    <td>{{ \App\Common\Utility::formatNumber($player->total_amount) }}</td>
                                    <td><span class="label label-success">{{ $player->total_win }}</span></td>

                                </tr>
                                @endforeach
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- ./box-body -->

                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->


            <div class="col-md-6">
                <div class="box  box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ván thắng nhiều nhất </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>Hash</th>
                            <th>Bet</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($topWinMatch)){ ?>
                        @foreach($topWinMatch as $match)
                            <tr>
                                <td>{{ $match->game_hash }}</td>
                                <td>{{ \App\Common\Utility::formatNumber($match->bet) }}</td>
                                <td>{{ \App\Common\Utility::formatNumber($match->stake) }}</td>

                            </tr>
                        @endforeach
                        <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    <!-- ./box-body -->

                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>

        <!-- /.row -->

@endsection
