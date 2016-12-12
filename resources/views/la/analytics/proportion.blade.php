@extends("la.layouts.app")

@section("contentheader_title", "Tỷ lệ game")
@section("contentheader_description", "")
@section("section", "Tỷ lệ game")
@section("sub_section", "Listing")
@section("htmlheader_title", "Tỷ lệ game")

@section("main-content")

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

    <div class="box box-success">
        <!--<div class="box-header"></div>-->
        <div class="box-body">
            <form class="form-inline" method="post" action="{{ url(config('laraadmin.adminRoute') . '/analytics/proportion') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="sr-only">Player</label>
                    <input class="form-control" placeholder="Player" name="player" value="<?php echo (!empty($params["player"]))?$params["player"]:"" ?>" type="text">
                </div>
                <div class="form-group">
                    <label class="sr-only">Từ ngày</label>
                    <input class="form-control datepicker" placeholder="Từ ngày" name="start_date" value="<?php echo (!empty($params["start_date"]))?$params["start_date"]:"" ?>" type="text">
                </div>
                <div class="form-group">
                    <label class="sr-only">Đến ngày</label>
                    <input class="form-control datepicker" placeholder="Đến ngày" name="end_date" value="<?php echo (!empty($params["end_date"]))?$params["end_date"]:"" ?>" type="text">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>



    <div class="box box-success">
        <!--<div class="box-header"></div>-->
        <div class="box-body">


            <table class="table no-margin">
                <thead>
                <tr>
                    <th>Game</th>
                    <th>Player</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($allGame)){ ?>
                @foreach($allGame as $game)
                    <tr>
                        <td>{{ $game->game_hash }}</td>
                        <td>{{ $game->username }}</td>

                        <td><span class="label label-danger">{{ \App\Common\Utility::formatNumber($game->amounts) }}</span></td>
                        <td>{!! \App\Common\Utility::printTypePlayerAmount($game->type) !!} </td>
                        <td><?php
                            if($game->calc == 1){
                                echo '<label class="label label-primary">+</label>';
                            }
                            if($game->calc == 2){
                                echo '<label class="label label-danger">-</label>';
                            }
                            ?></td>
                        <td>{{ $game->created_at }}</td>

                    </tr>
                @endforeach
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                {{ $allGame->appends($params)->links() }}
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-sm-4 col-xs-6">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ \App\Common\Utility::formatNumber($win) }}</h5>
                            <span class="description-text">THẮNG</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-sm-4 col-xs-6">
                        <div class="description-block border-right">
                            <h5 class="description-header">{{ \App\Common\Utility::formatNumber($cashout) }}</h5>
                            <span class="description-text">CASHOUT</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-xs-6">
                        <div class="description-block">
                            <h5 class="description-header">{{ \App\Common\Utility::formatNumber($affiliate)  }}</h5>
                            <span class="description-text">AFFILIATES</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

