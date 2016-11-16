

//game
function animate_val(e, t) {
    var a = ($(e).attr("class"), $(e).text().replace(/[^0-9\.]+/g, "")),
        s = t - a,
        n = 0;
    n = s > 100 ? 24 : s > 40 ? 12 : s > 10 ? 8 : s > 3 ? 4 : 1;
    for (var i = a, o = s / n, l = Math.ceil(900 / n), r = 0; n > r; r++) setTimeout(function(a) {
        i = a >= n - 1 ? t : parseInt(parseFloat(o) + parseFloat(i)), $(e).text(i.toLocaleString("en-US"))
    }, Math.ceil(r * l), r)
}

function read_balance(e) {
    var t = parseInt($(".balance .val .num").text().replace(/[^0-9]+/g, ""));
    return "undefined" != typeof e && 1 == e ? parseFloat(t / 1e6).toFixed(6).replace(/0+$/g, "") : t
}

function abbrNum(e) {
    e = Math.round(e);
    var t = 1;
    (e >= 1e6 && 1e6 > e || 1e4 > e) && (t = 0), 1e4 > e && (t = 0), e >= 1e6 ? t = 1 : e >= 1e5 ? t = 0 : e >= 1e4 && (t = 1), t = Math.pow(10, t);
    for (var a = ["k", "m", "b", "t"], s = a.length - 1; s >= 0; s--) {
        var n = Math.pow(10, 3 * (s + 1));
        if (e >= n && e > 1e4) {
            e = Math.round(e * t / n) / t, 1e3 == e && s < a.length - 1 && (e = 1, s++), e += a[s];
            break
        }
    }
    return e
}

function put_balance(e) {
    document.title = Math.round(1e6 * e).toLocaleString("en-US") + " bits - Satoshi Mines", $(".balance .val .num").text(Math.round(1e6 * e).toLocaleString("en-US")).prop("title", "Éƒ" + parseFloat(e).toFixed(6).replace(/0+$/g, ""))
}

function updateBalance(e) {
    var t = read_balance(),
        a = t + Math.round(1e6 * e);
    put_balance(parseFloat(a / 1e6)), t + e > 0 ? $("#cashout_balance").removeClass("disabled") : $("#cashout_balance").addClass("disabled")
}

function show_error(e) {
    $('<p class="player_error">' + e + "</p>").hide().prependTo(".feed").slideDown(200)
}

function show_success(e) {
    $('<p class="player_success">' + e + "</p>").hide().prependTo(".feed").slideDown(200)
}

function clean_feed() {
    $(".feed>*").not($(".feed>*").slice(0, 19)).remove()
}

function show_io(e) {
    "undefined" != typeof e && (current_io = e), $(".io_" + current_io).is(":visible") || ($(".io_menu li").removeClass("selected"), $(".io_menu li#io_" + current_io).addClass("selected"), $(".io:visible").length < 1 ? $(".io_" + current_io).fadeIn() : $(".io:visible").fadeOut(300, function() {
        $(".io_" + current_io).fadeIn()
    }))
}

function reset_loader() {
    $(".modal_load").fadeOut(250, function() {
        $(this).html('<div class="icon"></div><div class="content"></div>')
    })
}

function close_all() {
    clearTimeout(balance_ping_timer), reset_loader(), looking_for_deposits = !1, $(".shadow, .modal, .pw_modal").fadeOut(250), "undefined" != typeof balance_ping && balance_ping.abort()
}

function edit_presets() {
    var e = "";
    $("ul.bets li").not(":last").each(function() {
        $(this).find("input").remove();
        $(this).append('<input type="text" value="' + $(this).find("button").text() + '" maxlength="7">').find("button").hide()
    });
    $("ul.bets li:last button").text("Done").unbind("click").click(function() {
        var t = 8;
        $("ul.bets li").not(":last").each(function() {
            e += $(this).find("input").val() + ":", $(this).find("button").text($(this).find("input").val()).show(), $(this).find("button").removeClass(), "+" == $(this).find("input").val().substr(0, 1) ? $(this).find("button").addClass("button_plus") : "-" == $(this).find("input").val().substr(0, 1) ? $(this).find("button").addClass("button_minus") : "x" == $(this).find("input").val().substr(0, 1) ? $(this).find("button").addClass("button_multiply") : "0" === $(this).find("input").val() ? $(this).find("button").addClass("button_zero") : "%" == $(this).find("input").val().slice(-1) && $(this).find("button").addClass("button_percent"), $(this).find("input").remove(), --t || (e = encodeURIComponent(e.slice(0, -1)), $.ajax({
                url: BASE_URL + "/games/setpresets",
                data: "secret=" + playerhash + "&new_presets=" + e,
                type: "POST",
                dataType: "json"
            }).done(function(e) {
                "error" == e.status && show_error(e.message)
            }).fail(function() {
                show_error("There was a problem saving your presets. Please contact the admin if this keeps happening.")
            }))
        }), $(this).text("EDIT").unbind("click").bind("click", presentHandler)
    })
}

function donav() {
    $(document).ready(function() {
        function e() {
            var e = $(window).scrollTop();
            e > 55 ? ($(".new_nav").addClass("compact fixed"), $(".pusher").addClass("show")) : ($(".new_nav").removeClass("compact fixed"), $(".pusher").removeClass("show")), 1 == home && (e > 228 ? $(".new_nav .special").slideDown(200) : $(".new_nav .special").slideUp(200)), $(".home_slider").css("background-position", "center " + .2 * e + "px")
        }
        e(), $(window).bind("scroll", function(t) {
            e()
        })
    })
}

function switch_mine_selection(e) {
    if ("left" == e) {
        if ($(".mine_options > div:first-child button.active").length) return !1;
        $(".mine_options button.active").removeClass("active").parent().prev().find("button").addClass("active")
    }
    if ("right" == e) {
        if ($(".mine_options > div:last-child button.active").length) return !1;
        $(".mine_options button.active").removeClass("active").parent().next().find("button").addClass("active")
    }
}

var looking_for_deposits = !1,
    presentHandler = function(e) {
        e.preventDefault(), $(this).hasClass("button_edit") && edit_presets();
        var t = read_balance(),
            a = parseInt($(".starter .bet").val().replace(/[^0-9]+/g, ""));
        if (isNaN(a) && (a = 0), "+" == $(this).text().substr(0, 1)) {
            var s = parseFloat($(this).text());
            $("#bet").attr("step", parseInt($(this).text())), window.step = parseInt($(this).text()), s = (s + a).toFixed(4)
        } else if ("-" == $(this).text().substr(0, 1)) {
            var s = parseFloat($(this).text());
            $("#bet").attr("step", parseInt($(this).text())), window.step = parseInt($(this).text()), s = (a + s).toFixed(4)
        } else if ("MAX" == $(this).text()) var s = maxbet;
        else if ("MIN" == $(this).text()) var s = minbet;
        else if ("%" == $(this).text().substr(-1)) var s = Math.round(read_balance() * (parseInt($(this).text().replace(/[^0-9]+/g, "")) / 100));
        else if ("x" == $(this).text().substr(0, 1)) {
            var s = parseFloat($(this).text().substr(1));
            s = parseInt(a * s)
        } else var s = parseFloat($(this).text()).toFixed(4);
        s == maxbet && s > t && t > 0 && (s = t), $(".bet").val(parseInt(s))

        var e = parseFloat(parseInt($("#bet").val().replace(/[^0-9]+/g, ""))),
            t = $(".mine_options button.active").text().replace(/[^0-9]+/g, "");
        $(".stand_next span").html(e);
        InitMathStats(e,t)

    };


function loadGame(bet,bom){
    var requestGame = $.ajax({
        url: BASE_URL + "/api/game/play",
        type: 'POST',
        method: "POST",
        data: {
            betAmount : bet,
            numberOfMine : bom
        },
        dataType: "HTML"
    });

    requestGame.done(function( data ) {

        $( ".load_game" ).append(data );
        $("#start_game").attr("disabled", "disabled")
    });

    requestGame.fail(function( jqXHR, textStatus ) {
        html = '<div class="alert alert-error" role="alert">' + textStatus +  ')</div>';
        $( ".data" ).append(html );
    });
}

$(document).ready(function() {
    $("#bet").val(minbet);
    $(".stand_next span").html(minbet);
    $("#start_game").removeAttr("disabled");
    document.addEventListener && document.addEventListener("touchstart", function() {}, !1), $(".sub_close").click(function(e) {
        e.preventDefault(), $(this).parent().slideUp(300, function() {
            $(this).find(".sub_content").html(""), $(".nav .links li").removeClass("selected")
        })
    }), $(".bets button").bind("click", presentHandler), $("#start_game").click(function() {
      //  $(this).attr("disabled", "disabled").spin();
        var e = parseFloat(parseInt($("#bet").val().replace(/[^0-9]+/g, "")) / 1e6).toFixed(6),
            t = $(".mine_options button.active").text().replace(/[^0-9]+/g, "");
        InitMathStats(e,t)
    }),
    $(".bets button").bind("click", presentHandler),
    $(document).on("click", ".mine_options button", function(e) {
        e.preventDefault(), $(".mine_options button").removeClass("active"), $(this).addClass("active")
    });

});