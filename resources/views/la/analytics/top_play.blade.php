@extends("la.layouts.app")

@section("contentheader_title", "Người chơi thắng nhiều nhất")
@section("contentheader_description", "")
@section("section", "Người chơi thắng nhiều nhất")
@section("sub_section", "Listing")
@section("htmlheader_title", "Người chơi thắng nhiều nhất")

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

    <div class="box box-success">
        <!--<div class="box-header"></div>-->
        <div class="box-body">
            <form class="form-inline" method="post" action="{{ url(config('laraadmin.adminRoute') . '/analytics/top_play') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Từ ngày</label>
                    <input class="form-control datepicker" placeholder="Từ ngày" name="start_date" value="<?php echo (!empty($params["start_date"]))?$params["start_date"]:"" ?>" type="text">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Đến ngày</label>
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
        <div class="box-footer">
            {{ $topPlayer->appends($params)->links() }}
        </div>
    </div>


@endsection

