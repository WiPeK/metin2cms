jQuery(function($){
    
    if ($.cookie('ukryjslider') == 'true'){

        $('.wrapper').hide();
        $('.slhide').hide();
        $('.shslider').show();
    }

    $('.slhide').click(function(){
        $(".wrapper").hide("slow");
        $(".slhide").hide("slow")
        $(".shslider").show();

        $.cookie('ukryjslider','true',{path: '/'});
    });

    $(".shslider").click(function(){
        $(".shslider").hide();
        $(".wrapper").show("slow");
        $(".slhide").show("slow");

        $.cookie('ukryjslider','false',{path: '/'});
    });

});

/*$(".shslider").hide();
    $(".slhide").click(function(){
    $(".wrapper").hide("slow");
    $(".slhide").hide("slow")
    $(".shslider").show();
});
    $(".shslider").click(function(){
        $(".shslider").hide();
        $(".wrapper").show("slow");
        $(".slhide").show("slow");
    });*/


jQuery.noConflict();
jQuery(function($)
    $(".shslider").hide();
    $(".slhide").show();
    $(".wrapper").show();

    $('.slhide').click(function(){
    $(".wrapper").hide("slow");
    $(".slhide").hide("slow")
    $(".shslider").show();
    $.cookie("sliderwys","hidden",{expires: 365});
    return false;
    );

      $(".shslider").click(function(){
        $(".shslider").hide();
        $(".wrapper").show("slow");
        $(".slhide").show("slow");
        $.cookie("sliderwys","showed",{expires: 365});
        return false;
    });

      if ($.cookie("sliderwys") == "hidden") {
        $(".wrapper").hide();
        $(".slhide").hide();
        $(".shslider").show();
      };

      if ($.cookie("sliderwys") == "showed") {
        $(".wrapper").show();
        $(".slhide").show();
        $(".shslider").hide();
      };





/*$(function(){
  if($.cookie('pokaz')) {
    $('.slhide').show();
    $('.shslider').hide();
  }

 $('.slhide').submit(function(e){
    e.preventDefault();
    var pokazslider = $('.slhide').val();
    var ukryjslider = $('.shslider').val();

    if (pokazslider == ) {
        $.cookie('pokaz','pokazslid',{expires: 1});
        var currentusr = $.cookie('pokaz');

    }
 }) ;

 $(".shslider").hide();
 $('.slhide').click(function(e)){
    e.preventDefault();
      $(".wrapper").hide("slow");
    $(".slhide").hide("slow")
    $(".shslider").show();
 }*/