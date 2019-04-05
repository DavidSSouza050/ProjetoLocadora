<?php
    //pegando a conexão de outra pasta
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();


    //ação que excluir um registro 
    if(isset($_GET['modo'])){
        //variaveis mandadas pelo href
        $modo = $_GET['modo'];
        $id = $_GET['id'];

        //excluindo um registro
        if($modo == 'excluir'){
            $sqlDelete = "DELETE FROM tbl_fale_conosco WHERE codigo = ".$id;

            if(mysqli_query($conexao, $sqlDelete)){
                header('Location: cms_fale_conosco.php');
            }else{
                echo(
                    "<script>
                        alert('falha na exclusão');
                    </script>"

                );
            }
        }

    }
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
            function visualizardados(idContato){
                $.ajax({
                    type: "GET",
                    url: "cms_modal_fale_conosco.php",
                    data:{codigo:idContato},

                    success: function(dados){
                        $('#modal').html(dados);
                    }

                });
            }
        
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
            <div id="menu_de_adm">
               
                <table id="cms_table_fale_conosco" class="center">
                    <tr id="cms_thead">
                        <td>
                            NOME
                        </td>
                        <td>
                            EMAIL
                        </td>
                        <td>
                            CELULAR
                        </td>
                        <td>
                            OPÇÔES
                        </td>
                    </tr>    

                    <?php 
                        $sql = "SELECT * FROM tbl_fale_conosco";
                        //Guardando o retor do sql em uma variavel local
                        $select = mysqli_query($conexao, $sql);


                        while($rsContatos = mysqli_fetch_array($select)){
                    
                    ?>

                    <tr id="cms_tbody">
                        <td>
                           <?php echo($rsContatos['nome']);?>
                        </td>
                        <td>
                            <?php echo($rsContatos['email']);?>
                        </td>
                        <td>
                            <?php echo($rsContatos['celular']);?>
                        </td>
                        <td>
                           
                            <img  src="./img/icon_view.png" onclick="visualizardados(<?php echo($rsContatos['codigo']);?>)" class="icon img-size visualizar" alt="visualização">
                            
                            <a href="cms_fale_conosco.php?modo=excluir&id=<?php echo($rsContatos['codigo']);?>">
                                <img  src="./img/icon_delete.png" class="icon img-size" alt="Deletar" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsContatos['nome']);?>')">
                            </a>

                        </td>
                    </tr>
                    
                    
                    <?php
                        }
                    ?>
                
                </table>
            

            </div>








            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>