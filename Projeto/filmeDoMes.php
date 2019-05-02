<?php
//  pegando conexão com o banco
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();

    $sql = "SELECT filme.titulo_filme, 
            filme.descricao,
            filme.imagem_filme,
            filme.status,
            filme.duracao,
            diretor.diretor,
            group_concat(genero.genero separator '/') as genero,
            distribuidora.distribuidora,
            classificacao.classificacao
            FROM tbl_filme as filme INNER JOIN tbl_filme_diretor AS filme_diretor
            ON filme.cod_filme = filme_diretor.cod_filme INNER JOIN tbl_diretor as diretor
            ON filme_diretor.cod_diretor = diretor.cod_diretor INNER JOIN tbl_filme_genero as filme_genero
            ON filme_genero.cod_filme = filme.cod_filme INNER JOIN tbl_genero as genero
            ON filme_genero.cod_genero = genero.cod_genero INNER JOIN tbl_ditribuidora as distribuidora
            ON filme.cod_distribuidora = distribuidora.cod_distribuidora INNER JOIN tbl_classificacao as classificacao
            ON filme.cod_classificacao = classificacao.cod_classificacao group by filme.cod_filme; ";

    $select = mysqli_query($conexao, $sql);

    while($rsFilmeMes = mysqli_fetch_array($select)){
        if($rsFilmeMes['status'] == 1){
            $titulo = $rsFilmeMes['titulo_filme'];
            $descricao = $rsFilmeMes['descricao'];
            $duracao = $rsFilmeMes['duracao'];
            $diretor = $rsFilmeMes['diretor'];
            $genero = $rsFilmeMes['genero'];
            $distribuidora = $rsFilmeMes['distribuidora'];
            $classificacao = $rsFilmeMes['classificacao'];
            $imagem = $rsFilmeMes['imagem_filme'];
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
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
                       <img class="img-size" style="border-radius: 20px;" src="./img/ator/Arold/participacoes/<?php echo($imagem);?>" alt="Filme Do Mês" title="Filme Do Mês">
                    </div>
                </figure>
            </div>
            <div id="caixa_informacoes_filme_do_mes">
                <!-- detalhes do filme do mês -->
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Nome:</span> <?php echo($titulo)?>
                </div>

                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Duração:</span> <?php echo($duracao)?>
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Diretor:</span>  <?php echo($diretor)?>
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Gênero:</span> <?php echo($genero)?>
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Distribuidora:</span>  <?php echo($distribuidora)?>
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Classificação:</span> <?php echo($classificacao)?>
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
                        <p><?php echo($descricao)?></p>
                    </div>
                </div>

            </div>
            


        </div>

        <!-- footer em outra pagina -->
        <?php require_once('./footer.php')?>
    </body>
</html>