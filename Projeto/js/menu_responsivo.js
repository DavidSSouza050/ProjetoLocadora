$(document).ready(function(){

    //ação click do menu para abrir
    $('.segura_menu_mobile').click(function(){
        $('#ul_menu_mobile').slideToggle(500);
        $('#open_categoria').css({"display":"none"});
        $('.segura_menu_mobile').css({"display":"none"});
        $('.fecha_menu').css({"display":"block"});
    });

    //ação click do menu para fechar
    $('.fecha_menu').click(function(){
        $('#ul_menu_mobile').slideToggle(500);
        $('.segura_menu_mobile').css({"display":"block"});
        $('.fecha_menu').css({"display":"none"});
        setTimeout(
            function(){
                $('#open_categoria').css({"display":"block"})
            },300);

    });

    //fechar menu au click do link
    $('.link_menu').click(function(){
        $('#ul_menu_mobile').slideToggle(300);
    });

    //abre o menu de categoria
    $('#open_categoria').click(function(){
        $('.segura_categoria').css({"transform":"translateX(0)"});
        $('.tampa_menu').css({"display":"block"});
        $('html body').css({"overflow":"hidden"});
    });

    //fechar o menu de categoria
    $('.fecha_categoria').click(function(){
        $('.segura_categoria').css({"transform":"translateX(-100%)"});
        $('.tampa_menu').css({"display":"none"});
        $('html body').css({"overflow":"auto"});
    });


    $('.categoria_item').click(function(){
        $('.categoria_item').css({"transform":"translateX(-110%)"});
        $('.segura_subCategoria').css({"transform":"translateX(60%)"});
        $('.segura_subCategoria').css({"transition-delay":"400ms"});
        $('.categoria_item').css({"transition-delay":"0ms"});

    });

    $(document).on('click','.fecha_subcategoria', function(){
        $('.segura_subCategoria').css({"transform":"translateX(-110%)"});
        $('.categoria_item').css({"transform":"translateX(0%)"});
        $('.segura_subCategoria').css({"transition-delay":"0ms"});
        $('.categoria_item').css({"transition-delay":"500ms"});
        // $('.segura_subCategoria').css({"display":"none"});
    });

});