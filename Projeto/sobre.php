<?php
    // entrando No banco
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();

    $sql = "SELECT * FROM tbl_sobre";
    $select = mysqli_query($conexao, $sql);
    while($rsSobre = mysqli_fetch_array($select)){
        if($rsSobre['status'] == 1){
            $titulo_sobre = $rsSobre['titulo_sobre'];
            $texto_sobre = $rsSobre['texto_sobre'];
            $nome_imagem_sobre = $rsSobre['imagem_sobre'];
        }
    }
?>

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
                    <?php echo($titulo_sobre);?>
                </div>
                <div id="caixa_texto_quemSomos">
                    <div id="texto_quemSomos" class="scrollTexto">
                        <?php echo($texto_sobre);?>
                    </div>
                </div>
                <figure>
                    <div id="imagem_quemSomos">
                       <img id="lojaAntiga" class="img-size" src="./cms/img/imagem_sobre/<?php echo($nome_imagem_sobre) ?>" alt="<?php echo($nome_imagem_sobre) ?>"> 
                    </div>
                </figure>
            </div>

        </div>
        <!-- footer em outra pagina -->
        <?php require_once('./footer.php'); ?>
    </body>
</html>