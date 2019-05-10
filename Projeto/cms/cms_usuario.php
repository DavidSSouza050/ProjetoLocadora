<?php

    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    //pegando a conexão de outra pasta
   require_once('../db/conexao.php');
    $conexao = conexaoMysql(); 

    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    //chamando a função para validação
    $permissoes = consultarPermissoes();
    //validando usuario
    if($permissoes['conteudo'] == 0){
        header("Location: index.php");
    }

    //Atribuindo variaveis
    $nome_usuario_buscado = null;
    $email_usuario_buscado = null;
    $senha_usuario_buscado= null;
    $modo = 'novo';
    /*Será usada no select para buscar os estados, para trazer todos os estados diferentes de 0.
    para resolver p bug do editar  */ 
    $nivel_usuario = 0;
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
        //se a senha estivar vazia ela guanha vazio para validação
        $senha_usuario = $_POST['senha_usuario_cadastro'] == "" ? "" : trim(md5($_POST['senha_usuario_cadastro'])); 
        $nivel_usuario = trim($_POST['cmb_nivel_usuario']);
       

        if($_POST['botao_salvar_usuario'] == "Salvar"){ // ← Salvando o usuario 

            // verificando se existe aquele email cadastrado no banco (não pode haver mais de um)
            $sql = "SELECT cod_usuario, email from tbl_usuario WHERE email = '".$email_usuario."'";
            $select = mysqli_query($conexao, $sql);

            if($rsvalidarEmail = mysqli_fetch_array($select)){
                if($rsvalidarEmail['email'] == $email_usuario){
                    echo("<script>
                        alert('Não pode Haver o mesmo email para dois usuarios diferentes');
                        window.location.href = 'cms_usuario.php';
                    </script>");
                }

            }elseif($nome_usuario == "" || $email_usuario == "" || $email_usuario == "" || $senha_usuario == "" || $nivel_usuario == null){
                    echo("<script>
                        alert('Preancha todas as caixas corretamente');
                        window.location.href = 'cms_usuario.php';
                    </script>");
            }else{
                $sql = "INSERT INTO tbl_usuario (nome_usuario, email, senha, cod_nivel)
                VALUES  ('".$nome_usuario."', '".$email_usuario."', '".$senha_usuario."',".$nivel_usuario.");";

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
            
            


        }elseif($_POST['botao_salvar_usuario'] == "Editar"){// ← Editando o usuario se hover senha nova ou não o usuario 
           
            //verificando se o usuario não mudou a senha
            if($senha_usuario != ""){
                //fazendo update com senha
                $sql = "UPDATE tbl_usuario SET nome_usuario = '".$nome_usuario."', 
                                    email = '".$email_usuario."', 
                                    senha = '".$senha_usuario."',
                                    cod_nivel=".$nivel_usuario." 
                                    WHERE cod_usuario =".$_SESSION['idRegistro'];   
            }else{
                //fazendo update sem senha
                $sql = "UPDATE tbl_usuario SET nome_usuario = '".$nome_usuario."', 
                                    email = '".$email_usuario."', 
                                    cod_nivel=".$nivel_usuario." 
                                    WHERE cod_usuario =".$_SESSION['idRegistro'];   
            }
            
                                
            //     execulta o sql com a conexão e ver se ta tudo certo para colocar no banco
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
                

    }

    //pegando o modo para buscar ou excluir
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        //variavel de sessão
        $_SESSION['idRegistro'] = $id;
        if($modo == 'excluir'){ // deletando os usuairos
            if($permissoes['cod_logado'] != $id){
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
            }else{
                echo("<script>
                    alert('Você não pode excluir este usuario. Pois o mesmo está logado neste momento');
                    window.location.href = 'cms_usuario.php';
                </script>");
            }
            
        }elseif($modo == 'buscar'){// Buscando os usuairo os usuairos
            
            $sqlBusca = "SELECT usuario.*, nivel.cod_nivel, nivel.nome_nivel
            FROM tbl_usuario as usuario LEFT JOIN tbl_nivel_usuario as nivel
            ON usuario.cod_nivel = nivel.cod_nivel
            WHERE usuario.cod_usuario=".$id;
            $select = mysqli_query($conexao, $sqlBusca);

            if($rsUsuario = mysqli_fetch_array($select)){
                $nome_usuario_buscado = $rsUsuario['nome_usuario'];
                $email_usuario_buscado = $rsUsuario['email'];
                $senha_usuario_buscado = $rsUsuario['senha'];
                
                if($rsUsuario['cod_nivel'] != null){
                    $nivel_usuario = $rsUsuario['cod_nivel'];
                    $nivel = $rsUsuario['nome_nivel'];
                }else{
                    $nivel_usuario = 0;
                }
                $batao_salvar = 'Editar';
                $batao_limpar = 'Cancelar';
            }
            
        }

    }

    //atualizando os status do usuario (primeira pagina criada obs:coloquei como exemplo)
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $cod_usuario = $_GET['id'];
        
        if($permissoes['cod_logado'] != $cod_usuario){
            if($status == 0){
                $sql = "UPDATE tbl_usuario SET status = 1 WHERE cod_usuario =".$cod_usuario;
            }else{
                $sql = "UPDATE tbl_usuario SET status = 0 WHERE cod_usuario =".$cod_usuario;
            }
            
            if(mysqli_query($conexao, $sql)){
                header('Location: cms_usuario.php');
            }
        }else{
            echo("<script>
                alert('Você não pode desativar este usuario. Pois o mesmo está logado n este momento');
                window.location.href = 'cms_usuario.php';
            </script>");
        }
        

    }
    //atualizando os status do nivel (primeira pagina criada obs:coloquei como exemplo)
    if(isset($_SESSION['nivel_desativado'])){ 
        $slqVerficarNivel = "SELECT nivel.status
            FROM tbl_nivel_usuario as nivel JOIN tbl_usuario as usuario
            ON nivel.cod_nivel  = usuario.cod_nivel WHERE usuario.cod_nivel = ".$_SESSION['cod_nivel']; ;

        $select = mysqli_query($conexao,$slqVerficarNivel);
        if($rsNivleDesativida = mysqli_fetch_array($select)){
            if($rsNivleDesativida['status'] == 0){
             
                $sql = "UPDATE tbl_usuario set status = 0  WHERE cod_nivel = ".$_SESSION['cod_nivel'];    

                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_usuario.php');
                    unset($_SESSION['nivel_desativado']);
                    unset($_SESSION['cod_nivel']);
                }        
            }elseif($rsNivleDesativida['status'] == 1){
                $sql = "UPDATE tbl_usuario set status = 1  WHERE cod_nivel = ".$_SESSION['cod_nivel'];    

                if(mysqli_query($conexao, $sql)){
                    header('Location: cms_usuario.php');
                    unset($_SESSION['nivel_desativado']);
                    unset($_SESSION['cod_nivel']);
                }    
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
                    url: "./modais/cms_modal_usuario.php",
                    data:{codigo:idUsuario},
                    success: function(dados){
                        //alert(dados);
                        $('#modal').html(dados);
                    }

                });
            };

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
                            Nome: <input type="text" value="<?php echo($nome_usuario_buscado)?>" maxLength='40'  class="caixa_usuario" name="nome_usuario_cadastro" id="nome_usuario_cadastro">
                        </div>
                        <div class="segura_caixa_usuario" >
                            Email: <input type="email" value="<?php echo($email_usuario_buscado)?>" maxLength='90' class="caixa_usuario" name="email_usuario_cadatro" id="email_usuario_cadatro">
                        </div>
                        <div class="segura_caixa_usuario" >
                            Senha: <input type="password"  maxLength='10' class="caixa_usuario" name="senha_usuario_cadastro" id="senha_usuario_cadastro">
                        </div>
                        <!-- select para escolher um Nivel para o usuario -->
                        <select  id="cmb_nivel_usuario" name="cmb_nivel_usuario">   
                            <?php

                                if($nivel_usuario != 0){
                            ?>
                                <option value="<?php echo($nivel_usuario)?>"><?php echo($nivel)?></option>
                            <?php
                                }else{
                            ?>
                                <option value="null">Nivel</option>
                            <?php 
                                }
                                $sql = "SELECT * from tbl_nivel_usuario WHERE cod_nivel <> ".$nivel_usuario." AND status <> 0
                                 ORDER BY cod_nivel";
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
                            <input type="submit" class="botao_cadastro_usuario" name="botao_limpar_usuario" value="<?php echo($batao_limpar)?>">
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
                           $sql = "SELECT usuario.*, nivel_usuario.nome_nivel, nivel_usuario.status as nivel_status
                                        FROM tbl_usuario AS usuario LEFT JOIN tbl_nivel_usuario AS nivel_usuario
                                          ON usuario.cod_nivel = nivel_usuario.cod_nivel;";
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
                            
                                <a href="?status=<?php echo($rsUsuarios['status'])?>&id=<?php echo($rsUsuarios['cod_usuario'])?>">    
                                    <?php
                                        $imgStatus = $rsUsuarios['status'] == 0 ? 'icon_nao_ativo.png' : 'icon_ativo.png';
                                        $altEtitle = $rsUsuarios['status'] == 0 ? 'Não ativo' : 'ativo';  
                                    ?>
                                    <img src="./img/<?php echo($imgStatus)?>" class="icon img-size" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">
                                    
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