$(document).ready(function(){

    //ação click do menu
    $('.segura_menu_mobile').click(function(){
        $('#ul_menu_mobile').slideToggle(500);
        $('#open_categoria').css({"display":"none"});
        $('.segura_menu_mobile').css({"display":"none"});
        $('.fecha_menu').css({"display":"block"});
    });

    $('.fecha_menu').click(function(){
        $('#ul_menu_mobile').slideToggle(500);
        $('.segura_menu_mobile').css({"display":"block"});
        $('.fecha_menu').css({"display":"none"});
        setTimeout(
            function(){
                $('#open_categoria').css({"display":"block"})
            },300);
            
    });

    $('.link_menu').click(function(){
        $('#ul_menu_mobile').slideToggle(300);
    });

    
});

