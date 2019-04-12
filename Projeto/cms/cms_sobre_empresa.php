<?php
    //pegando a conexão de outra pasta
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
            // function visualizardados(idContato){
            //     $.ajax({
            //         type: "GET",
            //         url: "cms_modal_fale_conosco.php",
            //         data:{codigo:idContato},

            //         success: function(dados){
            //             $('#modal').html(dados);
            //         }

            //     });
            // }
        
        </script>

    </head>
    <body>
        <!-- cnotender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner">
            <!-- div vom o objetivo de fechar a modal -->
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
            <div id="modal" class="center">
                
            </div>
        </div>

        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
            
        
            <!-- conteudo do menu do cms -->
            <div id="conteudo_sobre_empresa">
                <!-- caixa que vai conter outras paginas relacionadas sobre a empresa                 -->
                <div id="menu_sobre_empresa_cadastros">
                    <a href="cms_cadastrar_sobre.php">    
                        <div class="itens_menu_sobre_empresa">
                            Cadastrar sobre
                        </div>      
                    </a>
                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_de_sobre_empresa">
                    <table id="table_sobre_empresa">
                        <tr id="thead_sobre_empresa">
                            <td>
                                Titulo
                            </td>
                            <td>
                                Opções
                            </td>
                        </tr>
                        
                        <tr class="tbody_sobre_empresa">
                            <td>
                                Sobre nós
                            </td>
                            <td>
                               
                                <img  src="./img/icon_view.png" onclick="visualizarUsuario(<?php echo($rsUsuarios['cod_usuario'])?>)" class="icon img-size visualizar" alt="visualização">                        

                             
                                <img  src="./img/icon_edit.png" class="icon img-size" alt="Edição">
                            
    
                                <img  src="./img/icon_delete.png" class="icon img-size" alt="Deletar">
                            

                                <img src="./img/icon_ativo.png" class="icon img-size" alt="Ativo" title="ativo">

                            </td>
                        </tr>

                    </table>
                </div>
                
            </div>

            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>