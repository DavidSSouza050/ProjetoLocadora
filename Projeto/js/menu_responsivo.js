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
        $('.segura_menu_categoria').css({"transform":"translateX(0)"});
        $('.menublock').css({"display":"block"});
        $('html body').css({"overflow":"hidden"});
    });

    //fechar o menu de categoria
    $('.fechar_menu_mobile').click(function(){
        $('.segura_menu_categoria').css({"transform":"translateX(-100%)"});
        $('.menublock').css({"display":"none"});
        $('html body').css({"overflow":"auto"});
    });
    //fechar menu na base do click na categoria
    $('.segura_categoria_item').click(function(){
        $('.segura_menu_categoria').css({"transform":"translateX(-100%)"});
        $('.menublock').css({"display":"none"});
        $('html body').css({"overflow":"auto"});
    });
    //fechar menu na base do click na subcategoria
    $('.subcategoria_item').click(function(){
        $('.segura_menu_categoria').css({"transform":"translateX(-100%)"});
        $('.menublock').css({"display":"none"});
        $('html body').css({"overflow":"auto"});
    });

    //submenu mobile
    $(document).on('click','.aparece_subcategoria_mobile', function(){
        if($(this).parent().find('.segura_subcategoria').hasClass('esconder_subMenu_mobile')){
             $(this).parent().find('.segura_subcategoria').removeClass('esconder_subMenu_mobile');
             $(this).parent().find('.segura_subcategoria').addClass('mostrar_subMenu_mobile');
             $(this).css({"transform":"rotate(-90deg)"});
             $(this).parent().find('.subcategoria_item').removeClass('displayNome');
         }else{
             $(this).parent().find('.segura_subcategoria').removeClass('mostrar_subMenu_mobile');
             $(this).parent().find('.segura_subcategoria').addClass('esconder_subMenu_mobile');
             $(this).css({"transform":"rotate(0deg)"});
             $(this).parent().find('.subcategoria_item').addClass('displayNome');
        }
     });


    //submenu desktop
    $(document).on('click','.aparece_subCategoria', function(){
       if($(this).parent().find('ul').hasClass('esconder_subMenu')){
            $(this).parent().find('ul').removeClass('esconder_subMenu');
            $(this).parent().find('ul').addClass('mostrar_subMenu');
            $(this).css({"transform":"rotate(-90deg)"});
            $(this).css({"margin-right":"5px"});
        }else{
            $(this).parent().find('ul').removeClass('mostrar_subMenu');
            $(this).parent().find('ul').addClass('esconder_subMenu');
            $(this).css({"margin-right":"0px"});
            $(this).css({"transform":"rotate(0deg)"});
       }
    });
    
    //barra de pesquisa mobile

    $(document).on('click', '.btnBusca', function(){
        if($(this).parent().find('.barraPesquisa_mobile').hasClass('escondeBarraPesquisa_mobile')){
            $(this).parent().find('.barraPesquisa_mobile').animate({width: '820px'});
            $(this).parent().find('.barraPesquisa_mobile').removeClass('escondeBarraPesquisa_mobile');
        }else{
            $(this).parent().find('.barraPesquisa_mobile').animate({width: '0px'});
            $(this).parent().find('.barraPesquisa_mobile').addClass('escondeBarraPesquisa_mobile');
        }
    });
    



});