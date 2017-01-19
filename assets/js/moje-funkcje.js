//ladowanie bez przeladowania
function Load(div, link) {
	$(div).load(link);
}

//cookies slider
jQuery(function($){
    
            if ($.cookie('ukryjslider') == 'true'){

                $('.wrapper2').hide();
                $('.slhide').hide();
                $('.shslider').show();
            }

            $('.slhide').click(function(e){
                e.preventDefault();
                $(".wrapper2").hide("slow");
                $(".slhide").hide("slow")
                $(".shslider").show();

                $.cookie('ukryjslider','true',{path: '/'});
            });

            $(".shslider").click(function(e){
                e.preventDefault();
                $(".shslider").hide();
                $(".wrapper2").show("slow");
                $(".slhide").show("slow");

                $.cookie('ukryjslider','false',{path: '/'});
            });

        });


//rozsuwanie
        $(".rozwiniete,.ukryj").hide();
        $(".rozwin").click(function(){
            $(".rozwiniete").slideDown("slow");
            $(".ukryj").show();
            $(".rozwin").hide();
        });
        $(".ukryj").click(function(){
            $(".rozwiniete").slideUp("slow");
            $(".ukryj").hide();
             $(".rozwin").show();
        });

        $(".rozwiniete2,.ukryj2").hide();
        $(".rozwin2").click(function(){
            $(".rozwiniete2").slideDown("slow");
            $(".ukryj2").show();
             $(".rozwin2").hide();
        });
        $(".ukryj2").click(function(){
            $(".rozwiniete2").slideUp("slow");
            $(".ukryj2").hide();
             $(".rozwin2").show();
        });


//karuzela
        $(document).ready(function() {        
                $('.karuzela').carousel()
            });

//modal
$(document).ready(function() {  
jQuery(function ($) {

                 $("#myModal").modal() 
            });});
$(document).ready(function() {  
jQuery(function ($) {

                 $("#modale,#modalkontakt").modal() 
            });});
$(document).ready(function() {  
jQuery(function ($) {

                 $("#modalkontakt").modal() 
            });});
//galeria

    (function() {
        var imgs = $('.images');
        $('.images img').hide()
        $.each(imgs, function(index, val) {
            $(val).children(":first").show();
            $('.thumbs button').on( "mouseenter", function(e) {
                 var idb = $(this).data("idb"),
                     set = $(this).parent().data("set");
                 $('body').find("[data-set='" + set + "']").children("img").hide();
                 imgs.find("[data-idi='" + idb + "']").show();
            });
        });
    })();
//tooltip
jQuery(function ($) {
        $("#twico>a,#fbico>a,#gplico>a,#skpico>a,#konico>a,.circle,.ikonybt").tooltip()
    }); 
 

//slider
$(function() {
                $('#ei-slider').eislideshow({
                    animation           : 'center',
                    autoplay            : true,
                    slideshow_interval  : 3000,
                    titlesFactor        : 0
                });
            });     


//browsers icons




    $("#kbrow").click(function(){
        $("#chrome").animate({"font-size":"1px"},1000)
        .animate({"margin-top":"120%"},1500,"easeOutBounce");
        $("#firefox").animate({"font-size":"1px"},2000)
        .animate({"margin-top":"30%"},1500,"easeOutBounce");
        $("#ie").animate({"font-size":"1px"},1500)
        .animate({"margin-top":"130%"},1500,"easeOutBounce");
        $("#opera").animate({"font-size":"1px"},2500)
        .animate({"margin-top":"90%"},1500,"easeOutBounce");
        $("#safari").animate({"font-size":"1px"},1000)
        .animate({"margin-top":"70%"},1500,"easeOutBounce");
        $(".txtbr").removeClass("hidden");
        //.animate({"margin-top":"120%"},1500);
    });
        
//droggable
$(function() {
    $( "#html5,#css3,#pehape,#jquery,#sublime,#bootstrap,#less,#phosh,#resp" ).draggable();
  });      

  // $('#html5')
  //    .css({ top: readCookie("palletteY")*1, left: readCookie("palletteX")*1 })
  //    .draggable({ stop: function (event, ui) {
  //        createCookie("palletteX", ui.position.left, 100);
  //        createCookie("palletteY", ui.position.top, 100);
  //    } }); 

//scroll
$('a.nawtop').click(function(){
    $('html,body').animate({
        scrollTop:0
    }, 1000, function(){
        parallaxScroll();
    });
    return false;
});

$('a.nawdruk').click(function(){
        $('html, body').animate({
            scrollTop:$('#divdrukowanie').offset().top
        }, 1000, function() {
            parallaxScroll(); // Callback is required for iOS
        });
        return false;
    });
$('a.nawzalety').click(function(){
        $('html, body').animate({
            scrollTop:$('#divzalety').offset().top
        }, 1000, function() {
            parallaxScroll(); // Callback is required for iOS
        });
        return false;
    });