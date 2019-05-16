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
    //criando varivais
    $btn = 'Cadastrar';
    $btnLimpar = 'Limpar';
    $img_filme = null;

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
        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
        

            <!-- conteudo do menu do cms -->
            <div  id="conteudo_paginas_conteudo">

                 <!-- caixa que vai conter outras paginas relacionadas sobre a empresa                 -->
                 <div id="menu_card_cadastro">
                    
                    <div class="itens_card_cadastro visualizar" onclick="colocardiretor('Cadastrar', 0)">
                        Adicionar diretor
                    </div>      
                    <div class="itens_card_cadastro visualizar" onclick="colocargenero('Salvar', 0)">
                        Adicionar genero
                    </div>
                    <div class="itens_card_cadastro visualizar" onclick="colocarcategoria('Salvar', 0)">
                        Adicionar  categoria 
                    </div>      

                </div>
                
                <!-- vai mostrar todos os sobres cadastrados -->
                <div id="segura_table_conteudo">
                    <!-- card que ira cadastrar o produto -->
                    <div id="card_cadastrar_produto">
                    
                        <div class="segura_caixas_produto">
                            <div class="segura_txt_produto">
                                <h4>Titulo Do Filme</h4>
                                <input type="text" class="txt_produto"  placeholder="Ex: A vida dos mortos" name="titulo_filme" id="titulo-produto">

                            </div>
                            <div class="segura_txt_produto">
                                <h4>Duração</h4>
                                <input type="text" class="txt_produto" placeholder="Ex: 150 Minutos"  name="duracao_filme" id="duracao-filme">

                            </div>
                        </div>

                        <div class="segura_caixas_produto">
                            <div class="segura_txt_produto">
                                <h4>Classificacao</h4>

                                <select name="sle_classificacao" class="txt_produto">
                                    <option value="null">Classificação</option>
                                
                                    <?php
                                        $sql = "SELECT cod_classificacao, classificacao FROM tbl_classificacao";
                                        $select = mysqli_query($conexao, $sql);

                                        while($rsClassificacao = mysqli_fetch_array($select)){
                                    ?>
                                    <option value="<?php echo($rsClassificacao['cod_classificacao'])?>"><?php echo($rsClassificacao['classificacao'])?></option>
                                    <?php
                                        }
                                    ?>
                                
                                </select>
                            
                            </div>
                            <div class="segura_txt_produto">
                                <h4>Distribuidora</h4>
                                
                                <select name="sle_classificacao"  class="txt_produto">
                                    <option  value="null">Distribuidora</option>
                                
                                
                                    <?php
                                        $sql = "SELECT cod_distribuidora, distribuidora FROM tbl_ditribuidora";
                                        $select = mysqli_query($conexao, $sql);

                                        while($rsClassificacao = mysqli_fetch_array($select)){
                                    ?>
                                    <option value="<?php echo($rsClassificacao['cod_distribuidora'])?>"><?php echo($rsClassificacao['distribuidora'])?></option>
                                    <?php
                                        }
                                    ?>
                                
                                </select>

                                <!-- icone para adicionar a Distribuidora -->
                                <div class="adicionar icon iconSemMargin">
                                    <img src="./img/icon_add.png" class="img-size" alt="Adicionar" title="Adicionar">
                                </div>

                            </div>
                        </div>

                        <div class="segura_caixas_produto">
                            <div class="segura_txt_produto">
                                <h4>Preço</h4>
                                <input type="text" class="txt_produto" placeholder="Ex: 35,20"  name="preco_filme" id="preco-filme">
                            
                            </div>
                            <div class="segura_txt_produto">
                                <h4>Imagem</h4>
                                <input type="FILE" name="fle_imagem_filme">
                            
                            </div>
                    
                        </div>
                    
                        <div id="segura_imagem_sinopse">
                            <?php
                                
                                if($img_filme != null){
                            ?>
                            <div id="segura_img_filme">

                            </div>
                            <?php
                                }
                            ?>


                            <textarea id="txt_produto_sinopse" placeholder="Sinopse" class="center scrollTexto" name="txt_sinopse"></textarea>


                            <div id="segura_botao_ator">
                                <input type="submit" value="<?php echo($btn);?>" name="<?php echo($btn.'_produto'); ?>" id="cadastrar_produto" class="botao_cadastro_usuario"> 
                                <input type="submit" value="<?php echo($btnLimpar);?>" name="<?php echo($btnLimpar.'_produto'); ?>" id="limpar_produto" class="botao_cadastro_usuario"> 
                            </div>
                        </div>
                    </div>
                
                </div>

            </div>


            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>
