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
    document.title = Math.round(1e6 * e).toLocaleString("en-US") + " bits - Satoshi Mines", $(".balance .val .num").text(Math.round(1e6 * e).toLocaleString("en-US")).prop("title", "Ƀ" + parseFloat(e).toFixed(6).replace(/0+$/g, ""))
}

function Game(e, t, a) {
    var s = "undefined" == typeof t ? !0 : !1;
    a = "undefined" != typeof a ? a : 3;
    var n = "undefined" == typeof t ? "" : "&game_hash=" + t;
    this.guesses = 0;
    var i = this;
    busy = !0;
    var o = 0;
        console.log(t);
    $.ajax({
        url: BASE_URL + "/api/game/newgame",
        data: {"bd":bdval,"player_hash":playerhash,"bet":e+n,"num_mines":a},
        type: "POST",
        dataType: "json",
        beforeSend: function(e) {
            o = +new Date
        }
    }).done(function(t) {
        if (busy = !1, clean_feed(), "success" == t.status) {
            /*i.gametype = t.gametype, s && (ga("send", "event", "Game", "Start", i.gametype, Math.round(1e6 * t.bet), {
                metric1: new Date - o,
                metric2: Math.round(1e6 * t.bet),
                dimension1: a + " Mine" + (1 == a ? "" : "s"),
                dimension2: i.gametype.charAt(0).toUpperCase() + i.gametype.slice(1),
                location: "/play/",
                page: "/play/",
                title: "Game"
            }), ga("send", "event", "Speed", "New Game", i.gametype, new Date - o, {
                location: "/play/",
                page: "/play/",
                title: "Game"
            }));*/
            var n = parseFloat(t.bet);
            if (n = isNaN(n) ? 0 : n, "practice" != t.gametype && 0 != e && updateBalance(-1 * n), i.betNumber = parseInt(t.betNumber), i.game_hash = t.game_hash, i.bet = t.bet, i.stake = t.stake, i.next = t.next, i.id = t.id, i.jqel = $game_html.clone(), "practice" == t.gametype && i.jqel.addClass("practice_game"), "undefined" != typeof t.guesses && null != t.guesses)
                for (var l = t.guesses.split("-"), r = 0; r < l.length; r++) i.jqel.find('li[data-tile="' + l[r] + '"]').addClass("pressed").html('<i class="icon-check"></i>');
            i.changed_stake_recently = !1, i.jqel.attr("id", "game_" + i.game_hash).find(".stake").text((1e6 * parseFloat(i.stake).toFixed(6)).toLocaleString("en-US")), i.jqel.find(".next").text((1e6 * parseFloat(i.next).toFixed(6)).toLocaleString("en-US")), i.jqel.hide().addClass("hidegame").css("visibility", "hidden").prependTo(".feed").slideDown(300, function() {
                $(this).hide().css("visibility", "visible").removeClass("hidegame").show(), i.jqel.find(".cashout").click(function(e) {
                    e.preventDefault(), busy || i.cashout()
                }), i.jqel.find(".board li").click(function(e) {
                    if (e.preventDefault(), !busy) {
                        var t = $(this);
                        i.guess(t)
                    }
                }), $(this).bind("mouseover", function() {
                    $(".feed div.game").addClass("faded"), i.jqel.removeClass("faded")
                }), i.message("A " + t.num_mines + "-mine game for " + Math.round(1e6 * parseFloat(t.bet)).toLocaleString("en-US") + ' bits has started. Secret hash: <span class="secret_hash">' + t.secret + "</span>", "first")
            })
        } else "error" == t.status && show_error(t.message)
    }).fail(function() {
        show_error("This game could not be retrieved at this time.")
    }).always(function() {
        setTimeout(function() {
            $("#start_game").removeAttr("disabled").spin(!1)
        }, 500)
    })
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

function change_password(e, t, a) {
    return $(".password_messages").html(""), "undefined" == typeof e && (e = ""), "undefined" == typeof t || "" == t ? (reset_loader(), void $(".password_messages").prepend('<p class="error">Can\'t set an empty password.</p>')) : t != a ? (reset_loader(), void $(".password_messages").prepend('<p class="error">The entered passwords do not match.</p>')) : ($(".pw_modal .modal_load .content").html("<p>Setting password&hellip;</p>"), $(".pw_modal .modal_load").fadeIn(250), $(".pw_modal .modal_load .icon").html("").spin({
        lines: 20,
        length: 8,
        radius: 15
    }), void $.ajax({
        url: BASE_URL + "/api/game/change_password.php",
        data: "secret=" + playerhash + "&old_password=" + encodeURIComponent(e) + "&new_password=" + encodeURIComponent(t),
        type: "POST",
        dataType: "json"
    }).done(function(e) {
        return "success" != e.status ? "error" == e.status ? (reset_loader(), $(".password_messages").prepend('<p class="error">' + e.message + "</p>"), !1) : (reset_loader(), $(".password_messages").prepend('<p class="error">Unknown error.</p>'), !1) : ($(".pw_modal .modal_load .icon").html('<span><i class="icon-lock"></i></span>'), void $(".pw_modal .modal_load .content").html("<p>" + e.message + '</p><button class="line_btn line_btn_green close_all">OK</button>'))
    }).fail(function() {
        return reset_loader(), $(".password_messages").prepend('<p class="error">Could not reach the server. Are you still connected to the internet?</p>'), !1
    }))
}

function withdraw(e, t) {
    $(".withdraw_messages").html("");
    var e = $(".withdraw_form .payto_address").val(),
        t = parseFloat($(".withdraw_form .amount").val() / 1e6).toFixed(6);
    return e.length < 1 ? (reset_loader(), void $(".withdraw_messages").prepend('<p class="error">You must supply a Bitcoin address to withdraw to.</p>')) : 0 >= t ? (reset_loader(), void $(".withdraw_messages").prepend('<p class="error">Can\'t withdraw 0 bits.</p>')) : ($(".withdraw_messages").html(""), $(".modal_load .content").html("<p>Withdrawing&hellip;</p>"), $(".modal_load").fadeIn(250), $(".icon").html("").spin({
        lines: 20,
        length: 8,
        radius: 15
    }), busy = !0, timer = 0, void $.ajax({
        url: BASE_URL + "/api/game/full_cashout.php",
        data: "secret=" + playerhash + "&payto_address=" + e + "&amount=" + t,
        type: "POST",
        dataType: "json",
        beforeSend: function(e) {
            timer = +new Date
        }
    }).done(function(e) {
        return busy = !1, "success" != e.status ? "error" == e.status ? (reset_loader(), $(".withdraw_messages").prepend('<p class="error">' + e.message + "</p>"), !1) : (reset_loader(), $(".withdraw_messages").prepend('<p class="error">Unknown error.</p>'), !1) : (ga("send", "event", "Balance", "Withdraw", void 0, Math.round(1e6 * t), {
            location: "/play/",
            page: "/play/",
            title: "Game"
        }), ga("send", "event", "Speed", "Withdraw", void 0, new Date - timer, {
            location: "/play/",
            page: "/play/",
            title: "Game"
        }), $(".modal_load .icon").html('<span style="color:#5a0;"><i class="icon-check"></i></span>'), $(".modal_load .content").html("<p>" + e.message + '</p><button class="line_btn line_btn_green close_all">OK</button>'), put_balance(e.balance), void 0)
    }).fail(function() {
        return reset_loader(), $(".withdraw_messages").prepend('<p class="error">Could not reach the server. Are you still connected to the internet?</p>'), !1
    }))
}

function look_for_deposits(e) {
    looking_for_deposits || ($(".modal_load .content").html('<p>Looking for deposits&hellip;</p><button class="line_btn line_btn_red cancel_refresh">Cancel</button>'), $(".modal_load").fadeIn(250), $(".icon").html("").spin({
        lines: 20,
        length: 8,
        radius: 15
    }), looking_for_deposits = !0), "undefined" == typeof e && (e = 0);
    var t = 0;
    balance_ping = $.ajax({
        url: BASE_URL + "/api/game/refresh_balance.php",
        data: "secret=" + playerhash,
        type: "POST",
        dataType: "json",
        beforeSend: function(e) {
            t = +new Date
        }
    }).done(function(a) {
        if (busy = !1, "success" == a.status) {
            document.title = 1e6 * a.balance + " - Satoshi Mines";
            var s = read_balance();
            if (s < 1e6 * a.balance) {
                var n = parseFloat(parseFloat(a.balance) - parseFloat(s / 1e6)).toFixed(6);
                ga("send", "event", "Balance", "Deposit", void 0, Math.round(1e6 * n), {
                    location: "/play/",
                    page: "/play/",
                    title: "Game"
                }), ga("send", "event", "Speed", "New Game", void 0, new Date - t, {
                    location: "/play/",
                    page: "/play/",
                    title: "Game"
                }), $(".modal_load .icon").html('<span class="num_icon">+' + Math.round(1e6 * n).toLocaleString("en-US") + "</span>"), $(".modal_load .content").html('<p>You deposited <span class="big">Ƀ' + n.replace(/0+$/g, "") + '</span>. Exactly <span class="big">' + Math.round(1e6 * n).toLocaleString("en-US") + '</span> bits have been added to your balance.</p><button class="line_btn line_btn_green close_all">OK</button>')
            } else 6 > e ? (e++, balance_ping_timer = setTimeout(function() {
                look_for_deposits(e)
            }, 500 * Math.pow(e, 2))) : (looking_for_deposits = !1, $(".modal_load .icon").html('<span style="color:#d00;"><i class="glyphicon glyphicon-certificate"></i></span>'), $(".modal_load .content").html('<p>Satoshi Mines could not find any new deposits.</p><p><button class="line_btn line_btn_red close_all">Cancel</button><button class="line_btn line_btn_green refresh_bal">Look Again</button>'));
            put_balance(a.balance)
        } else "error" == a.status && (close_all(), show_error("There was a problem refreshing your balance: " + a.message))
    }).fail(function(e) {
        500 == e.status ? (reset_loader(), show_error("A problem occured when trying to look for your deposit. Please contact the admin if this problem persists.")) : "abort" == e.statusText ? reset_loader() : show_error("A problem occured when trying to refresh your balance. Are you still connected to the internet?")
    })
}

function close_all() {
    clearTimeout(balance_ping_timer), reset_loader(), looking_for_deposits = !1, $(".shadow, .modal, .pw_modal").fadeOut(250), "undefined" != typeof balance_ping && balance_ping.abort()
}

function edit_presets() {
    var e = "";
    $("ul.bets li").not(":last").each(function() {
        $(this).append('<input type="text" value="' + $(this).find("button").text() + '" maxlength="7">').find("button").hide()
    }), $("ul.bets li:last button").text("Done").unbind("click").click(function() {
        var t = 8;
        $("ul.bets li").not(":last").each(function() {
            e += $(this).find("input").val() + ":", $(this).find("button").text($(this).find("input").val()).show(), $(this).find("button").removeClass(), "+" == $(this).find("input").val().substr(0, 1) ? $(this).find("button").addClass("button_plus") : "-" == $(this).find("input").val().substr(0, 1) ? $(this).find("button").addClass("button_minus") : "x" == $(this).find("input").val().substr(0, 1) ? $(this).find("button").addClass("button_multiply") : "0" === $(this).find("input").val() ? $(this).find("button").addClass("button_zero") : "%" == $(this).find("input").val().slice(-1) && $(this).find("button").addClass("button_percent"), $(this).find("input").remove(), --t || (e = encodeURIComponent(e.slice(0, -1)), $.ajax({
                url: BASE_URL + "/api/game/setpresets.php",
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
var busy = !1,
    consecutive_zeros = 0,
    balance_ping, balance_ping_timer, current_io = "in",
    $game_html = $('<div class="game"><div class="game_left"><ul class="board"><li data-tile="1" class="tile"></li><li data-tile="2" class="tile"></li><li data-tile="3" class="tile"></li><li data-tile="4" class="tile"></li><li data-tile="5" class="tile"></li><li data-tile="6" class="tile"></li><li data-tile="7" class="tile"></li><li data-tile="8" class="tile"></li><li data-tile="9" class="tile"></li><li data-tile="10" class="tile"></li><li data-tile="11" class="tile"></li><li data-tile="12" class="tile"></li><li data-tile="13" class="tile"></li><li data-tile="14" class="tile"></li><li data-tile="15" class="tile"></li><li data-tile="16" class="tile"></li><li data-tile="17" class="tile"></li><li data-tile="18" class="tile"></li><li data-tile="19" class="tile"></li><li data-tile="20" class="tile"></li><li data-tile="21" class="tile"></li><li data-tile="22" class="tile"></li><li data-tile="23" class="tile"></li><li data-tile="24" class="tile"></li><li data-tile="25" class="tile"></li></ul></div><div class="game_right"><div class="control standings"><div class="col-left"><p class="standing_label">Next:</p><p class="stand_next"><span class="next"></span></p></div><div class="col-right"><button class="cashout">Cashout</button><p class="standing_label">Stake:</p><p class="stand_stake"><span class="stake"></span></p></div></div><div class="messages"></div></div></div>'),
    sound_enabled = !0,
    sound = new Howl({
        urls: [BASE_URL + "/sound/btcbomb.mp3", BASE_URL + "/sound/btcbomb.ogg", BASE_URL + "/sound/btcbomb.wav"],
        sprite: {
            small: [0, 700],
            medium: [790, 700],
            win: [1490, 700],
            lose: [2300, 500]
        }
    });
Game.prototype.message = function(e, t) {
    if (e.length < 1) return !0;
    var a = $("<p>" + e + "</p>");
    if (arguments.length > 1)
        for (var s = 1, n = arguments.length; n >= s; s++) a.addClass(arguments[s]);
    a.hide().prependTo(this.jqel.find(".messages")).slideDown(200)
}, Game.prototype.cashout = function() {
    var e = this;
    e.jqel.find("button.cashout").attr("disabled", "disabled").spin();
    var t = 0;
    $.ajax({
        url: BASE_URL + "/api/game/cashout",
        data: "game_hash=" + e.game_hash,
        type: "POST",
        dataType: "json",
        beforeSend: function() {
            t = +new Date
        }
    }).done(function(a) {
        if ("success" == a.status) {
            updateBalance(parseFloat(a.win)), e.jqel.find(".inplay p").html("Won: <span>Ƀ" + a.win + "</span>"), e.jqel.find(".cashout").hide(), e.message(a.message, "won"), e.message("Secret: " + a.mines + "-" + a.random_string), e.message('Share this game: <input type="text" value="'+ BASE_URL +'/games/share/' + a.game_id + "/" + a.random_string + '/">');
            var s = a.mines.split("-");
            for (i = 0; i < s.length; i++) e.jqel.find('li[data-tile="' + s[i] + '"]').addClass("reveal").html('<i class="glyphicon glyphicon-certificate"></i>')
        } else "error" == a.status && e.message(a.message, "error")
    }).fail(function() {
        alert("jqxhr failed")
    }).always(function() {
        e.jqel.find("button.cashout").removeAttr("disabled").spin(!1)
    })
}, Game.prototype.guess = function(e) {
    var t = this,
        a = parseInt(e.attr("data-tile")),
        s = 0;
    a > 0 && 26 > a ? (e.spin({
        radius: 6,
        color: "#000"
    }), e.addClass("active_tile"), busy = !0, $.ajax({
        url: BASE_URL + "/api/game/checkboard",
        data: "game_hash=" + t.game_hash + "&guess=" + a + "&v04=1",
        type: "POST",
        dataType: "json",
        beforeSend: function() {
            s = +new Date
        }
    }).done(function(n) {
        if (busy = !1, e.spin(!1), e.removeClass("active_tile"), t.betNumber++, "success" == n.status) {
            if (t.guesses++, "real" == t.gametype, "bitcoins" == n.outcome && (t.change_stake(1e6 * n.stake), animate_val(t.jqel.find(".next"), 1e6 * n.next.toFixed(6)), sound_enabled && sound.play("win"), t.message(n.message, "find"), t.jqel.find('li[data-tile="' + n.guess + '"]').addClass("pressed").html('<span class="tile_val">+' + abbrNum(1e6 * n.change) + "</span>")), "bomb" == n.outcome) {
                t.message(n.message, "bomb"), t.jqel.find('li[data-tile="' + n.guess + '"]').addClass("pressed bomb").html('<i class="glyphicon glyphicon-certificate"></i>'), t.message("Secret: " + n.bombs + "-" + n.random_string), t.message('Share this game: <input type="text" value="' + BASE_URL + '/games/share/' + n.game_id + "/" + n.random_string + '/">'), t.change_stake(0), t.jqel.find(".cashout").hide();
                var o = n.bombs.split("-");
                for (i = 0; i < o.length; i++) t.jqel.find('li[data-tile="' + o[i] + '"]').addClass("reveal").html('<i class="glyphicon glyphicon-certificate"></i>');
                sound_enabled && sound.play("lose")
            }
        } else "error" == n.status && t.message(n.message, "error")
    }).fail(function() {
        e.removeClass("active_tile").spin(!1), this.message("There was a problem making that guess.", "error")
    })) : this.message("Hey, wait a minute.")
}, Game.prototype.change_stake = function(e) {
    var t = this;
    this.changed_stake_recently = !0;
    var a = parseInt($(t.jqel).find(".stake").text());
    e > a ? animate_val($(t.jqel).find(".stake"), e) : $($(t.jqel).find(".stake")).html(e), setTimeout(function() {
        t.changed_stake_recently = !1
    }, 5e3)
};
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
    };
$(document).ready(function() {
    document.addEventListener && document.addEventListener("touchstart", function() {}, !1), $(".sub_close").click(function(e) {
        e.preventDefault(), $(this).parent().slideUp(300, function() {
            $(this).find(".sub_content").html(""), $(".nav .links li").removeClass("selected")
        })
    }), $(".sound").click(function(e) {
        e.preventDefault(), sound_enabled ? ($(this).attr("class", "sound sound_disabled").find("i").attr("class", "icon-volume-off"), sound_enabled = !1) : ($(this).attr("class", "sound sound_enabled").find("i").attr("class", "icon-volume-on"), sound_enabled = !0)
    }), $(".cp").waypoint("sticky"), $("#player_name").blur(function(e) {
        e.preventDefault();
        var t = $(this).val();
        $.ajax({
            url: BASE_URL + "/game/nameplayer.php",
            data: "secret=" + playerhash + "&player_name=" + t,
            type: "POST",
            dataType: "json"
        }).done(function(e) {
            "error" == e.status && show_error(e.message)
        }).fail(function() {
            show_error("There was a problem updating your player name. Please contact the admin if this keeps happening.")
        })
    }), $(".bets button").bind("click", presentHandler), $("#start_game").click(function() {
        $(this).attr("disabled", "disabled").spin();
        var e = parseFloat(parseInt($("#bet").val().replace(/[^0-9]+/g, "")) / 1e6).toFixed(6),
            t = $(".mine_options button.active").text().replace(/[^0-9]+/g, "");
        games.push(new Game(e, void 0, t))
    })
}), $(document).on("click", "#password", function(e) {
   /* $(".pw_modal input").val(""), $(".password_messages").html(""), $(".shadow").fadeIn(250), setTimeout(function() {
        $(".pw_modal").fadeIn(250)
    }, 150)*/
}), $(document).on("click", ".pw_modal .line_btn_green", function(e) {
    e.preventDefault();
    var t = $(this).parent().children("#old_password").val(),
        a = $(this).parent().children("#new_password").val(),
        s = $(this).parent().children("#new_password_verify").val();
    change_password(t, a, s)
}), $(document).on("click", ".messages input", function(e) {
    e.preventDefault(), $(this).select()
}), $(document).on("click", ".mine_options button", function(e) {
    e.preventDefault(), $(".mine_options button").removeClass("active"), $(this).addClass("active")
}), $(document).on("click", "button.withdraw", function(e) {
    e.preventDefault();
    var t = parseFloat($('.withdraw_form input[name="amount"]').val()),
        a = $('.withdraw_form input[name="payto"]').val();
    withdraw(a, t)
}), $(document).on("click", ".io_menu li", function(e) {
    e.preventDefault(), show_io($(this).attr("id").substr(3))
}), $(document).on("click", ".refresh_bal", function(e) {
    e.preventDefault(), look_for_deposits(0)
}), $(document).on("click", ".close_all", function(e) {
    e.preventDefault(), close_all()
}), $(document).on("click", ".cancel_refresh", function(e) {
    looking_for_deposits = !1, "undefined" != typeof balance_ping && balance_ping.abort(), clearTimeout(balance_ping_timer), reset_loader()
}), $(document).on("click", "#deposit_withdraw", function(e) {
    e.preventDefault(), $(".withdraw_form .amount").val(read_balance()), $(".out_bits").text(read_balance().toLocaleString("en-US")), $(".out_bitcoins").text(read_balance(!0)), $(".modal .io").hide(), show_io("in"), setTimeout(function() {
        $(".modal").fadeIn(250), "" == $(".btcaddr").text() && ($("p.btcaddr").spin(), $.ajax({
            url: BASE_URL + "/api/game/getaddr",
            data: "secret=" + playerhash,
            type: "POST",
            dataType: "json"
        }).done(function(e) {
            "success" == e.status && ($(".btcaddr").spin(!1).text(e.address), $(".addr_details").hide().html('<ul class="addr_links"><li>View On:</li><li><a target="_blank" href="https://blocktrail.com/BTC/address/' + e.address + '">Blocktrail</a></li><li><a target="_blank" href="http://btc.blockr.io/address/info/' + e.address + '">blockr.io</a></li><li><a target="_blank" href="http://blockchain.info/address/' + e.address + '">blockchain.info</a></li></ul><a target="_blank" href="bitcoin:' + e.address + '"><img width="165" height="165" src="' + BASE_URL + "/api/game/getqr.php?code=" + e.address + '" alt=""></a>').fadeIn(500)), "error" == e.status && show_error(e.message)
        }).fail(function() {
            show_error("There was a problem getting your deposit address. Please contact the admin.")
        }))
    }, 100), $(".shadow").fadeIn(250)
}), $(document).keyup(function(e) {
    $("#hotkeys").is(":checked") && (32 != e.which || $("#player_name").is(":focus") || $(".modal").is(":visible") || $("#start_game").trigger("click").removeClass("active"))
}), $(document).keydown(function(e) {
    $("#hotkeys").is(":checked") && (32 != e.which || $("#player_name").is(":focus") || $(".modal").is(":visible") || ($("#start_game").addClass("active"), e.preventDefault()))
});


function account(isUpdate) {
    var data = {
        username: $("#username").val(),
        password: $("#password").val()
    }
    if (isUpdate == 1){
        data.current_password =  $("#current_password").val()
    }
    $.ajax({
            method: "POST",
            dateType: "JSON",
            data: data,
            url: BASE_URL + "/api/account/change"
        })
        .done(function (msg) {
            if(msg.success == true){
                $("#account_msg").html("<div class='alert alert-success'>"+ msg.message +"</div>");
            }else{
                $("#account_msg").html("<div class='alert alert-danger'>"+ msg.message +"</div>");
            }
            setTimeout(function() {
                window.location.reload(true);
            }, 2000);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            $("#account_msg").html("<div class='alert alert-danger'>"+errorThrown+"</div>").delay(5000).hide(0);
            setTimeout(function() {
              window.location.reload(true);;
            }, 2000);
        });
}