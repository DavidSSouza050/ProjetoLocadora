<?php
    //Ativa o recurso de variavel de sessão
    session_start();
    //pegando a conexão de outra pasta
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();
    //atribuindo variaveis
    $nome_nivel = null;
    $btn_nivel = 'Salvar';
    $btn_limpar_nivel = 'limpar';

    //limpar caixa
    if(isset($_POST['btn_limpar_nivel'])){
        header('Location: cms_criar_nivel.php');
    }

    //cadastrar nivel ***************************
    if(isset($_POST['btn_cadastro_nivel'])){
        //variaveis da modal
        $nome_nivel = trim($_POST['txt_nome_nivel']);
        $paginas_modificaveis = trim($_POST['cmb_cadastro_nivel']);

        if($_POST['btn_cadastro_nivel'] == 'Salvar'){
            $sql = "INSERT INTO tbl_nivel_usuario (nome_nivel)
                    VALUES ('".$nome_nivel."');";
        }elseif($_POST['btn_cadastro_nivel'] == 'Editar'){
            $sql = "UPDATE tbl_nivel_usuario SET nome_nivel ='".$nome_nivel."' WHERE cod_nivel =".$_SESSION["id_nivel"];
        }
        
           // echo($sql);
        // execulta o sql com a conexão e ver se ta tudo certo para colocar no banco
        if(mysqli_query($conexao, $sql)){
        /*Redireciona para uma nova pagina*/
            header("Location: cms_criar_nivel.php");

        }else{
            // se não der certo mostra essa mensagem
            echo("
                <script>
                    alert('erro no Cadastro');
                </script>
            ");
        }     
    }

    if(isset($_GET['modoNivel'])){
        $modo_nivel = $_GET['modoNivel'];
        $id_nivel = $_GET['id'];

        //variavel de sessão
        $_SESSION['id_nivel'] = $id_nivel;

        if($modo_nivel == 'excluir'){
            $sqlDeletarNivel = "DELETE FROM tbl_nivel_usuario WHERE cod_nivel = ".$id_nivel;
            // execulta o sql com a conexão e ver se ta tudo certo para colocar no banco

            if(mysqli_query($conexao, $sqlDeletarNivel)){
            /*Redireciona para uma nova pagina*/
                header("Location: cms_criar_nivel.php");
    
            }else{
                // se não der certo mostra essa mensagem
                echo("
                    <script>
                        alert('erro no Cadastro');
                    </script>
                ");
            }   
        }elseif($modo_nivel == 'buscar'){
            $sqlBuscarNivel ="SELECT * FROM tbl_nivel_usuario WHERE cod_nivel = ".$id_nivel;
            $select = mysqli_query($conexao, $sqlBuscarNivel);

            if($rsNivel = mysqli_fetch_array($select)){
                $nome_nivel = $rsNivel['nome_nivel'];
                 
                $btn_nivel = 'Editar';
                $btn_limpar_nivel = 'Cancelar';
            }
        }
    }

    //********************************************************* */


    if(isset($_GET['statusNivel'])){
        $status = $_GET['statusNivel'];
        $cod_nivel = $_GET['id'];
        /*Vaeiaveis de sessão caso tenha que dasativar o nivel do  usuairo*/
        $_SESSION['nivel_desativado'] = $status;
        $_SESSION['cod_nivel'] = $cod_nivel;

        if($status == 0){
            $sql = "UPDATE tbl_nivel_usuario set status = 1 WHERE cod_nivel =".$cod_nivel;
        }else{
            $sql = "UPDATE tbl_nivel_usuario set status = 0 WHERE cod_nivel =".$cod_nivel;
        }

        if(mysqli_query($conexao, $sql)){
            header("Location: cms_usuario.php");
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
        
        <div id="segura_cadastro_nivel" class="center">
            <div id="card_cadastro">
                <figure>
                    <a href="cms_usuario.php">
                        <div id="segura_icone_sair">
                            <img src="./img/icone_voltar.png" class="img-size" alt="voltar para pagina de usuários" title="voltar para pagina de usuários">
                        </div>
                    </a>
                </figure>
                <!-- frame de cadastro   -->
                <form name="frm_cadastro_nivel" method="POST" action="cms_criar_nivel.php">
                    <div class="caixa_cadastro_nivel">
                        Nome do Nivel: <input type="text" value="<?php echo($nome_nivel)?>" id="txt_nome_nivel" name="txt_nome_nivel">
                    </div>
                    <div class="caixa_cadastro_nivel">
                        <select id="cmb_cadastro_nivel" name="cmb_cadastro_nivel">
                            <option>Paginas Modificaveis</option>
                            <option value="0">Administrador</option>
                            <option value="1">Catalogista</option>
                            <option value="2">Operador Básico</option>
                        </select>
                    </div>
                    <div id="segura_btn_cadastro_nivel">
                        <input type="submit" value="<?php echo($btn_limpar_nivel)?>" class="botao_cadastro_usuario" name="btn_limpar_nivel">
                        <input type="submit" value="<?php echo($btn_nivel)?>" class="botao_cadastro_usuario" name="btn_cadastro_nivel">
                    </div>
                </form>
            </div>
            
            <div id="segura_table" class="scrollTexto">
                <!-- tabela mostrando todos os niveis -->
                <table id="table_modal_nivel">
                    <tr id="thead_nivel">
                        <td>
                            Nome
                        </td>
                        <td>
                            Opções
                        </td>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_nivel_usuario";
                        $select = mysqli_query($conexao, $sql);

                        while($rsNivel = mysqli_fetch_array($select)){
                    ?>
                    <tr class="tbody_nivel">
                        <td>
                            <?php echo($rsNivel['nome_nivel']);?>
                        </td>
                        <td>

                            <a href="?modoNivel=buscar&id=<?php echo($rsNivel['cod_nivel'])?>">
                                <img src="./img/icon_edit.png" class="icon img-size" alt="Editar" title="Editar">
                            </a>

                            <a href="?modoNivel=excluir&id=<?php echo($rsNivel['cod_nivel'])?>">
                                <img src="./img/icon_delete.png"  onclick="return confirm('Deseja reamente excluir o Nivel <?php echo($rsNivel['nome_nivel']);?>')" class="icon img-size" alt="Deletar" title="Deletar">
                            </a>

                            <a href="?statusNivel=<?php echo($rsNivel['status'])?>&id=<?php echo($rsNivel['cod_nivel'])?>">
                                <?php
                                    if($rsNivel['status'] == 0){
                                        $img = 'icon_nao_ativo.png';
                                        $alt = 'não ativo';
                                    }else{
                                        $img = 'icon_ativo.png';
                                        $alt = 'ativo';
                                    }
                                ?>

                                <img src="./img/<?php echo($img)?>" class="icon img-size" alt="<?php echo($alt)?>" title="<?php echo($alt)?>">
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