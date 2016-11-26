<section class="pad-large grey-dark-alt-bg  text-center" id="feature">
    <div class="container">
        <div class="row">
            <h3 class="light-weight">@lang("website.live_game")</h3>
        </div>
        <div class="row text-center">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
                <table  class="live_scores table table-hover">
                    <thead>
                    <tr>
                        <th class="s_board">@lang("website.top_week_board")</th>
                        <th class="s_player">@lang("website.top_week_player")</th>
                        <th class="s_bet">@lang("website.top_week_bet")</th>
                        <th class="s_win">@lang("website.top_week_win")</th>
                        <th class="s_profit">@lang("website.top_profit")</th>
                        <th class="s_hash">@lang("website.top_hash")</th>
                        <th class="s_secret">@lang("website.top_secret")</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<script>
    $(document).ready(function () {
        live();
    });

    function live(){
        $.ajax({
                    method: "POST",
                    dateType: "JSON",
                    url: BASE_URL + "/api/game/live"
                })
                .done(function( msg ) {
                    var html = "";
                    $.each(msg, function(i, item) {
                        html += '<tr>';
                        html += ' <td class="s_board">'+ item.match_click +'</td>';
                        html += ' <td class="s_player"><span class="label label-'+item.label+'"> '+ item.name +'</span></td>';
                        html += ' <td class="s_bet">'+ item.bet +'</td>';
                        html += ' <td class="s_win">'+ item.win +'</td>';
                        html += ' <td class="s_profit">+'+ item.profit +'</td>';
                        html += ' <td class="s_hash"><input type="text" value="'+ item.hash +'"></td>';
                        html += ' <td class="s_secret"><input type="text" value="'+ item.secret +'"></td>';
                        html += "</tr>";
                    });
                    $(".live_scores tbody").append(html);
                })
                .fail(function( jqXHR, textStatus, errorThrown ) {

                });
    }
</script>