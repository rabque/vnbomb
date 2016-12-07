$(document).ready(function () {
    "use strict";
    var $target;
    //===============Mobile Nav Function============
    $('#menu').on('click', function () {
        $('.navigation').slideToggle();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
});
$('a[data-rel^="#"]').on('click.smoothscroll', function (e) {
    e.preventDefault();
    var target = $(this).attr("data-rel");
    $target = $(target);
    goto = parseInt($target.offset().top) - parseInt(62)
    $('html, body').stop().animate({
        'scrollTop': goto
    }, 1000, 'swing', function () {

    });


});

$(document).ready(function () {
    //Get the canvas &

    //Initial call
    //  respondCanvas();

});
$(window).load(function () {
    $('#loader-wrapper').delay(500).fadeOut();
});


function newaffiliate(){
    if( $("#address").val() === ''){
        $("#affiliate_result").html("<div class='alert alert-danger'>Paymen address not empty</div>").delay(5000).hide(0);
        return false;
    }
    $.ajax({
            method: "POST",
            dateType: "JSON",
            data: {address: $("#address").val()},
            url: BASE_URL + "/api/action/newaffiliate"
        })
        .done(function (msg) {
            if(msg.success == true){
                $("#affiliate_result").html("<div class='alert alert-success'>"+ msg.message +"</div>");
            }else{
                $("#affiliate_result").html("<div class='alert alert-danger'>"+ msg.message +"</div>");
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            $("#affiliate_result").html("<div class='alert alert-danger'>"+errorThrown+"</div>").delay(5000).hide(0);

        });
}
