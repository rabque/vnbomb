@extends("layouts.master")
@section("content")
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
                            @if(!empty($slider->url))
                                <a href="{{  $slider->url }}" class="btn btn-sm btn-primary line-btn"> View more <i class="icon-arrow-right-circle icons"></i> </a>
                            @endif
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
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#d21a2f">Madness</span></td>
                        <td title="Ƀ5.909802">5,909,802</td>
                        <td title="Ƀ6.918006">6,918,006</td>
                        <td title="Ƀ1.008204">1,008,204</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#8a9658">Alta</span></td>
                        <td title="Ƀ11.577568">11,577,568</td>
                        <td title="Ƀ12.332805">12,332,805</td>
                        <td title="Ƀ0.755237">755,237</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#8f2537">Give me the fucking money </span></td>
                        <td title="Ƀ11.808649">11,808,649</td>
                        <td title="Ƀ12.276469">12,276,469</td>
                        <td title="Ƀ0.46782">467,820</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:black; background-color:#b4e36d">okirr</span></td>
                        <td title="Ƀ10.983242">10,983,242</td>
                        <td title="Ƀ11.400029">11,400,029</td>
                        <td title="Ƀ0.416787">416,787</td>
                    </tr>
                    <tr>
                        <td class="l_player"><span style="color:white; background-color:#1ccb84">bla</span></td>
                        <td title="Ƀ7.801906">7,801,906</td>
                        <td title="Ƀ8.104382">8,104,382</td>
                        <td title="Ƀ0.302476">302,476</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>


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
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div></div>
                        </td>
                        <td>Ernie</td>
                        <td title="Ƀ0.002224">2,224</td>
                        <td title="Ƀ0.424598" class="win">424,598</td>
                        <td>190.92x</td>
                        <td title="Ƀ0.305711" class="win_next">+305,711</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="g"></div><div class="g"></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div><div></div><div class="rr"></div><div class="g"></div><div></div><div class="rr"></div><div class="g"></div><div></div><div></div><div class="g"></div></div>
                        </td>
                        <td>Dudley</td>
                        <td title="Ƀ0.033">33,000</td>
                        <td title="Ƀ1.198733" class="win">1,198,733</td>
                        <td>36.33x</td>
                        <td title="Ƀ0.287696" class="win_next">+287,696</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div></div><div class="rr"></div><div></div><div></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div></div><div></div><div></div><div class="g"></div><div></div><div class="g"></div><div class="rr"></div></div>
                        </td>
                        <td>Dudley</td>
                        <td title="Ƀ0.025">25,000</td>
                        <td title="Ƀ0.908113" class="win">908,113</td>
                        <td>36.32x</td>
                        <td title="Ƀ0.217947" class="win_next">+217,947</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="g"></div><div></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div></div>
                        </td>
                        <td>Ernie</td>
                        <td title="Ƀ0.002224">2,224</td>
                        <td title="Ƀ0.125949" class="win">125,949</td>
                        <td>56.63x</td>
                        <td title="Ƀ0.060456" class="win_next">+60,456</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div></div><div></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="g"></div><div></div><div class="rr"></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div></div><div></div><div></div><div></div><div></div><div class="g"></div><div class="rr"></div></div>
                        </td>
                        <td>Dudley</td>
                        <td title="Ƀ0.14">140,000</td>
                        <td title="Ƀ1.560237" class="win">1,560,237</td>
                        <td>11.14x</td>
                        <td title="Ƀ0.299566" class="win_next">+299,566</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div></div>
                        </td>
                        <td>Sidney</td>
                        <td title="Ƀ0.01">10,000</td>
                        <td title="Ƀ0.2404" class="win">240,400</td>
                        <td>24.04x</td>
                        <td title="Ƀ0.030102" class="win_next">+30,102</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div class="rr"></div><div></div><div class="g"></div><div class="g"></div><div></div><div></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div></div><div></div><div></div></div>
                        </td>
                        <td>carenko</td>
                        <td title="Ƀ0.000039">39</td>
                        <td title="Ƀ0.001381" class="win">1,381</td>
                        <td>35.41x</td>
                        <td title="Ƀ0.000331" class="win_next">+331</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div></div>
                        </td>
                        <td>Lula</td>
                        <td title="Ƀ0.006746">6,746</td>
                        <td title="Ƀ0.162173" class="win">162,173</td>
                        <td>24.04x</td>
                        <td title="Ƀ0.020307" class="win_next">+20,307</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="g"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div><div class="rr"></div></div>
                        </td>
                        <td>Tillman</td>
                        <td title="Ƀ0.004903">4,903</td>
                        <td title="Ƀ0.117868" class="win">117,868</td>
                        <td>24.04x</td>
                        <td title="Ƀ0.014759" class="win_next">+14,759</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="minigame"><div class="g"></div><div class="g"></div><div></div><div></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div class="g"></div><div class="g"></div><div class="rr"></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div></div><div class="g"></div><div class="g"></div></div>
                        </td>
                        <td>Byron</td>
                        <td title="Ƀ0.004">4,000</td>
                        <td title="Ƀ0.097172" class="win">97,172</td>
                        <td>24.29x</td>
                        <td title="Ƀ0.034982" class="win_next">+34,982</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</section>



@endsection