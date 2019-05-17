<?php
//  pegando conexão com o banco
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();
    //variaveis
    $titulo = null;
    $descricao = null;
    $duracao = null;
    $diretor = null;
    $genero = null;
    $distribuidora = null;
    $classificacao = null;
    $imagem = null;
    $cod_filme = null;
    $rsdiretor_filme_mes = null;
    
    $sql = "SELECT filme.titulo_filme, 
            filme.cod_filme, 
            filme.descricao,
            filme.imagem_filme,
            filme.status as status_filme,
            filme.duracao,
            group_concat(genero.genero separator '/') as genero,
            distribuidora.distribuidora,
            classificacao.classificacao
            FROM tbl_filme as filme INNER JOIN tbl_filme_genero as filme_genero
            ON filme_genero.cod_filme = filme.cod_filme INNER JOIN tbl_genero as genero
            ON filme_genero.cod_genero = genero.cod_genero INNER JOIN tbl_ditribuidora as distribuidora
            ON filme.cod_distribuidora = distribuidora.cod_distribuidora INNER JOIN tbl_classificacao as classificacao
            ON filme.cod_classificacao = classificacao.cod_classificacao WHERE filme.status = 1";

    $select = mysqli_query($conexao, $sql);

    if($rsFilmeMes = mysqli_fetch_array($select)){
        $titulo = $rsFilmeMes['titulo_filme'];
        $cod_filme = $rsFilmeMes['cod_filme'];
        $descricao = $rsFilmeMes['descricao'];
        $duracao = $rsFilmeMes['duracao'];
        $genero = $rsFilmeMes['genero'];
        $distribuidora = $rsFilmeMes['distribuidora'];
        $classificacao = $rsFilmeMes['classificacao'];
        $imagem = $rsFilmeMes['imagem_filme'];
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
            <div id="caixa_capa_filme_do_mes" class="center">
                <!-- imagem do filme do mês -->
                <figure>
                    <div id="capa_filme_do_mes" >
                       <img class="img-size" src="./img/ator/Arold/participacoes/<?php echo($imagem);?>" alt="<?php echo($imagem);?>" >
                    </div>
                </figure>
            </div>
            <div id="caixa_informacoes_filme_do_mes" >
                <!-- detalhes do filme do mês -->
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Nome:</span> <?php echo($titulo)?>
                </div>

                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Duração:</span> <?php echo($duracao)?>
                </div>
                <div class="informacoes_filme_do_mes center">
                    <span class="titulo_topico">Diretor:</span>  
                        <?php
                            $sqlDiretor = "SELECT group_concat(diretor.diretor SEPARATOR '/')  as diretor_filme FROM tbl_diretor as diretor
                            INNER JOIN tbl_filme_diretor as filme_diretor
                            ON diretor.cod_diretor = filme_diretor.cod_diretor WHERE filme_diretor.cod_filme =".$cod_filme;
                            $selectDiretor = mysqli_query($conexao, $sqlDiretor);
                            while($rsdiretor_filme_mes = mysqli_fetch_array($selectDiretor)){
                                $diretor = $rsdiretor_filme_mes['diretor_filme'];
                        ?>
                        <?php echo($diretor)?>
                        <?php
                            }
                        ?>
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
                        <p><?php echo(nl2br($descricao))?></p>
                    </div>
                </div>

            </div>
            


        </div>



        <!-- mobile -->

        <div id="caixa_fimel_do_mes_mobile" class="center">
            <div id="caixa_capa_filme_do_mes_mobile" class="center">
                <!-- imagem do filme do mês -->
                <figure>
                    <div id="capa_filme_do_mes_mobile" >
                       <img class="img-size" src="./img/ator/Arold/participacoes/<?php echo($imagem);?>" alt="<?php echo($imagem);?>" >
                    </div>
                </figure>
            </div>
            <div id="caixa_informacoes_filme_do_mes_mobile" class="center">
                <!-- detalhes do filme do mês -->
                <div class="informacoes_filme_do_mes_mobile center">
                    <span class="titulo_topico_mobile">Nome:</span> <?php echo($titulo)?>
                </div>

                <div class="informacoes_filme_do_mes_mobile center">
                    <span class="titulo_topico_mobile">Duração:</span> <?php echo($duracao)?>
                </div>
                <div class="informacoes_filme_do_mes_mobile center">
                    <span class="titulo_topico_mobile">Diretor:</span>  
                        <?php
                            $sqlDiretor = "SELECT group_concat(diretor.diretor SEPARATOR '/')  as diretor_filme FROM tbl_diretor as diretor
                            INNER JOIN tbl_filme_diretor as filme_diretor
                            ON diretor.cod_diretor = filme_diretor.cod_diretor WHERE filme_diretor.cod_filme =".$cod_filme;
                            $selectDiretor = mysqli_query($conexao, $sqlDiretor);
                            while($rsdiretor_filme_mes = mysqli_fetch_array($selectDiretor)){
                                $diretor = $rsdiretor_filme_mes['diretor_filme'] == null ? "": $rsdiretor_filme_mes['diretor_filme'];
                        ?>
                        <?php echo($diretor)?>
                        <?php
                            }
                        ?>
                </div>
                <div class="informacoes_filme_do_mes_mobile center">
                    <span class="titulo_topico_mobile">Gênero:</span> <?php echo($genero)?>
                </div>
                <div class="informacoes_filme_do_mes_mobile center">
                    <span class="titulo_topico_mobile">Distribuidora:</span>  <?php echo($distribuidora)?>
                </div>
                <div class="informacoes_filme_do_mes_mobile center">
                    <span class="titulo_topico_mobile">Classificação:</span> <?php echo($classificacao)?>
                </div>
                <!-- fim detalhes -->
            
            </div>
        </div>
            <!-- caixa com menu retratio -->
        <div id="menu_retratio_filme_do_mes_mobile" class="center">

            <div class="historico_ator_retratio_mobile linha_historico center"> <!-- criando uma div 'linha' para concentrar o conteúdo da div retratio -->
                <a href="#esconde_sinopse_mobile" class="hide" id="esconde_sinopse_mobile"><span class="titulo_topico_mobile">▼ Sinopse</span></a> <!-- a com o link para aparecer o conteúdo -->
                <a href="#aparece_sinopse_mobile" class="show" id="aparece_sinopse_mobile"><span class="titulo_topico_mobile">▲ Sinopse</span></a><!-- a com o link para tirar o conteúdo -->
                <div class="caixa_conteudo_hide"><!--Div que vai ser chamado para aparecer-->
                    <div class="conteudo_topico_mobile"><!--Div criada para onganizar os tópicos corretamente-->
                        <p><?php echo(nl2br($descricao))?></p>
                    </div>
                </div>

            </div>
            


        </div>



        <!-- footer em outra pagina -->
        <?php require_once('./footer.php')?>
    </body>
</html>