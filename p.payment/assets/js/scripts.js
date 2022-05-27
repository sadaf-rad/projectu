$(document).ready(function(){


    $("#m-menu li button").click(function() {
      
        if($(this).hasClass('active')){
            $(this).parent().find('ul').slideUp();
            $(this).removeClass('active');
        } else {
            $("#m-menu li button").removeClass('active');
            $(this).addClass('active');
            $("#m-menu ul ul").slideUp();
            $(this).parent().find('ul').slideDown();
        }
    
      
    })
    
$("#menu").click(function() {
    $(".back-drop").show();
    $(".mmenu").removeClass('active');
    $("#m-menu").addClass('active');
    $(".m-footer").removeClass('active');
})

$("#search").click(function() {
    $(".back-drop").show();
    $(".mmenu").removeClass('active');
    $("#m-search").addClass('active');
    $(".m-footer").removeClass('active');
})


$("#basket").click(function() {
    $(".back-drop").show();
    $(".mmenu").removeClass('active');
    $("#m-basket").addClass('active');
    $(".m-footer").removeClass('active');
})


$("#user").click(function() {
    $(".back-drop").show();
    $(".mmenu").removeClass('active');
    $("#m-user").addClass('active');
    $(".m-footer").removeClass('active');
})

$(".back-drop , .close-mmenu").click(function() {
    $(".back-drop").hide();
    $(".mmenu").removeClass('active');
    $(".m-footer").addClass('active');
})




    $("#special-slider").owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                nav:false,
            
            }
        }
    });
    $(".category-slider").owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:true,
                margin:20,
            },
            600:{
                items:3,
                nav:false,
                margin:10,
            },
            1000:{
                items:5,
                nav:false,
                margin:25,
            
            }
        }
    });
    $("#main-slider").owlCarousel({
        loop:true,
        margin:0,
        items:1
    });

  });