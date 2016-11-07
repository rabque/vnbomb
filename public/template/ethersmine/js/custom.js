$(document).ready(function() {
  "use strict";
  var $target;
  //===============Mobile Nav Function============
    $('#menu').on('click', function() { 
            $('.navigation').slideToggle();
    })  
  });
	$('a[data-rel^="#"]').on('click.smoothscroll',function (e) {	
    e.preventDefault();    
    var target = $(this).attr("data-rel");
        $target = $(target);
  goto=parseInt($target.offset().top)-parseInt(62)
    $('html, body').stop().animate({
        'scrollTop': goto
    }, 1000, 'swing', function () {
       
    });
});
$(window).load(function() {
	$('#loader-wrapper').delay(500).fadeOut();
});