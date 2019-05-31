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
    $btn_categoria = 'Cadastrar';
    $categoria = null;

    //cadastrar categoria
    if(isset($_POST['Cadastrar_categoria'])){
        $categoria = trim($_POST['nome_categoria']);

        if($categoria != ""){
            $sql = "INSERT INTO tbl_categoria (categoria) 
                            VALUES ('".addslashes($categoria)."')";

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_categoria.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_categoria.php';</script>");
        }
        
            

    }elseif(isset($_POST['Atualizar_categoria'])){
        $categoria = trim($_POST['nome_categoria']);

        if($categoria != ""){
            $sql = "UPDATE tbl_categoria SET categoria ='".addslashes($categoria)."'
                                            WHERE cod_categoria = ".$_SESSION['cod_categoria'];

            if(mysqli_query($conexao, $sql)){
                header('Location: cms_categoria.php');
            }else{
                echo $sql;
            }
        }else{
            echo("<script>alert('Preencha a caixa.')</script>");
            echo("<script>window.location='cms_categoria.php';</script>");
        }
    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $codigo = $_GET['id'];
        //modos de exclusão e edição do categoria
        if($modo == 'excluir'){

            $sql = "SELECT filme.titulo_filme as filme_titulo,
                    filme.cod_filme as cod_filme,
                    categoria.cod_categoria as cod_categoria
                    FROM tbl_filme_genero_categoria as filme_categoria inner JOIN tbl_categoria as categoria
                    ON filme_categoria.cod_categoria = categoria.cod_categoria left join tbl_filme as filme
                    ON filme_categoria.cod_filme =  filme.cod_filme
                    WHERE categoria.cod_categoria =".$codigo;

            $select = mysqli_query($conexao, $sql); 

            if($rsExcluirCategoria = mysqli_fetch_array($select)){
                if($rsExcluirCategoria['cod_filme'] != null){
                    echo("<script>alert('Está categoria esta relacionada com um filme, Não pode excluir-la.')</script>");
                    echo("<script>window.location='cms_categoria.php';</script>");
                }else{
                    $sqlDeletar = "DELETE FROM tbl_categoria WHERE cod_categoria = ".$codigo;
                    
                    if(mysqli_query($conexao, $sqlDeletar)){
                        header('Location: cms_categoria.php');
                    }else{
                        echo($sqlDeletar);
                    }
                }
            }

        }elseif($modo == 'editar'){
            
            $sql = "SELECT cod_categoria, categoria FROM tbl_categoria WHERE cod_categoria = ".$codigo;
            $select = mysqli_query($conexao, $sql);

            if($rsEditar = mysqli_fetch_array($select)){
                $categoria = $rsEditar['categoria'];

                $btn_categoria = 'Atualizar';
                $_SESSION['cod_categoria'] = $rsEditar['cod_categoria'];
            }

        }
        
    }




    if(isset($_POST['Salvar_adicionar_genero_categoria'])){
        $cod_genero = $_POST['sle_genero'];
        $cod_categoria = $_POST['sle_categoria'];

        $sql="INSERT INTO tbl_subcategoria_categoria (cod_genero, cod_categoria)
        VALUES (".$cod_genero.", ".$cod_categoria.")";

        if(mysqli_query($conexao, $sql)){
            header('Location: cms_categoria.php');
        }else{
            echo($sql);
        }

    }





    //ativar e desativar com verificação
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $id = $_GET['id'];

        if($status == 0){
            $sqlAtivarDesativar = "UPDATE tbl_categoria SET status = 1 WHERE cod_categoria =".$id;
        }else{
            $sqlAtivarDesativar = "UPDATE tbl_categoria SET status = 0 WHERE cod_categoria =".$id;
        }

        if(mysqli_query($conexao, $sqlAtivarDesativar)){
            header("Location: cms_categoria.php");
        }else{
            echo $sqlAtivarDesativar;
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

//          atribuindo um genero a categoria
            function colocargenero_categoria(modo, codigo){
                $.ajax({
                    type:'GET',
                    url: "./modais/cms_modal_colocar_genero_na_categoria.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal').html(dados);
                    },
                })
            }

        </script>
    </head>
    <body>
       <!-- contender da modal que vai abrir para mostrar o cliente por completo -->
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
            <div id="modal" class="center">
                
            </div>
        </div>

        <div id="segura_cadastro_distribuidora">
            <figure>
                <div id="sair_distribuidora">
                    <a href="cms_produtos.php">
                        <img src="./img/icone_voltar.png" class="img-size" alt="Volta" title="Voltar">
                    </a>
                </div>
            </figure>

            <!-- Adicionar genero para o filme -->
            <figure>
                <div id="reacionaGenero" class="visualizar" onclick="colocargenero_categoria('Salvar', 0)" >
                    Adicionar Genero
                </div>
            </figure>


            <div id="cadastro_distribuidora">
                <form name="frm_direto" method="POST" action="cms_categoria.php">
                    <h3>categoria</h3>
                    <input type="text" value="<?=$categoria?>" id="text_distribuidora" maxlength="90" name="nome_categoria">

                    <div id="segura_botao_ator">
                        <input type="submit" value="<?php echo($btn_categoria);?>" name="<?php echo($btn_categoria.'_categoria');?>"  class="botao_cadastro_usuario"> 
                    </div>
                <form>
            </div>
            <div id="segura_cadastrados" class="scrollTexto">
                <table id="table_modal_nivel">
                    <tr id="thead">
                        <td>
                            categoria
                        </td>
                        <td>
                            Opcões
                        </td>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_categoria";
                        $select = mysqli_query($conexao, $sql);
                        while($rscategoria = mysqli_fetch_array($select)){
                    ?>
                    <tr class="tbody">
                        <td>
                            <?= $rscategoria['categoria']?>
                        </td>
                        <td>
                            <a href="?modo=editar&id=<?=$rscategoria['cod_categoria']?>">
                                <img src="./img/icon_edit.png" alt="Editar" title="Editar" class="icon img-size">
                            </a>
                            <a href="?modo=excluir&id=<?=$rscategoria['cod_categoria']?>">
                                <img src="./img/icon_delete.png" onclick="return confirm('Deseja reamente excluir o(a) <?php echo($rscategoria['categoria']);?>')" alt="Deletar"  title="Deletar" class="icon img-size">
                            </a>    
                            
                            <a href="?status=<?=$rscategoria['status']?>&id=<?=$rscategoria['cod_categoria']?>">
                                <?php
                                    $img = $rscategoria['status'] == 0 ? 'icon_nao_ativo.png' : 'icon_ativo.png';
                                    $altEtitle = $rscategoria['status'] == 0 ? 'não ativo' : 'ativo';
                                ?>
                                <img src="./img/<?php echo($img)?>" class="icon img-size" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">
                            </a>
                            <img src="./img/icon_view.png" class="icon img-size" alt="visualizar Generos" title="visualizar Generos">

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