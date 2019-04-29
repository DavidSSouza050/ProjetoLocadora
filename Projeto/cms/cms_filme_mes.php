<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>CMS - SISTEMA DE GERENCIAMENTO DO SITE</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./css/styleCms.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleFonte.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <link rel="shortcut icon" href="../img/iconeDeAbaACME.png" type="image/x-png">
        <script src="../js/jquery-1.11.3.min.js"></script>
        <script>
            //desativando modal
            $(document).ready(function(){
                $('#fachar_modal_fale_conosco').click(function(){
                    $('#conteiner').fadeOut(300);
                });
            });
            // ativando modal
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#conteiner').fadeIn(300);
                });
            });

//          cadastrando um ator
            function cadastrarEvisualizarator(modo, codigo){
                $.ajax({
                    type: "GET",
                    url: "./modais/cms_modal_cadastrar_ator.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    }

                });
            }
//          atribuindo um filme a um ator
            function colocarAtor_filme(modo, codigo_ator){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_colocar_ator_filme.php",
                    data:{modo:modo, codigo_ator:codigo_ator},
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    },
                })
            }
//             ativando e desativando ator
            function ativarDesativar(pagina, status, codigo){
                $.ajax({
                    type:'GET',
                    url: "./util/ativar_desativar.php",
                    data:{pagina:pagina, status:status, codigo:codigo},
                    complete: function(response){
                        location.reload();
                    },
                })
            }

        
        </script>

    </head>
    <body>
        <!-- cnotender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner">
            <!-- div com o objetivo de fechar a modal -->
            <div id="segurar_fechar_modal" class="center">
                <figure>
                    <div id="fechar_modal">
                        <a href="#" class="img-size" id="fachar_modal_fale_conosco">
                            <img   class="img-size" src="./img/icone_sair.png" alt="sair da modal" title="sair da modal">
                        </a>
                    </div>
                </figure>
            </div>
            <!-- modal que vai suportar tudo o conteudo -->
            <div id="modal_larga" class="center">
                
            </div>
        </div>

        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
            
        
           
            <!-- conteudo do menu do cms -->
            <div id="conteudo_paginas_conteudo">
               <!-- card e vai mostrar os filmes cadastrados -->
                <div id="card_filme_mes" class="center">
                    <figure>
                        <div id="img_filme_mes">
                            <img src="./img/gerenciar_ator.png" class="img-size" alt="gerenciar ator">
                        </div>
                    </figure>
                    
                    <div id="atributos_filme_mes">
                        <div id="titulo_filme_mes">
                            Vingadores: Ultimato 
                        </div>
                        <div class="segura_atributos_filme">

                        </div>
                        <div class="segura_atributos_filme">

                        </div>
                    </div>

                </div>

            </div>

            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>

            
    </body>
</html>