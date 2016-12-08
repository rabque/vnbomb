@extends("layouts.master")
@section("content")
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
<script src="{{ asset('/js/app.js?t='.time()) }}"></script>
@if(!empty($sliders))
    @foreach($sliders as $slider)
        <section id="top" style="background: url('{{ $slider->image  }}'); background-size: cover">

            <div class="shader"></div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-7  page-title white-color">
                        <h1>{{  $slider->name  }}</h1>
                        <div class="small-text">{{  $slider->small_text }}</div>
                        <div class="btn-wrap pad-top-large">

                    </div>
                        </div>
                    <div class="col-sm-6 col-md-5 hidden-xs phone-holder">
                        <div class="secondary-phone"><img src="{{ asset('img/preview.gif') }}" alt=""  ></div>
                    </div>
                </div>
            </div>

        </section>
    @endforeach
@endif

@include('partials.live')

<section class="pad-large while-alt-bg  text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">@lang("website.feature")</h3>
            <p class="pad-sides-15 grey-med margin-bottom-large">@lang("website.text_feature")</p>
        </div>
        <div class="row text-center">
            @if(!empty($notes))
                @foreach($notes as $note)
            <div class="col-sm-6 col-md-4">
                <div class="panel-box">
                    <div class="vertical-align">
                        <h5>{{ $note->name }}</h5>
                        <p class="grey-med">{{ $note->content }}</p>
                    </div>
                </div>
            </div>
                @endforeach
            @endif
        </div>

    </div>
</section>

@if(!empty($topToday))
<section class="pad-large  grey-dark-alt-bg text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">@lang("website.top_player")</h3>
        </div>
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
                <table class="player_scores table table-hover">
                    <thead>
                    <tr>
                        <th>@lang("website.h_player_list")</th>
                        <th>@lang("website.h_amount_bet")</th>
                        <th>@lang("website.h_amount_won")</th>
                        <th>@lang("website.h_total_win")</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topToday as $item)
                    <tr>
                        <td class="l_player"><span class="label label-{{ $item["label"] }}">{{ $item["name"]  }}</span></td>
                        <td title="Ƀ5.909802">{{ $item["amount_bet"]  }}</td>
                        <td title="Ƀ6.918006">{{ $item["amount_won"]  }}</td>
                        <td title="Ƀ1.008204">{{ $item["total_win"]  }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>
@endif
@if(!empty($topWeek))
<section class="pad-large  while-alt-bg text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">@lang("website.top_player_week")</h3>
        </div>
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
                <table class="game_scores  table table-hover">
                    <thead>
                    <tr>
                        <th>@lang("website.top_week_board")</th>
                        <th>@lang("website.top_week_player")</th>
                        <th>@lang("website.top_week_bet")</th>
                        <th>@lang("website.top_week_cashout")</th>
                        <th>@lang("website.top_week_winx")</th>
                        <th>@lang("website.top_week_next_title")</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topWeek as $item)
                    <tr>
                        <td>
                           <?php echo $item["match_click"] ?>
                        </td>
                        <td>{{ $item["name"]  }}</td>
                        <td title="Ƀ0.002224">{{ $item["bet"]  }}</td>
                        <td title="Ƀ0.424598" class="win">{{ $item["stake"]  }}</td>
                        <td>{{ $item["winx"]  }}</td>
                        <td title="Ƀ0.305711" class="win_next">+{{ $item["next"]  }}</td>
                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>
@endif


@endsection
