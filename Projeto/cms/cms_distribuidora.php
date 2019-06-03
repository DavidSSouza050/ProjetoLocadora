<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    //chamando a função para validação
    $permissoes = consultarPermissoes();
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();

    if($permissoes['produtos'] == 0){
        header("Location: index.php");
    }
    //variaveis
    $btn_distribuidora = 'Cadastrar';
    $btn_limpar = 'Limpar';
    $distribuidora = null;

    if(isset($_POST['btn_limpar'])){
        header('Location: cms_distribuidora.php');
    }

    if(isset($_POST['Cadastrar_distribuidora'])){
        $distribuidora = trim($_POST['nome_distribuidora']);

        if($distribuidora != ""){
            $sql = "INSERT INTO tbl_ditribuidora (distribuidora) 
                            VALUES ('".addslashes($distribuidora)."')";

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_produtos.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_distribuidora.php';</script>");
        }
        
            

    }elseif(isset($_POST['Atualizar_distribuidora'])){
        $distribuidora = trim($_POST['nome_distribuidora']);

        if($distribuidora != ""){
            $sql = "UPDATE tbl_ditribuidora SET distribuidora ='".addslashes($distribuidora)."'
                                            WHERE cod_distribuidora = ".$_SESSION['cod_distribuidora'];

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_distribuidora.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_distribuidora.php';</script>");
        }
    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];

        if($modo == 'excluir'){

            $sql = "SELECT filme.cod_distribuidora as cod_distri_filme,
                        distribuidora.cod_distribuidora as cod_distri_distribuidora
                        FROM tbl_filme as filme right JOIN tbl_ditribuidora as distribuidora
                        ON filme.cod_distribuidora = distribuidora.cod_distribuidora 
                        WHERE distribuidora.cod_distribuidora = ".$codigo;
            $select = mysqli_query($conexao, $sql); 

            if($rsDistribuidoraExcluir = mysqli_fetch_array($select)){
                if($rsDistribuidoraExcluir['cod_distri_filme'] != null){
                    echo("<script>alert('Está distribuidora esta relacionada com um filme, Não pode excluir-la.')</script>");
                    echo("<script>window.location='cms_distribuidora.php';</script>");
                }else{
                    $sqlDeletar = "DELETE FROM tbl_ditribuidora WHERE cod_distribuidora = ".$codigo;
                    
                    if(mysqli_query($conexao, $sqlDeletar)){
                        header('Location: cms_distribuidora.php');
                    }else{
                        echo($sqlDeletar);
                    }
                }
            }

        }elseif($modo == 'editar'){
            
            $sql = "SELECT cod_distribuidora, distribuidora FROM tbl_ditribuidora WHERE cod_distribuidora = ".$codigo;
            $select = mysqli_query($conexao, $sql);

            if($rsEditar = mysqli_fetch_array($select)){
                $distribuidora = $rsEditar['distribuidora'];

                $btn_distribuidora = 'Atualizar';
                $btn_limpar = 'Cancelar';
                $_SESSION['cod_distribuidora'] = $rsEditar['cod_distribuidora'];
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

    </head>
    <body>
       
        <div id="segura_cadastro_distribuidora">
            <figure>
                <div id="sair_distribuidora">
                    <a href="cms_produtos.php">
                        <img src="./img/icone_voltar.png" class="img-size" alt="Volta" title="Voltar">
                    </a>
                </div>
            </figure>
            <div id="cadastro_distribuidora">
                <form name="frm_distribuidora" method="POST" action="cms_distribuidora.php">
                    <h3>Distribuidora</h3>
                    <input type="text" value="<?=$distribuidora?>"id="text_distribuidora" maxlength="45" name="nome_distribuidora">

                    <div id="segura_botao_ator">
                        <input type="submit" value="<?php echo($btn_distribuidora);?>" name="<?php echo($btn_distribuidora.'_distribuidora');?>" id="cadastrar_produto" class="botao_cadastro_usuario"> 
                        <input type="submit" value="<?php echo($btn_limpar);?>" name="btn_limpar" id="cadastrar_produto" class="botao_cadastro_usuario"> 
                    </div>
                <form>
            </div>

            <div id="segura_cadastrados" class="scrollTexto">
                <table id="table_modal_nivel">
                    <tr id="thead">
                        <td>
                            Distribuidora
                        </td>
                        <td>
                            Opcões
                        </td>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_ditribuidora";
                        $select = mysqli_query($conexao, $sql);
                        while($rsDistribuidora = mysqli_fetch_array($select)){
                    ?>
                    <tr class="tbody">
                        <td>
                            <?= $rsDistribuidora['distribuidora']?>
                        </td>
                        <td>
                            <a href="?modo=editar&id=<?=$rsDistribuidora['cod_distribuidora']?>">
                                <img src="./img/icon_edit.png" alt="Editar" title="Editar" class="icon img-size">
                            </a>
                            <a href="?modo=excluir&id=<?=$rsDistribuidora['cod_distribuidora']?>">
                                <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsDistribuidora['distribuidora']);?>')" alt="Deletar"  title="Deletar" class="icon img-size">
                            </a>    
                        </td>
                    </tr>
                    <?php
                        }
                    ?>

                </table>
            </div>

        </div>


    </body>
</html>