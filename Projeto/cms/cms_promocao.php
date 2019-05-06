<?php
    //ligando varivael de sessão
    require_once('./usuario_verificado.php');
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();

    //valiaveis
    $btn ="Cadastrar";
    $btn_limpar ="Limpar";
    $porcentagem = null;
    $cod_filme = 0;
    $modo = null;
    if(isset($_POST['botao_limpar_usuario'])){
        header("Location: cms_promocao.php");
    }

    if(isset($_POST['Cadastrar_promocao'])){
        $cod_filme = $_POST['sle_filme_promocao'];
        $porcentagem = $_POST['promocao'];  

        //varificanso se as caixas estáo sem conteudo
        if($cod_filme == null || $porcentagem == ""){
            echo("<script>
                alert('Tem que Haver um filme e uma porcentagem para cadastrar');
                window.location.href = 'cms_promocao.php';
            </script>");
        }else{
            // se tudo estiver certo cadastra a promocao
            $sql = "INSERT INTO tbl_promocao (porcentagem_desconto, cod_filme)
                            VALUES        (".$porcentagem.", ".$cod_filme.") ";

            if(mysqli_query($conexao, $sql)){
                header("Location: cms_promocao.php");
            }else{
                echo $sql;
            }

        }
        

        
    }elseif(isset($_POST['Editar_promocao'])){
        $cod_filme = $_POST['sle_filme_promocao'];
        $porcentagem = $_POST['promocao'];  
        
        $sql="UPDATE tbl_promocao SET cod_filme=".$cod_filme.",
                                       porcentagem_desconto = ".$porcentagem."                                      
                                        WHERE cod_promocao =".$_SESSION['mudar_promocao'];

        if(mysqli_query($conexao, $sql)){
            header("location: cms_promocao.php");
        }else{
            echo $sql;
        }

    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $cod_promocao = $_GET['id'];

        if($modo == 'excluir'){
            $sql =  "DELETE FROM tbl_promocao WHERE cod_promocao =".$cod_promocao;

            if(mysqli_query($conexao, $sql)){
                header("Location: cms_promocao.php");
            }else{
                echo($sql);
            }
        }elseif($modo == 'buscar'){
            $_SESSION['mudar_promocao'] = $cod_promocao;

            //fazer select para pergar os dados da tabela filme e tabela promocao
            $sql = "SELECT promocao.cod_filme,
                            filme.titulo_filme,
                            promocao.porcentagem_desconto
                    FROM tbl_promocao as promocao inner join tbl_filme as filme 
                    on promocao.cod_filme = filme.cod_filme
                    WHERE promocao.cod_promocao =".$cod_promocao;

            $select = mysqli_query($conexao, $sql);
            if($rsBuscarPromocao = mysqli_fetch_array($select)){
                $cod_filme = $rsBuscarPromocao['cod_filme'];
                $titulo_filme = $rsBuscarPromocao['titulo_filme'];
                $porcentagem = $rsBuscarPromocao['porcentagem_desconto'];
                $btn_limpar = 'Cancelar';
                $btn = 'Editar';
                $_SESSION['editar_promocao'] = $cod_promocao;
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

            // ativando e desativando filme
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
                <!-- alinhando a pagina -->
                <div id="segura_pagina_filme_mes">
                    <!-- crinado div para cadastro de promoção -->
                    <div id="card_promocoes" class="center">
                        <form name="frm_promocao" method="POST" action="cms_promocao.php">
                            <div class="segura_caixas_promocao"> 
                                <select name="sle_filme_promocao" id="combo_promocao">
                                    <?php

                                        if($modo != 'buscar'){
                                    ?>
                                    <option value="null">Selecione um filme p/ adcionar uma promoção</option>
                                    <?php
                                        }else{
                                    ?>         
                                    <option value="<?php echo($cod_filme)?>"><?php echo($titulo_filme)?></option>
                                    <?php
                                        }
                                        // pegando filmes
                                        $sql=" SELECT filme.titulo_filme, filme.cod_filme as filme_cod, 
                                                promocao.cod_filme as promocao_cod_filme 
                                                FROM tbl_filme as filme left JOIN tbl_promocao as promocao 
                                                ON filme.cod_filme = promocao.cod_filme WHERE filme.cod_filme <> ".$cod_filme." ORDER BY filme.cod_filme;";
                                        $select = mysqli_query($conexao, $sql);

                                        while($rsfilmepromocao = mysqli_fetch_array($select)){
                                            if($rsfilmepromocao['filme_cod'] != $rsfilmepromocao['promocao_cod_filme'] ){
                                    ?>
                                    <option value="<?php echo($rsfilmepromocao['filme_cod'])?>"><?php echo($rsfilmepromocao['titulo_filme']);?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div id="segura_caixa_promocao_percentagem">
                                <input type="text" value="<?php echo($porcentagem)?>" name="promocao" id="txt_promocao"> <span id="porcentagem">%</span>
                            </div>
                        
                            <div id="segura_botao_ator" >
                                <input type="submit" class="botao_cadastro_usuario" id="botao_limpar_usuario" name="botao_limpar_usuario" value="<?php echo($btn_limpar)?>">
                                <input type="submit" class="botao_cadastro_usuario" id="botao_salvar_usuario" name="<?php echo($btn.'_promocao');?>" value="<?php echo($btn);?>" >
                            </div>

                        </form>
                        
                    </div>

                    <div id="segura_tabela_usuario">
                    
                        <table id="table_usuarios" class="center">
                        
                            <tr id="thead_usuario">
                                <td>
                                    Titulo Filme
                                </td>
                                <td>
                                    Porcentagem de Desconto
                                </td>
                                <td>
                                    Preço sem desconto 
                                </td>
                                <td>
                                    Preço com desconto 
                                </td>
                                <td>
                                    Opções
                                </td>
                            </tr>
                            <?php
                                $sql = "SELECT 	filme.titulo_filme as titulo,
                                        filme.preco_filme as preco,
                                        promocao.cod_promocao,
                                        promocao.status as status_promocao,
                                        promocao.porcentagem_desconto as desconto
                                        FROM tbl_promocao as promocao INNER JOIN tbl_filme as filme
                                        ON promocao.cod_filme = filme.cod_filme";
                                $select = mysqli_query($conexao, $sql);

                                while($rsPromocao = mysqli_fetch_array($select)){
                            ?>
                            <tr class="tbody_usuario">
                                <td>
                                   <?php echo($rsPromocao['titulo'])?>
                                </td>
                                <td>
                                    <?php echo($rsPromocao['desconto'])?>
                                </td>
                                <td>
                                    <?php 
                                        //Tirando o ponto e adicionando a virgula
                                        $preco_com_ponto = explode(".",$rsPromocao['preco']);
                                        $preco_sem_ponto = $preco_com_ponto[0].",".$preco_com_ponto[1];
                                        echo($preco_sem_ponto);
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        // calculando desconto
                                        $preco_descontado = $rsPromocao['preco'] * ($rsPromocao['desconto']/100);
                                        $desconto = $rsPromocao['preco'] - $preco_descontado;
                                        //Tirando o ponto e adicionando a virgula
                                        $desconto_com_ponto = explode(".",$desconto);
                                        $desconto_sem_ponto = $desconto_com_ponto[0].",".$desconto_com_ponto[1];
                                        echo($desconto_sem_ponto);
                                    ?>
                                </td>
                                <td>

                                    <a href="?modo=buscar&id=<?php echo($rsPromocao['cod_promocao']);?>"> 
                                        <img  src="./img/icon_edit.png" class="icon img-size" alt="Edição">
                                    </a>

                                    <a href="?modo=excluir&id=<?php echo($rsPromocao['cod_promocao']);?>">
                                        <img  src="./img/icon_delete.png" class="icon img-size" alt="Deletar" onclick="return confirm('Deseja reamente excluir essa promoção ?')">
                                    </a>
                                    
                                    <?php
                                        $img = $rsPromocao['status_promocao'] == 0 ? "icon_nao_ativo.png" : "icon_ativo.png";
                                        $altEtitle = $rsPromocao['status_promocao'] == 0 ? "Não ativo" : "Ativo";
                                    ?>    
                                    <img src="./img/<?php echo($img)?>" class="icon img-size" onclick="ativarDesativar('promocao', <?php echo($rsPromocao['status_promocao'])?>,<?php echo($rsPromocao['cod_promocao'])?>)" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">
                                      
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>

                    </div>


                        
                </div>

            </div>






            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>

        <script src="./js/mascaraDeCaxas.js"></script>
    </body>
</html>