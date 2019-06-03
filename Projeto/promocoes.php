<?php
    //
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();
    //pegando a função de desconto
    require_once('./cms/util/formatar_preco.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Promoções</title>
        <script  src="js/jssor.slider-27.5.0.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
        <script src="js/jquery-1.11.3.min.js"></script>
        <script>
            //abrindo a modal
            $(document).ready(function(){
                // ativando modal
                $(document).ready(function(){
                    $('.visualizar').click(function(){
                        $('#conteiner_produto').fadeIn(300);
                    });
                });
                
                $(document).ready(function(){
                $('#fechar_modal_produto').click(function(){
                    $('#conteiner_produto').fadeOut(300);
                });
            });

            });

            function visualizarProduto(modo, codigo){
                $.ajax({
                    type: "GET",
                    url: "./modais/modal_produto.php",
                    data:{modo:modo, codigo:codigo},
                    success: function(dados){
                        $('#modal_produto').html(dados);
                    }
                });
            }


            function test(codigo){
                
                alert(codigo);
                
            }
        
        </script>
    </head>
    <body>
        <!-- contender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner_produto">
            <!-- modal que vai suportar tudo o conteudo -->
            <div id="modal_produto" class="center">
                
            </div>
        </div>

        <!-- header em outra pagina -->
        <?php require_once('./header.php')?>
        
        <div class="slider center">
           <!-- sessão dos sliders de filmes em Promoções -->
            <?php require_once('./sliderPromocoes.php');?>
        </div>

        <!-- mobile -->
        <figure>
            <div id="imagem_mobile">
                <img src="./img/maxresdefault.jpg" class="img-size" alt="imagem_mobile">
            </div>    
        </figure>

        <div class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <div class="item_conteudo">
                
                <!-- caixa de opções de filmes -->
                <div class="caixa_item">
                    <!-- menu de filtro  -->
                    <nav class="menu_item">
                        <ul class="ul_menu_item">
                            <?php 
                                $sql="SELECT cod_categoria, categoria 
                                      FROM tbl_categoria WHERE status = 1";
                                $select = mysqli_query($conexao, $sql);
                                while($rsCategoria = mysqli_fetch_array($select)){
                                    $cod_categoria = $rsCategoria['cod_categoria'];
                            ?>

                            <li class="li_menu_item">
                                <span onclick="test(<?php echo($rsCategoria['cod_categoria'])?>)" ><?=$rsCategoria['categoria']?></span>
                                
                                <div class="aparece_subCategoria">
                                    <img src="./img/icon_seta_submenu.png" class="img-size" alt="Mostra Sub Menu" title="Submenu">
                                </div>
                            
                                <ul class="ul_subMenu esconder_subMenu scrollTexto">
                                    <?php
                                    $sqlsubcategoria = "SELECT genero.cod_genero, genero.genero
                                                        FROM tbl_subcategoria_categoria as subCat INNER JOIN tbl_genero as genero
                                                        ON subCat.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                                                        ON categoria.cod_categoria = subCat.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria;
                                    $selectSubCetgoria = mysqli_query($conexao, $sqlsubcategoria);
                                    while($rsSubcategoria = mysqli_fetch_array($selectSubCetgoria)){                                                        
                                    ?>
                                    <li class="li_subMenu center">
                                        <span onclick="test(<?php echo($rsSubcategoria['cod_genero'])?>)"><?=$rsSubcategoria['genero']?></span>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>    
                                
                            </li>
                            <?php
                                }
                            ?>
                            
                            
                        </ul>
                    </nav>  
                </div>
                
                <!-- imagem que vai chamar o menu de categoria -->
                <div id="open_categoria" class="back-size">
                    <img src="./img/iconfinder_filter_299094.png" class="border-radius-img img-size" alt="Filtrar" >
                </div>

                <!-- div que vai segurar as categorias -->
                <div class="segura_categoria scrollTexto">
                    <div class="fecha_categoria">
                        <img src="img/close_menu.png" class="img-size" alt="Volta">
                    </div>

                    <?php
                     $sql="SELECT cod_categoria, categoria 
                     FROM tbl_categoria WHERE status = 1";
                    $select = mysqli_query($conexao, $sql);
                    while($rsCategoria = mysqli_fetch_array($select)){
                        $cod_categoria = $rsCategoria['cod_categoria'];
                    ?>
                    <div class="categoria_item">
                        <span onclick="test(<?php echo($rsCategoria['cod_categoria'])?>)" ><?=$rsCategoria['categoria']?></span>
                        <div class="segura_subCategoria">
                            <?php 
                            //if($rsCategoria['cod_categoria'] == 1){
                            ?>
                            <div class="fecha_subcategoria">
                                <img src="img/icon_arrow.png" class="img-size" alt="Volta">
                            </div>
                            <?php
                            //} 
                            ?>
                            <?php 
                                $sqlsubcategoria = "SELECT genero.cod_genero, genero.genero
                                                        FROM tbl_subcategoria_categoria as subCat INNER JOIN tbl_genero as genero
                                                        ON subCat.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                                                        ON categoria.cod_categoria = subCat.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria;
                                $selectSubCetgoria = mysqli_query($conexao, $sqlsubcategoria);
                                while($rsSubcategoria = mysqli_fetch_array($selectSubCetgoria)){    
                            ?>
                            <div class="subcategoria_item">
                                <span onclick="test(<?php echo($rsSubcategoria['cod_genero'])?>)"><?=$rsSubcategoria['genero']?></span>
                            </div>
                            <?php
                                }
                            ?>     
                        </div>


                    </div>
                    <?php
                    }
                    ?>
                    
                </div>

                <!-- caixa com as cards dos produtos -->
                <div class="caixa_produto">                                    
                    
    
                    <?php
                        $sql = "SELECT filme.titulo_filme,
                                filme.preco_filme,
                                concat(SUBSTRING(filme.descricao, 1, 134), ' ...') as descricao,
                                filme.imagem_filme,
                                filme.cod_filme,
                                promocao.status as status_promocao,
                                promocao.porcentagem_desconto as desconto
                                FROM tbl_promocao as promocao INNER JOIN tbl_filme as filme
                                ON filme.cod_filme = promocao.cod_filme ORDER BY RAND()";
                        $select = mysqli_query($conexao, $sql);
                        //for para colocar as cards rapidamente
                        while($rsPromocao = mysqli_fetch_array($select)){
                            if($rsPromocao['status_promocao'] == 1){
                    ?>
                        <!-- cards dos filmes a venda e em promoção -->
                        <div class='produto_promocao'>
                            <div class='produto_caixa_imagem'>
                                <figure>
                                    <div class='produto_imagem center'>
                                        <img class='img-size' src='./cms/img/imagem_filme/<?php echo($rsPromocao['imagem_filme'])?>' alt='<?php echo($rsPromocao['imagem_filme'])?>'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao_promocao'>
                                <p><span class='formata_atributo'>Nome:</span> <?php echo($rsPromocao['titulo_filme'])?></p>
                                <p><span class='formata_atributo'>Descrição:</span> <?php echo($rsPromocao['descricao'])?></p>
                                <div class='caixa_preco_promocoes'>
                                    <div class='preco_promocoes'>
                                        <?php
                                            //Tirando o ponto e adicionando a virgula
                                            $preco = colocar_virgula($rsPromocao['preco_filme']);
                                            
                                        ?>
                                        <span class='formata_atributo'>De:</span> <del><?php echo($preco);?></del>
                                    </div>
                                    <div class='preco_promocoes'>
                                        <?php 
                                            //atribuindo o desconto para o preco do produtop
                                            $preco_com_desconto = calcular_preco($rsPromocao['desconto'], $rsPromocao['preco_filme']);
                                        ?>
                                        <span class='formata_atributo'>Por:</span> <?php echo($preco_com_desconto);?>
                                    </div>                            
                                </div>
                            </div>
                            <div class='produto_caixa_detalhes'>
                                <div class='botao_detalhes formata_atributo visualizar' onclick="visualizarProduto('promocao', <?=$rsPromocao['cod_filme']?>)">
                                    Detalhes
                                </div>
                            </div>
                        </div>


                        <!-- cards dos filmes a venda e em promoção mobile -->
                        <div class='produto_promocao_mobile center'>
                            <div class='produto_caixa_imagem_mobile'>
                                <figure>
                                    <div class='produto_imagem_mobile center'>
                                        <img class='img-size' src='./cms/img/imagem_filme/<?php echo($rsPromocao['imagem_filme'])?>' alt='<?php echo($rsPromocao['imagem_filme'])?>'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao_promocao_mobile'>
                                <p><span class='formata_atributo_mobile'>Nome:</span> <?php echo($rsPromocao['titulo_filme'])?></p>
                                <p><span class='formata_atributo_mobile'>Descrição:</span> <?php echo($rsPromocao['descricao'])?></p>
                                <div class='caixa_preco_promocoes_mobile'>
                                    <div class='preco_promocoes_mobile'>
                                        <?php
                                            //Tirando o ponto e adicionando a virgula
                                            $preco = colocar_virgula($rsPromocao['preco_filme']);
                                            
                                        ?>
                                        <span class='formata_atributo_mobile'>De:</span> <del><?php echo($preco);?></del>
                                    </div>
                                    <div class='preco_promocoes_mobile'>
                                        <?php 
                                            //atribuindo o desconto para o preco do produtop
                                            $preco_com_desconto = calcular_preco($rsPromocao['desconto'], $rsPromocao['preco_filme']);
                                        ?>
                                        <span class='formata_atributo_mobile'>Por:</span> <?php echo( $preco_com_desconto);?>
                                    </div>                            
                                </div>
                            </div>
                            <div class='produto_caixa_detalhes_mobile'>
                                <a href="./modais/pagina_modal_responsivo.php?modo=promocao&codigo=<?=$rsPromocao['cod_filme']?>"> 
                                    <div class='botao_detalhes_mobile formata_atributo_mobile' >
                                        Detalhes
                                    </div>
                                </a>
                            </div>
                        </div>


                        
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>


        <!-- footer em outra pagina -->
        <?php require_once('./footer.php')?>
    </body>

</html>
