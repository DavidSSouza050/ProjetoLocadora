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
    $btn_genero = 'Cadastrar';
    $btn_limpar = 'Limpar';
    $genero = null;

    if(isset($_POST['btn_limpar'])){
        header('Location: cms_genero.php');
    }

    if(isset($_POST['Cadastrar_genero'])){
        $genero = trim($_POST['nome_genero']);

        if($genero != ""){
            $sql = "INSERT INTO tbl_genero (genero) 
                            VALUES ('".addslashes($genero)."')";

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_genero.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_genero.php';</script>");
        }
        
            

    }elseif(isset($_POST['Atualizar_genero'])){
        $genero = trim($_POST['nome_genero']);

        if($genero != ""){
            $sql = "UPDATE tbl_genero SET genero ='".addslashes($genero)."'
                                            WHERE cod_genero = ".$_SESSION['cod_genero'];

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_genero.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_genero.php';</script>");
        }
    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];

        if($modo == 'excluir'){

            $sqlGenero = "SELECT genero.cod_genero
                    FROM tbl_genero as genero INNER JOIN tbl_subcategoria_categoria as subcat_categoria
                    ON genero.cod_genero = subcat_categoria.cod_genero INNER JOIN tbl_categoria as categoria
                    ON categoria.cod_categoria = subcat_categoria.cod_categoria WHERE genero.cod_genero = ".$codigo;

            
            $select = mysqli_query($conexao, $sqlGenero); 

            if($rsGeneroExcluir = mysqli_fetch_array($select)){
                echo($rsGeneroExcluir['cod_genero']);
                if($rsGeneroExcluir['cod_genero'] != null){
                    echo("<script>alert('Este genero esta relacionada com uma categoria, Não pode excluir-la.');
                                    window.location='cms_genero.php';
                        </script>");
                }
            }else{
                $sqlDeletar = "DELETE FROM tbl_genero WHERE cod_genero = ".$codigo;
                
                
                if(mysqli_query($conexao, $sqlDeletar)){
                    header('Location: cms_genero.php');
                }else{
                    echo($sqlDeletar);
                }
            }

        }elseif($modo == 'editar'){
            
            $sql = "SELECT cod_genero, genero FROM tbl_genero WHERE cod_genero = ".$codigo;
            $select = mysqli_query($conexao, $sql);

            if($rsEditar = mysqli_fetch_array($select)){
                $genero = $rsEditar['genero'];

                $btn_genero = 'Atualizar';
                $btn_limpar = 'Cancelar';
                $_SESSION['cod_genero'] = $rsEditar['cod_genero'];
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
                    <a href="cms_categoria.php">
                        <img src="./img/icone_voltar.png" class="img-size" alt="Volta" title="Voltar">
                    </a>
                </div>
            </figure>
            <div id="cadastro_distribuidora">
                <form name="frm_genero" method="POST" action="cms_genero.php">
                    <h3>Genero</h3>
                    <input type="text" value="<?=$genero?>" id="text_distribuidora" maxlength="45" name="nome_genero">

                    <div id="segura_botao_ator">
                        <input type="submit" value="<?php echo($btn_genero);?>" name="<?php echo($btn_genero.'_genero');?>"  class="botao_cadastro_usuario"> 
                        <input type="submit" value="<?php echo($btn_limpar);?>" name="btn_limpar" class="botao_cadastro_usuario"> 
                    </div>
                </form>
            </div>

            <div id="segura_cadastrados" class="scrollTexto">
                <table id="table_modal_nivel">
                    <tr id="thead">
                        <td>
                            Genero
                        </td>
                        <td>
                            Opcões
                        </td>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_genero";
                        $select = mysqli_query($conexao, $sql);
                        while($rsGenero = mysqli_fetch_array($select)){
                    ?>
                    <tr class="tbody">
                        <td>
                            <?= $rsGenero['genero']?>
                        </td>
                        <td>
                            <a href="?modo=editar&id=<?=$rsGenero['cod_genero']?>">
                                <img src="./img/icon_edit.png" alt="Editar" title="Editar" class="icon img-size">
                            </a>
                            <a href="?modo=excluir&id=<?=$rsGenero['cod_genero']?>">
                                <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rsGenero['genero']);?>')" alt="Deletar"  title="Deletar" class="icon img-size">
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