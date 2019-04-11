<?php
    //Ativa o recurso de variavel de sessão
    session_start();
    //pegando a conexão de outra pasta
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();

    //Atribuindo variaveis
    $nome_usuario = null;
    $email_usuario = null;
    $senha_usuario = null;
    $nivel_usuario = null;
    $batao_salvar = 'Salvar';
    $batao_limpar = 'Limpar';

    if(isset($_POST['botao_limpar_usuario'])){
        header('Location: cms_usuario.php');
    }


    //cadastrar usuario
    if(isset($_POST['botao_salvar_usuario'])){
        // atribuindo caixas as variaveis
        $nome_usuario = trim($_POST['nome_usuario_cadastro']);
        $email_usuario = trim($_POST['email_usuario_cadatro']);
        $senha_usuario = trim($_POST['senha_usuario_cadastro']);
        $nivel_usuario = trim($_POST['cmb_nivel_usuario']);

        if($_POST['botao_salvar_usuario'] == "Salvar"){
            // execultando sql
            $sql = "INSERT INTO tbl_usuario (nome_usuario, email, senha, cod_nivel)
            VALUES  ('".$nome_usuario."', '".$email_usuario."', '".$senha_usuario."',".$nivel_usuario.");";
        }elseif($_POST['botao_salvar_usuario'] == "Editar"){
            $sql = "UPDATE tbl_usuario SET nome_usuario = '".$nome_usuario."', 
                                            email = '".$email_usuario."', 
                                            senha = '".$senha_usuario."' 
                                            WHERE cod_usuario =".$_SESSION['idRegistro'];
        }
        
        // echo($sql);
             // execulta o sql com a conexão e ver se ta tudo certo para colocar no banco
        if(mysqli_query($conexao, $sql)){
        /*Redireciona para uma nova pagina*/
            header("Location: cms_usuario.php");

        }else{
            // se não der certo mostra essa mensagem
            echo("
                <script>
                    alert('erro no Cadastro');
                </script>
            ");
        }         

    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        //variavel de sessão
        $_SESSION['idRegistro'] = $id;
        if($modo == 'excluir'){
            $sqlDelete = "DELETE FROM tbl_usuario WHERE cod_usuario= ".$id;

            if(mysqli_query($conexao, $sqlDelete)){
                /*Redireciona para uma nova pagina*/
                header("Location: cms_usuario.php");

            }else{
                // se não der certo mostra essa mensagem
                echo("
                    <script>
                        alert('erro na exclusão');
                    </script>
                ");
            }         
        }elseif($modo == 'buscar'){
            $sqlBusca = "SELECT * FROM tbl_usuario WHERE cod_usuario=".$id;
            $select = mysqli_query($conexao, $sqlBusca);

            if($rsUsuario = mysqli_fetch_array($select)){
                $nome_usuario = $rsUsuario['nome_usuario'];
                $email_usuario = $rsUsuario['email'];
                $senha_usuario = $rsUsuario['senha'];
                
                $batao_salvar = 'Editar';
                $batao_limpar = 'Cancelar';
            }
            
        }

    }

    /*************************+++********************************************* */


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

            function visualizarUsuario(idUsuario){
                $.ajax({
                    type: "GET",
                    url: "cms_modal_usuario.php",
                    data:{codigo:idUsuario},
                    success: function(dados){
                        //alert(dados);
                        $('#modal').html(dados);
                    }

                });
            };

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
                            <img class="img-size" src="./img/icone_sair.png" alt="sair da modal" title="sair da modal">
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
                
                <a href="cms_criar_nivel.php">
                    <div id="menu_cadastro_nivel">
                        Cadastrar Nivel 
                    </div>
                </a>
            

                <!-- card que segura o a griação do usuario -->
                <div id="card_criar_usuario">
                    <form name="frm_criar_usuario" method="POST" action="cms_usuario.php" >
                        <!-- caixa para alinhar as input  -->
                        <div class="segura_caixa_usuario">
                            Nome: <input type="text" value="<?php echo($nome_usuario)?>" class="caixa_usuario" name="nome_usuario_cadastro" id="nome_usuario_cadastro">
                        </div>
                        <div class="segura_caixa_usuario" >
                            Email: <input type="email" value="<?php echo($email_usuario)?>" class="caixa_usuario" name="email_usuario_cadatro" id="email_usuario_cadatro">
                        </div>
                        <div class="segura_caixa_usuario" >
                            Senha:<input type="text" value="<?php echo($senha_usuario)?>" class="caixa_usuario" name="senha_usuario_cadastro" id="senha_usuario_cadastro">
                        </div>
                        
                        <!-- select para escolher um Nivel para o usuario -->
                        <select  id="cmb_nivel_usuario" name="cmb_nivel_usuario">    
                            <option value="null">Nivel</option>
                            <?php 
                                $sql = "SELECT * from tbl_nivel_usuario;";
                                $select = mysqli_query($conexao, $sql);
                            
                                while($rsNivelUsuario = mysqli_fetch_array($select)){
                            ?>
                            <option value="<?php echo($rsNivelUsuario['cod_nivel']);?>"><?php echo($rsNivelUsuario['nome_nivel']);?></option>
                            <?php 
                            }                            
                            ?>
                        </select>

                        <div id="segura_botao_criar_usuario" >
                            <input type="submit" class="botao_cadastro_usuario" id="botao_salvar_usuario" name="botao_salvar_usuario" value="<?php echo($batao_salvar)?>">
                            <input type="submit" class="botao_cadastro_usuario" id="botao_limpar_usuario" name="botao_limpar_usuario" value="<?php echo($batao_limpar)?>">
                        </div>
                    </form>
                </div>
                
                <div id="segura_tabela_usuario">
                   
                    <table id="table_usuarios" class="center">
                    
                        <tr id="thead_usuario">
                            <td>
                                Nome
                            </td>
                            <td>
                                Email
                            </td>
                            <td>
                                Nivel
                            </td>
                            <td>
                                Opções
                            </td>
                        </tr>
                        <?php
                            // PEGANDO TODOS OS CAMPOS DAS TABELAS DE USUARIO E NIVEL
                           $sql = "SELECT *
                                        FROM tbl_usuario AS u LEFT JOIN tbl_nivel_usuario AS n
                                          ON u.cod_nivel = n.cod_nivel;";
                            // execultando no mysql
                            $select= mysqli_query($conexao, $sql);
                        
                            // transformando em uma array para colocar na frame
                            while($rsUsuarios = mysqli_fetch_array($select)){
                               
                        ?>
                        <tr class="tbody_usuario">
                            <td>
                                <?php echo($rsUsuarios['nome_usuario'])?>
                            </td>
                            <td>
                                <?php echo($rsUsuarios['email'])?>
                            </td>
                            <td>
                                <?php echo($rsUsuarios['nome_nivel'] == '' ? 'Não tem nivel' : $rsUsuarios['nome_nivel'])?>
                            </td>
                            <td>

                                <img  src="./img/icon_view.png" onclick="visualizarUsuario(<?php echo($rsUsuarios['cod_usuario'])?>)" class="icon img-size visualizar" alt="visualização">                        

                                <a href="?modo=buscar&id=<?php echo($rsUsuarios['cod_usuario']);?>"> 
                                    <img  src="./img/icon_edit.png" class="icon img-size" alt="Edição">
                                </a>

                                <a href="?modo=excluir&id=<?php echo($rsUsuarios['cod_usuario']);?>">
                                    <img  src="./img/icon_delete.png" class="icon img-size" alt="Deletar" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsUsuarios['nome_usuario']);?>')">
                                </a>

                                
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>

                </div>

            </div>


            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>