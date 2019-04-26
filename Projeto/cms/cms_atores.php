<?php   
    //varivel de sessão
    session_start();
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();



?>

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
            $(document).ready(function(){
                $('#fachar_modal_fale_conosco').click(function(){
                    $('#conteiner').fadeOut(300);
                });
            });

            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#conteiner').fadeIn(300);
                });
            });

            function cadastrarEvisualizarator(){
                $.ajax({
                    type: "GET",
                    url: "./modais/cms_modal_cadastrar_ator.php",
                 
                    success: function(dados){
                        $('#modal_larga').html(dados);
                    }

                });
            }

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
                <!-- caixa que vai conter outras paginas relacionadas sobre a empresa                 -->
                <div id="menu_card_cadastro">
                    
                    <div class="itens_card_cadastro visualizar" onclick="cadastrarEvisualizarator()">
                        Cadastrar ator
                    </div>      
                    <div class="itens_card_cadastro visualizar" onclick="cadastrarEvisualizarloja('Cadastrar', 0)">
                        Adicionar filme
                    </div>      

                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_conteudo">
                
                
                    <div class="card_ator center">
                        <figure>
                            <div class="imagem_ator">
                                <img src="./img/gerenciar_filme.png" class="img-size" alt="não sei">
                            </div>
                        </figure>
                        
                        <div class="nome_ator">

                        </div>
                        
                        <figure>
                            <div class="caixa_opcoes">
                                <img src="./img/gerenciar_filme.png" class="img-size" alt="não sei">
                            </div>
                        </figure>
                        
                        <figure>
                            <div class="caixa_opcoes">
                                <img src="./img/gerenciar_filme.png" class="img-size" alt="não sei">
                            </div>
                        </figure>

                        <figure>
                            <div class="caixa_opcoes">
                                <img src="./img/gerenciar_filme.png" class="img-size" alt="não sei">
                            </div>
                        </figure>    

                    </div>
                
                
                </div>
            </div>

            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>

            
    </body>
</html>