$(document).ready(function(){
    <!--menus-->
        $(".sub ul li").click(function(){

        $(this).children("ul").slideToggle("fast");
    });

        $("#xsmenu").click(function(){
        $(this).children("ul").slideToggle("fast");
    });

    $("#xsmenu").click(function(){
    $("#main").animate({left:'-200px'});
 	$("#black").css("display","block");
    $(".top-menu-xs").css("display","block");
    $(".top-menu-xs").animate({right:'0%'});


    });
    $("#black,.removeicon").click(function(){
    $("#main").animate({left:'0px'});
    $("#black").css("display","none");
    $(".top-menu-xs").animate({right:'-200px'});
    $(".search-box").animate({width:'0px',height:'0px',margin:'20% 50%'},[,'fast']);
    });
    <!--menus-->

});