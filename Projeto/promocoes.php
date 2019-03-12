<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Promoções</title>
        <script  src="js/jquery-1.11.3.min.js"></script>
        <script  src="js/jssor.slider-27.5.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        <?php require_once('./header.php')?>
        
        <div class="slider center">
            <h6 hidden>sessão dos sliders de filmes em Promoções</h6>
            <?php require_once('./sliderPromocoes.html');?>
        </div>

        <section class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <div class="item_conteudo">
                <h6 hidden>sessão dos filmes</h6>
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
                <div class="caixa_produto">                                    
                    
                    <div class='produto_promocao'>
                        <div class='produto_caixa_imagem'>
                            <figure>
                                <div class='produto_imagem center'>
                                    <img class='img-size' src='img/senhorDosAneisASociedade.jpg' alt='O Senhor Dos Anéis: A Sociedade Do Anel' title='O Senhor Dos Anéis: A Sociedade Do Anel'>
                                </div>
                            </figure>
                        </div>
                        <div class='produto_caixa_descricao_promocao'>
                            <p><span class='formata_atributo'>Nome:</span> O senho dos anéis: A sociedade do anel</p>
                            <p><span class='formata_atributo'>Descrição:</span> Frodo entra em uma jornada para destruir o anel do poder herdado do seu tio Bilbo Bolseiro... </p>
                            <div class="preco_promocoes">
                                <div class='preco_promocoes'>
                                    <span class='formata_atributo'>Preço:</span> <del>24,50</del>
                                </div>
                                <div class='preco_promocoes'>
                                   <span class='formata_atributo'>Preço:</span> 10,20
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

                    <div class='produto_promocao'>
                        <div class='produto_caixa_imagem'>
                            <figure>
                                <div class='produto_imagem center'>
                                    <img class='img-size' src='img/senhorDosAneisASociedade.jpg' alt='O Senhor Dos Anéis: A Sociedade Do Anel' title='O Senhor Dos Anéis: A Sociedade Do Anel'>
                                </div>
                            </figure>
                        </div>
                        <div class='produto_caixa_descricao_promocao'>
                            <p><span class='formata_atributo'>Nome:</span> O senho dos anéis: A sociedade do anel</p>
                            <p><span class='formata_atributo'>Descrição:</span> Frodo entra em uma jornada para destruir o anel do poder herdado do seu tio Bilbo Bolseiro... </p>
                            <div class="preco_promocoes">
                                <div class='preco_promocoes'>
                                    <span class='formata_atributo'>Preço:</span> <del>24,50</del>
                                </div>
                                <div class='preco_promocoes'>
                                   <span class='formata_atributo'>Preço:</span> 10,20
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

                    <div class='produto_promocao'>
                        <div class='produto_caixa_imagem'>
                            <figure>
                                <div class='produto_imagem center'>
                                    <img class='img-size' src='img/senhorDosAneisASociedade.jpg' alt='O Senhor Dos Anéis: A Sociedade Do Anel' title='O Senhor Dos Anéis: A Sociedade Do Anel'>
                                </div>
                            </figure>
                        </div>
                        <div class='produto_caixa_descricao_promocao'>
                            <p><span class='formata_atributo'>Nome:</span> O senho dos anéis: A sociedade do anel</p>
                            <p><span class='formata_atributo'>Descrição:</span> Frodo entra em uma jornada para destruir o anel do poder herdado do seu tio Bilbo Bolseiro... </p>
                            <div class="preco_promocoes">
                                <div class='preco_promocoes'>
                                    <span class='formata_atributo'>Preço:</span> <del>24,50</del>
                                </div>
                                <div class='preco_promocoes'>
                                   <span class='formata_atributo'>Preço:</span> 10,20
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


                        


                </div>
            </div>
        </section>

        <?php require_once('./footer.php')?>
    </body>

</html>
