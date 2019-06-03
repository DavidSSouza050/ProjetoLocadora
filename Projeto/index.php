<?php
    require_once('./db/conexao.php');
    $conexao =  conexaoMysql();
    //pegando a função de desconto
    require_once('./cms/util/formatar_preco.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Locadora Acme Tunes</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
        <script src="js/jssor.slider-27.5.0.min.js"></script>
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

            function executar(){
                var texto = document.getElementById('txtBusca').value;//pegnado o valor da caixa
                var lista = document.getElementById('historico');// pegando todas as options da datalist
                var adicionar = true;// colocando o valor verdadeiro
                
                var opt = document.createElement('option');// variavel vai criar as options

                for(var i=0; i < lista.options.length; i++){//verificando se não existe a palavra da caixa
                    if(texto == lista.options[i].value){// se exister ele não adicionar
                        adicionar = false;
                    }
                }

                if(adicionar == true ){ // se não existir ele adicionar com o valor digitado na caixa
                    opt.value = texto;
                    lista.appendChild(opt);
                }

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
            <!-- slider -->
            <?php require_once("with-jquery.php"); ?>
            <!-- Redes socicais -->
            <div class="caixa_rede_social">
                <figure>
                    <div class="rede_social">
                        <img  class="img-size " src="./img/facebook.png" alt="Logo do facebook" title="logo do facebook">
                    </div>
                </figure>
                <figure>
                    <div class="rede_social">   
                        <img class="border-img" src="img/pinterest.png" alt="logo do pinterest" title="logo do pinterest">
                    </div>
                </figure>
                <figure>
                    <div class="rede_social">
                        <img class="border-img img-size" src="img/twitter.png" alt="logo do instagram" title="logo do twitter">
                    </div>
                </figure>
            </div>
        </div>

        <!-- mobile -->
        <figure>
            <div id="imagem_mobile">
                <img src="./img/imagem_mobile.jpg" class="img-size" alt="imagem_mobile">
            </div>    
        </figure>
        
        <div class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <div class="item_conteudo">
                <div class="caixa_item">
                    <!-- menu de filtro  -->
                    <nav class="menu_item">
                        <ul class="ul_menu_item">
                            <?php 
                                $sql="SELECT cod_categoria, categoria 
                                      FROM tbl_categoria WHERE status = 1";
                                $select1 = mysqli_query($conexao, $sql);
                                while($rsCategoria = mysqli_fetch_array($select1)){
                                    $cod_categoria = $rsCategoria['cod_categoria'];
                            ?>

                            <li class="li_menu_item">
                                <span onclick="test(<?php echo($rsCategoria['cod_categoria'])?>)" ><?=$rsCategoria['categoria']?></span>
                                
                                <div class="aparece_subCategoria">
                                    <img src="./img/icon_seta_submenu.png" class="img-size" alt="Mostra Sub Menu" title="Submenu">
                                </div>
                            
                                <ul class="ul_subMenu esconder_subMenu scrollTexto">
                                    <?php
                                    $sqlsubcategoria1 = "SELECT genero.cod_genero, genero.genero
                                                        FROM tbl_subcategoria_categoria as subCat INNER JOIN tbl_genero as genero
                                                        ON subCat.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                                                        ON categoria.cod_categoria = subCat.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria;
                                    $selectSubCetgoria1 = mysqli_query($conexao, $sqlsubcategoria1);
                                    while($rsSubcategoria1 = mysqli_fetch_array($selectSubCetgoria1)){                                                        
                                    ?>
                                    <li class="li_subMenu center">
                                        <span onclick="test(<?php echo($rsSubcategoria1['cod_genero'])?>)"><?=$rsSubcategoria1['genero']?></span>
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
                     $sql2="SELECT cod_categoria, categoria 
                     FROM tbl_categoria WHERE status = 1";
                    $select2 = mysqli_query($conexao, $sql2);
                    while($rsCategoria2 = mysqli_fetch_array($select2)){
                        $cod_categoria2 = $rsCategoria2['cod_categoria'];
                    ?>
                    <div class="categoria_item">
                        <span onclick="test(<?php echo($rsCategoria2['cod_categoria'])?>)" ><?=$rsCategoria2['categoria']?></span>
                        <div class="segura_subCategoria">
                            <?php 
                            if($rsCategoria2['cod_categoria'] == 1){
                            ?>
                            <div class="fecha_subcategoria">
                                <img src="img/icon_arrow.png" class="img-size" alt="Volta">
                            </div>
                            <?php
                            } 
                            ?>
                            <?php 
                                $sqlsubcategoria2 = "SELECT genero.cod_genero, genero.genero
                                                        FROM tbl_subcategoria_categoria as subCat INNER JOIN tbl_genero as genero
                                                        ON subCat.cod_genero = genero.cod_genero INNER JOIN tbl_categoria as categoria
                                                        ON categoria.cod_categoria = subCat.cod_categoria WHERE categoria.cod_categoria = ".$cod_categoria2;
                                $selectSubCategoria2 = mysqli_query($conexao, $sqlsubcategoria2);
                                while($rsSubcategoria2 = mysqli_fetch_array($selectSubCategoria2)){    
                            ?>
                            <div class="subcategoria_item">
                                <span onclick="test(<?php echo($rsSubcategoria2['cod_genero'])?>)"><?=$rsSubcategoria2['genero']?></span>
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



                <!-- caixa que segura as card -->
                <div class="caixa_produto">
                    <div id="divBusca">
                        <input type="text" id="txtBusca" list="historico" placeholder="Buscar..."/>
                        <input type="image" src="./img/icon_lupa.png" id="btnBusca" onclick="executar()" alt="Submit" title="Pesquisar"/>
                        <datalist id="historico">
                            <option value="Era"></option>
                            <option value="Ação"></option>
                            <option value="Comédia"></option>
                            <option value="Romantica"></option>
                            <option value="Romance"></option>
                        </datalist>
                    </div>

                    <?php
                          $sql = "SELECT filme.cod_filme,
                          filme.titulo_filme,
                          filme.preco_filme,                          
                          concat(SUBSTRING(filme.descricao, 1, 110), ' ...') as descricao,
                          filme.imagem_filme,
                          promocao.status as status_promocao
                          FROM tbl_promocao as promocao right JOIN tbl_filme as filme
                          ON filme.cod_filme = promocao.cod_filme WHERE filme.status_produto = 1 ORDER BY RAND()";
                            $select = mysqli_query($conexao, $sql);
                  
                    while($rsFilme = mysqli_fetch_array($select)){
                      if($rsFilme['status_promocao'] == null || $rsFilme['status_promocao'] == 0){        
                        
                    ?>
                        <!-- cards para mostruario pc -->
                        <div class='produto'>
                            <div class='produto_caixa_imagem'>
                                <figure>
                                    <div class='produto_imagem center'>
                                        <img class='img-size' src='./cms/img/imagem_filme/<?php echo($rsFilme['imagem_filme'])?>' alt='<?php echo($rsFilme['imagem_filme'])?>'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao'>
                                <p><span class='formata_atributo'>Nome:</span> <?php echo($rsFilme['titulo_filme'])?> </p>
                                <p><span class='formata_atributo'>Descrição:</span> <?php echo($rsFilme['descricao'])?> </p>
                                <p><span class='formata_atributo'>Preço:</span> <?php 
                                    //formatando o preco
                                    $preco = colocar_virgula($rsFilme['preco_filme']);
                                    echo($preco);
                                 ?></p>
                            </div>
                            <div class='produto_caixa_detalhes visualizar'>
                                <div class='botao_detalhes formata_atributo visualizar' onclick="visualizarProduto('normal', <?php echo($rsFilme['cod_filme']) ?>)">
                                    Detalhes
                                </div>
                            </div>
                        </div>



                        <!-- mobile  -->
                        <div class='produto_mobile center'>
                            <div class='produto_caixa_imagem_mobile'>
                                <figure>
                                    <div class='produto_imagem_mobile center'>
                                        <img class='img-size' src='./cms/img/imagem_filme/<?php echo($rsFilme['imagem_filme'])?>' alt='<?php echo($rsFilme['imagem_filme'])?>'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao_mobile'>
                                <p><span class='formata_atributo_mobile'>Nome:</span> <?php echo($rsFilme['titulo_filme'])?> </p>
                                <p><span class='formata_atributo_mobile'>Descrição:</span> <?php echo($rsFilme['descricao'])?> </p>
                                <p><span class='formata_atributo_mobile'>Preço:</span> <?php 
                                    //formatando o preco
                                    $preco = colocar_virgula($rsFilme['preco_filme']);
                                    echo($preco);
                                 ?></p>
                            </div>
                            <div class='produto_caixa_detalhes_mobile'>
                                <a href="./modais/pagina_modal_responsivo.php?modo=normal&codigo=<?=$rsFilme['cod_filme']?>">
                                    <div class='botao_detalhes_mobile formata_atributo_mobile'>   
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