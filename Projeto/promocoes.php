<?php
    //
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Promoções</title>
        <script  src="js/jquery-1.11.3.min.js"></script>
        <script  src="js/jssor.slider-27.5.0.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        <!-- header em outra pagina -->
        <?php require_once('./header.php')?>
        
        <div class="slider center">
           <!-- sessão dos sliders de filmes em Promoções -->
            <?php require_once('./sliderPromocoes.php');?>
        </div>

        <div class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <div class="item_conteudo">
                
                <!-- caixa de opções de filmes -->
                <div class="caixa_item">
                    <nav class="menu_item">
                        <ul>
                            <li>Ação</li>
                            <li>Aventura</li>
                            <li>Suspense</li>
                            <li>Terror</li>
                        </ul>
                    </nav>  
                </div>

                <!-- caixa com as cards dos produtos -->
                <div class="caixa_produto">                                    
                    
    
                    <?php
                        $sql = "SELECT filme.titulo_filme,
                                filme.preco_filme,
                                concat(SUBSTRING(filme.descricao, 1, 134), ' ...') as descricao,
                                filme.imagem_filme,
                                promocao.status as status_promocao,
                                promocao.porcentagem_desconto as desconto
                                FROM tbl_promocao as promocao INNER JOIN tbl_filme as filme
                                ON filme.cod_filme = promocao.cod_filme";
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
                                        <img class='img-size' src='img/ator/Arold/participacoes/<?php echo($rsPromocao['imagem_filme'])?>' alt='<?php echo($rsPromocao['imagem_filme'])?>'>
                                    </div>
                                </figure>
                            </div>
                            <div class='produto_caixa_descricao_promocao'>
                                <p><span class='formata_atributo'>Nome:</span> <?php echo($rsPromocao['titulo_filme'])?></p>
                                <p><span class='formata_atributo'>Descrição:</span> <?php echo($rsPromocao['descricao'])?></p>
                                <div class='preco_promocoes'>
                                    <div class='preco_promocoes'>
                                        <?php
                                    
                                            //Tirando o ponto e adicionando a virgula
                                            $preco_com_ponto = explode(".",$rsPromocao['preco_filme']);
                                            $preco_sem_ponto = $preco_com_ponto[0].",".$preco_com_ponto[1];
       
                                        ?>
                                        <span class='formata_atributo'>De:</span> <del><?php echo($preco_sem_ponto);?></del>
                                    </div>
                                    <div class='preco_promocoes'>
                                        <?php 
                                            // calculando desconto
                                            $preco_descontado = $rsPromocao['preco_filme'] * ($rsPromocao['desconto']/100);
                                            $desconto = $rsPromocao['preco_filme'] - $preco_descontado;
                                            //Tirando o ponto e adicionando a virgula
                                            $desconto_com_ponto = explode(".",$desconto);
                                            $desconto_sem_ponto = $desconto_com_ponto[0].",".$desconto_com_ponto[1];                                            
                                        ?>
                                        <span class='formata_atributo'>Por:</span> <?php echo($desconto_sem_ponto);?>
                                    </div>                            
                                </div>
                            </div>
                            <div class='produto_caixa_detalhes'>
                                <div class='botao_detalhes formata_atributo'>
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
