<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"  name="format-detection" content="telephone=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Atores em Destaque</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
<body>
    <!-- header em outra pagina -->
    <?php require_once('./header.php')?>


    <div id="caixa_atores" class="center">
        <!-- foto do ator -->
        <div id="caixa_imagem_ator">
            <figure>
                <div id="imagem_ator" class="center">
                    <img class="img-size" style="border-radius: 20px;" src="./img/ator/Arold/Arnold_Schwarzenegger.jpg" alt="Foto do ator" title="foto do ator"> 
                </div>
            </figure>
        </div>
        <div id="caixa_historico_ator">
            <!-- detalhes do ator do mês -->
            <div class="historico_ator center">
                <span class="titulo_topico">Nome:</span> Arnold Alois Schwarzenegger
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Atividade:</span> fisiculturista, ator, empresário e político.
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Nacionalidade:</span>  Austríaco, Americano
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Nascimento:</span> 30 de julho de 1947 (Graz, Thal, Styria, Áustria)
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Idade:</span> 72 Anos
            </div>
           
           

        </div>
       
    </div>
 
    <!-- DIV COM MENU RETRATIO -->
    <div id="caixa_retratio_ator" class="center">

        <div class="historico_ator_retratio linha_historico center">
            <a href="#saivida" class="hide" id="saivida"><span class="titulo_topico">▼ Biografia</span></a>
            <a href="#entravida" class="show" id="entravida"><span class="titulo_topico">▲ Biografia</span></a>
            <div class="caixa_conteudo_hide">
                <div class="conteudo_topico">
                    <p>- É uma grande celebridade na Áustria.  Um dos maiores estádios de futebol do país tem o seu nome;</p>
                    <p>- Descrito pelo Guiness como "o homem com o desenvolvimento mais perfeito na história do mundo";</p>    
                    <p>- Foi eleito Governador da California em 2003; </p>
                    <p>- Possui uma estrela na Calçada da Fama, localizada em 6764 Hollywood Boulevard.</p>                
                </div>

            </div>

        </div>

        <div class="historico_ator_retratio linha_historico center">
            <a href="#saiFoto" class="hide" id="saiFoto"><span class="titulo_topico">▼ Principais Participações</span></a>
            <a href="#entrafoto" class="show" id="entrafoto"><span class="titulo_topico">▲ Principais Participações</span></a>
            <div class="caixa_conteudo_hide">
                <div class="filme_participado">

                    <figure> 
                        <div class="filmes_participados">
                            <img class="img-size border-radius-img" src="./img/ator/Arold/participacoes/esterminador_do_futuro.png" alt="Exterminador do Futoro 1 de 1985" title="Exterminador do Futoro 1 de 1985">
                        </div>
                    </figure>
                   
                    <figure> 
                        <div class="filmes_participados">
                            <img class="img-size border-radius-img" src="./img/ator/Arold/participacoes/exterminador_do_futuro_2.jpg" alt="Exterminador do Futoro 1 de 1985" title="Exterminador do Futoro 2 de 1991">
                        </div>
                    </figure>

                    <figure> 
                        <div class="filmes_participados">
                            <img class="img-size border-radius-img" src="./img/ator/Arold/participacoes/o_predador.jpg" alt="O Predador de 1985" title="O Predador de 1987">
                        </div>
                    </figure>

                   
    

                </div>
            </div>
            
        </div>

    </div>



    <!-- footer em outra pagina -->
    <?php require_once('./footer.php')?>
</body>
</html>