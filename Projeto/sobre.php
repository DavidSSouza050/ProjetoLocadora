<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8" name="format-detection" content="telephone=no"> -->
        <title>Sobre nós</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/styleFonte.css" />
        <link rel="shortcut icon" href="img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        <!-- header em otra agina -->
        <?php require_once('./header.php');?>

        <div id="conteudo_sobre" class="center"> 
            <!-- div quem somos  contando a história da locadora-->
            <div id="quemSomos_sobre">
                <div id="titulo_sobre">
                    Quem Somos?
                </div>
                <div id="caixa_texto_quemSomos">
                    <div id="texto_quemSomos" class="scrollTexto">
                       Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
                       Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração eletrônica, permanecendo essencialmente inalterado.
                    </div>
                </div>
                <figure>
                    <div id="imagem_quemSomos">
                       <img id="lojaAntiga" class="img-size" src="./img/LojasAcime/imagemQuemSomos.jpg" alt="Uma das primeiras lojas"> 
                    </div>
                </figure>
            </div>

        </div>
        <!-- footer em outra pagina -->
        <?php require_once('./footer.php'); ?>
    </body>
</html>