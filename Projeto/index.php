<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Locadora Acme Tunes</title>
        <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.jpg" type="image/x-png">
    </head>
    <body>
        <header>
            <div id="conteudo_header" class="center">
                <div id="logo" >
                    <figure>
                        <a href="index.php" class="alinhafigura">
                            <img class="img-size" src="./img/Ben-10.png">
                        </a>                    
                    </figure>
                </div>
                <nav id="menu">
                    <ul>
                        <li>
                            <a href="">
                                Atores
                            </a>
                        </li>
                        <li>
                             <a href="">
                                Sobre
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Promoções
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Nossas Lojas
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Filme do Mês
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Fale Conosco
                            </a>
                        </li>
                    </ul>
                </nav>
                <form name="frm_cadastro">
                    <div id="login">
                        <div id="login_usuario">
                            <h3>Usuario:</h3>
                            <input class="caixaTexto" type="text" name="txt_login_usuario">
                        </div>
                        <div id="login_senha">
                            <h3>Senha:</h3>
                            <input class="caixaTexto" type="password" name="txt_login_senha">
                            <input type="submit" id="botao_usuario" name="btn_confirmar" value="OK">
                        </div>
                    </div>
                </form>
            </div>
        </header>
        <div id="segura_conteudo">

        </div>

        <div id="slider" class="center">
            <!-- slider -->
            <?php include("with-jquery.html"); ?>

            <div class="caixa_rede_social">
                <div class="rede_social">
                    <figure  class="border-img">
                        <img  class="border-img" src="img/facebook.png">
                    </figure>
                </div>
                <div class="rede_social">
                    <figure  class="border-img">
                            <img class="border-img" src="img/pinterest.png">
                    </figure>
                </div>
                <div class="rede_social">
                    <figure  class="border-img">
                            <img class="border-img" src="img/instagram.png">
                    </figure>
                </div>
            </div>
        </div>
            

        <div id="conteudo" class="center">
            <!-- aqui começa a sessação dos filmes  -->
            <section id="item_conteudo">
                <div id="caixa_item">
                    <nav id="menu_item">
                        <ul>
                            <li>ITEM1</li>
                            <li>ITEM2</li>

                        </ul>
                    </nav>  
                </div>
                <div id="caixa_produto">

                    <?php

                        for($i = 0; $i <= 15 ;$i++){
                            echo("
                                    <div class='produto'>
                                        <div class='produto_caixa_imagem'>
                                            <div class='produto_imagem center'>
                                                <figure>
                                                    <img class='img-size' src='img/senhorDosAneisASociedade.jpg' alt='O Senhor Dos Anéis: A Sociedade Do Anel' title='O Senhor Dos Anéis: A Sociedade Do Anel'>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class='produto_caixa_descricao'>
                                            <p><span class='formata_atributo'>Nome:</span> O senho dos anéis: A sociedade do anel</p>
                                            <p><span class='formata_atributo'>Descrição:</span> Frodo entra em uma jornada para destruir o anel do poder herdado do seu tio Bilbo Bolseiro... </p>
                                            <p><span class='formata_atributo'>Preço:</span> 24,50</p>
                                        </div>
                                        <div class='produto_caixa_detalhes'>
                                            <div class='botao_detalhes formata_atributo'>
                                                Detalhes
                                            </div>
                                        </div>
                                    </div>
                            ");
                        }
                    
                    ?>                    

                </div>  
            </section>
        </div>
        
        <footer class="center">

        </footer>

    </body>
</html>