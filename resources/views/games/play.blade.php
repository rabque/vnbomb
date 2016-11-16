<script src="{{ asset('/js/BetMineBuild/TemplateData/UnityProgress.js') }}" type="text/javascript"></script>
<div class="block_game">
    <div class="row">

        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="360px" width="420px"></canvas>
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <div class="cash_view">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <p class="standing_label">Next:</p>
                    <p class="stand_next">000</p>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <p class="standing_label">STAKE:</p>
                    <p class="stand_next">000 {{$numberOfMine}}</p>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="game_messages">
                <!-- <p class="alert alert-danger" style="">You cannot make any more guesses. This game is already over</p> -->
                <p style=""><label>Share this game: </label><input value="https://satoshimines.com/s/125050039/lsqNnXuZ4VkB/" type="text"></p>
                <p style=""><label>Secret: </label> 25-9-22-lsqNnXuZ4VkB</p>
                <!-- <p class="bomb" style="">Game over! You hit a mine on tile 9 and lost 1,130,909 bits.</p>
                <p class="find" style="">You found <span>130,909 bits</span> in tile 10</p>
                <p class="first" style="">A 3-mine game for 1,000,000 bits has started. Secret hash: <span class="secret_hash">af194d810bb44e950a8fb013542ad4b281a0d9e35dd362f51aa2cb100f1b9884</span></p>
                 -->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script type='text/javascript'>
    var Module = {
        TOTAL_MEMORY: 268435456,
        errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
        compatibilitycheck: null,
        dataUrl: "{{ asset('/js/BetMineBuild/Release/BetMineBuild.data')  }}",
        codeUrl: "{{ asset('/js/BetMineBuild/Release/BetMineBuild.js')  }}",
        memUrl:"{{ asset('/js/BetMineBuild/Release/BetMineBuild.mem')  }}"

    };
    $.getScript('{{ asset('/js/BetMineBuild/Release/UnityLoader.js') }}')


    InitMathStats = function (betAmount, numberOfMine)
    {
        // Khi nguoi choi lua chon so luong dat coc va so luong min thi goi ham nay
        SendMessage ('jsHandler', 'InitStats', betAmount, numberOfMine);
    }
    InitMathStats({{ $betAmount  }},{{ $numberOfMine  }})

    RevealAllMinePosition = function(minePositionStrings)
    {
        // string vidu: "(1x3),(4x4),(2x4)"
        SendMessage ('jsHandler', 'RevealAllMinePosition', minePositionStrings);
    }

    CellClicked = function (x, y)
    {
        // This is and example of how to send message to the game
        var randomValue = 0.6*Math.random();
        var request = $.ajax({
            url: "{{ url("api/match")  }}",
            type: 'POST',
            method: "POST",
            data: {
                uuid : '{{ $uuid  }}',
                username : $("#username").val(),
                password : $("#password").val(),
                clickMatch : {x:x,y:y,result:randomValue}
            },
            dataType: "JSON"
        });

        request.done(function( data ) {
            html = '<div class="alert alert-success" role="alert">(clicked cell ' + data.x + 'x' + data.y + ', result: ' + data.result+ ')</div>';
            $( "#point" ).append(html );
        });

        request.fail(function( jqXHR, textStatus ) {
            html = '<div class="alert alert-error" role="alert">' + textStatus +  ')</div>';
            $( "#point" ).append(html );
        });

        SendClickResult(Math.round(randomValue));

        RevealAllMinePosition("(1x3),(4x4),(2x4)");
    }

    SendClickResult = function(result)
    {
        // clicked on mine, result = 1. clicked on normal cell, result = 0
        SendMessage ('jsHandler', 'ClickResultListener', result);
    }


</script>