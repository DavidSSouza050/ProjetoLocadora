
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8" name="format-detection" content="telephone=no"> -->
        <title>Filme do Mês</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        <!-- header em outra pagina -->
        <?php require_once('./header.php')?>

        <div id="caixa_fimel_do_mes" class="center">
            <div id="caixa_capa_filme_do_mes">
                <!-- imagem do filme do mês -->
                <figure>
                    <div id="capa_filme_do_mes" >
                       <img class="img-size" style="border-radius: 20px;" src="./img/wifi_raph_capa.jpg" alt="Filme Do Mês" title="Filme Do Mês">
                    </div>
                </figure>
            </div>
            <div id="caixa_informacoes_filme_do_mes">
                <!-- detalhes do filme do mês -->
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Nome:</span> Wifi Ralph: Quebrando a Internet
                </div>

                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Duração:</span> 113 min
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Diretor:</span>  Phil Johnston, Rich Moore
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Gênero:</span> Animação 
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Distribuidora:</span>  Walt Disney
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Classificação:</span> Livre
                </div>
                <!-- fim detalhes -->
            
            </div>
        </div>
            <!-- caixa com menu retratio -->
        <div id="menu_retratio_filme_do_mes" class="center">

            <div class="historico_ator_retratio linha_historico center"> <!-- criando uma div 'linha' para concentrar o conteúdo da div retratio -->
                <a href="#esconde_sinopse" class="hide" id="esconde_sinopse"><span class="titulo_topico">▼ Sinopse</span></a> <!-- a com o link para aparecer o conteúdo -->
                <a href="#aparece_sinopse" class="show" id="aparece_sinopse"><span class="titulo_topico">▲ Sinopse</span></a><!-- a com o link para tirar o conteúdo -->
                <div class="caixa_conteudo_hide"><!--Div que vai ser chamado para aparecer-->
                    <div class="conteudo_topico"><!--Div criada para onganizar os tópicos corretamente-->
                        <p>Ralph, o mais famoso vilão dos videogames, e Vanellope, sua companheira atrapalhada, iniciam mais uma arriscada aventura. Após a gloriosa vitória no Fliperama Litwak, a dupla viaja para o universo expansivo e desconhecido da internet. Dessa vez, a missão é achar uma peça reserva para salvar o videogame Corrida Doce, de Vanellope. Para isso, eles contam com a ajuda dos "cidadãos da Internet" e de Yess, a alma por trás do "Buzzztube", um famoso website que dita tendências. Classificação LIVRE, contém violência fantasiosa.</p>
                    </div>
                </div>

            </div>
            


        </div>

        <!-- footer em outra pagina -->
        <?php require_once('./footer.php')?>
    </body>
</html>