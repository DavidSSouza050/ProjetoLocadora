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
    $btn_diretor = 'Cadastrar';
    $diretor = null;

    //cadastrar diretor
    if(isset($_POST['Cadastrar_diretor'])){
        $diretor = trim($_POST['nome_diretor']);

        if($diretor != ""){
            $sql = "INSERT INTO tbl_diretor (diretor) 
                            VALUES ('".addslashes($diretor)."')";

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_produtos.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_diretor.php';</script>");
        }
        
            

    }elseif(isset($_POST['Atualizar_diretor'])){
        $diretor = trim($_POST['nome_diretor']);

        if($diretor != ""){
            $sql = "UPDATE tbl_diretor SET diretor ='".addslashes($diretor)."'
                                            WHERE cod_diretor = ".$_SESSION['cod_diretor'];

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_diretor.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_diretor.php';</script>");
        }
    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];
        //modos de exclusão e edição do diretor
        if($modo == 'excluir'){

            $sql = "SELECT filme.titulo_filme as filme_titulo,
                    filme.cod_filme as filme,
                    diretor.cod_diretor as cod_diretor
                    FROM tbl_filme as filme right JOIN tbl_filme_diretor as filme_diretor
                    ON filme.cod_filme = filme_diretor.cod_filme inner JOIN tbl_diretor as diretor
                    ON filme_diretor.cod_diretor = diretor.cod_diretor 
                    WHERE diretor.cod_diretor =".$codigo;
            $select = mysqli_query($conexao, $sql); 

            if($rsDistribuidoraExcluir = mysqli_fetch_array($select)){
                if($rsDistribuidoraExcluir['cod_distri_filme'] != null){
                    echo("<script>alert('Este diretor esta relacionada com um filme, Não pode excluir-la.')</script>");
                    echo("<script>window.location='cms_diretor.php';</script>");
                }else{
                    $sqlDeletar = "DELETE FROM tbl_diretor WHERE cod_diretor = ".$codigo;
                    
                    if(mysqli_query($conexao, $sqlDeletar)){
                        header('Location: cms_diretor.php');
                    }else{
                        echo($sqlDeletar);
                    }
                }
            }

        }elseif($modo == 'editar'){
            
            $sql = "SELECT cod_diretor, diretor FROM tbl_diretor WHERE cod_diretor = ".$codigo;
            $select = mysqli_query($conexao, $sql);

            if($rsEditar = mysqli_fetch_array($select)){
                $diretor = $rsEditar['diretor'];

                $btn_diretor = 'Atualizar';
                $_SESSION['cod_diretor'] = $rsEditar['cod_diretor'];
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
                <form name="frm_direto" method="POST" action="cms_diretor.php">
                    <h3>Diretor</h3>
                    <input type="text" value="<?=$diretor?>" id="text_distribuidora" maxlength="45" name="nome_diretor">

                    <div id="segura_botao_ator">
                        <input type="submit" value="<?php echo($btn_diretor);?>" name="<?php echo($btn_diretor.'_diretor');?>"  class="botao_cadastro_usuario"> 
                    </div>
                <form>
            </div>

            <div id="segura_cadastrados" class="scrollTexto">
                <table id="table_modal_nivel">
                    <tr id="thead">
                        <td>
                            Diretor
                        </td>
                        <td>
                            Opcões
                        </td>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_diretor";
                        $select = mysqli_query($conexao, $sql);
                        while($rsDiretor = mysqli_fetch_array($select)){
                    ?>
                    <tr class="tbody">
                        <td>
                            <?= $rsDiretor['diretor']?>
                        </td>
                        <td>
                            <a href="?modo=editar&id=<?=$rsDiretor['cod_diretor']?>">
                                <img src="./img/icon_edit.png" alt="Editar" title="Editar" class="icon img-size">
                            </a>
                            <a href="?modo=excluir&id=<?=$rsDiretor['cod_diretor']?>">
                                <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsDiretor['diretor']);?>')" alt="Deletar"  title="Deletar" class="icon img-size">
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