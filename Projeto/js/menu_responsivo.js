$(document).ready(function(){
    //ação click do menu
    $('.segura_menu_mobile').click(function(){
        $('#ul_menu_mobile').slideToggle(500);
    });

    $('.link_menu').click(function(){
        $('#ul_menu_mobile').slideToggle(300);
    });
});

