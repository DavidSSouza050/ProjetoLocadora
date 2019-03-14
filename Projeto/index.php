<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Locadora Acme Tunes</title>
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
            <h2 hidden>Slider inicial</h2>
            <!-- slider -->
            <?php require_once("with-jquery.html"); ?>

            <div class="caixa_rede_social">
                <figure>
                    <div class="rede_social">
                        <img  class="border-img" src="img/facebook.png" alt="Logo do facebook" title="logo do facebook">
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
            

        <div class="conteudo center">
            <!-- aqui começa a sessação dos filmes  -->
            <section class="item_conteudo">
                <h6 hidden>sessão dos filmes</h6>
                <div class="caixa_item">
                    <nav class="menu_item">
                        <ul>
                            <li>Ação</li>
                            <li>Aventura</li>
                            <li>Suspence</li>
                            <li>Terror</li>
                        </ul>
                    </nav>  
                </div>
                <div class="caixa_produto">
                    
                    <div class='produto'>
                        <div class='produto_caixa_imagem'>
                            <figure>
                                <div class='produto_imagem center'>
                                    <img class='img-size' src='img/senhorDosAneisASociedade.jpg' alt='O Senhor Dos Anéis: A Sociedade Do Anel' title='O Senhor Dos Anéis: A Sociedade Do Anel'>
                                </div>
                            </figure>
                        </div>
                        <div class='produto_caixa_descricao'>
                            <p><span class='formata_atributo'>Nome:</span> O senho dos anéis: A sociedade do anel</p>
                            <p><span class='formata_atributo'>Descrição:</span> Frodo entra em uma jornada para destruir o anel do poder herdado do seu tio Bilbo Bolseiro... </p>
                            <p><span class='formata_atributo'>Preço:</span> 24,50</p>
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
            </section>
        </div>

        <?php require_once('./footer.php')?>

    </body>
</html>