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
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/jssor.slider-27.5.0.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
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

        <div id="imagem_mobile">
            <img src="./img/imagem_mobile.jpg" class="img-size" alt="imagem_mobile">
        </div>    

        <div class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <div class="item_conteudo">
                <h6 hidden>sessão dos filmes</h6>
                <div class="caixa_item">
                    <!-- menu de filtro  -->
                    <nav class="menu_item">
                        <ul>
                            <li>Ação</li>
                            <li>Aventura</li>
                            <li>Suspense</li>
                            <li>Terror</li>
                        </ul>
                    </nav>  
                </div>
                <!-- caixa que segura as card -->
                <div class="caixa_produto">

                    <?php
                          $sql = "SELECT filme.titulo_filme,
                          filme.preco_filme,
                          concat(SUBSTRING(filme.descricao, 1, 120), ' ...') as descricao,
                          filme.imagem_filme,
                          promocao.status as status_promocao
                          FROM tbl_promocao as promocao right JOIN tbl_filme as filme
                          ON filme.cod_filme = promocao.cod_filme";
                            $select = mysqli_query($conexao, $sql);
                  
                    while($rsFilme = mysqli_fetch_array($select)){
                      if($rsFilme['status_promocao'] == null || $rsFilme['status_promocao'] == 0){        
                        
                    ?>
                        <!-- cards para mostruario pc -->
                        <div class='produto'>
                            <div class='produto_caixa_imagem'>
                                <figure>
                                    <div class='produto_imagem center'>
                                        <img class='img-size' src='img/ator/Arold/participacoes/<?php echo($rsFilme['imagem_filme'])?>' alt='<?php echo($rsFilme['imagem_filme'])?>'>
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
                            <div class='produto_caixa_detalhes'>
                                <div class='botao_detalhes formata_atributo'>
                                    <a href=''>    
                                        Detalhes
                                    </a>
                                </div>
                            </div>
                        </div>



                        <!-- mobile  -->
                        <div class='produto_mobile'>
                            <div class='produto_caixa_imagem_mobile'>
                                <figure>
                                    <div class='produto_imagem_mobile center'>
                                        <img class='img-size' src='img/ator/Arold/participacoes/<?php echo($rsFilme['imagem_filme'])?>' alt='<?php echo($rsFilme['imagem_filme'])?>'>
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
                                <div class='botao_detalhes_mobile formata_atributo_mobile'>
                                    <a href=''>    
                                        Detalhes
                                    </a>
                                </div>
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