<?php
    require_once('../db/conexao.php');
    $conexao =  conexaoMysql();
    //formatando o preco
    require_once('../cms/util/formatar_preco.php');
    $cod_produto = $_GET['codigo'];

    $sql = "SELECT filme.titulo_filme, 
                    filme.cod_filme, 
                    filme.descricao,
                    filme.imagem_filme,
                    filme.status as status_filme,
                    filme.duracao,
                    filme.preco_filme,
                    group_concat(genero.genero separator '/') as genero,
                    distribuidora.distribuidora,
                    classificacao.classificacao
                    FROM tbl_filme as filme INNER JOIN tbl_filme_genero as filme_genero
                    ON filme_genero.cod_filme = filme.cod_filme INNER JOIN tbl_genero as genero
                    ON filme_genero.cod_genero = genero.cod_genero INNER JOIN tbl_ditribuidora as distribuidora
                    ON filme.cod_distribuidora = distribuidora.cod_distribuidora INNER JOIN tbl_classificacao as classificacao
                    ON filme.cod_classificacao = classificacao.cod_classificacao WHERE filme.cod_filme =".$cod_produto;
    $select = mysqli_query($conexao,$sql);
    if($rsProduto = mysqli_fetch_array($select)){
        $titulo_filme = $rsProduto['titulo_filme'];
        $cod_filme = $rsProduto['cod_filme'];
        $descricao = $rsProduto['descricao'];
        $imagem_filme = $rsProduto['imagem_filme'];
        $duracao = $rsProduto['duracao'];
        $genero = $rsProduto['genero'];
        $distribuidora = $rsProduto['distribuidora'];
        $classificacao = $rsProduto['classificacao'];
        $preco_filme = $rsProduto['preco_filme'];
    }
?>

<div id="card_produto">
    <div id="caixa_imagem_produto">
        <figure>
            <div id="imagem_produto" class="center">
                <img src="./img/ator/Arold/participacoes/<?php echo($imagem_filme) ?>" class="img-size" alt="não tem">
            </div>
        </figure>   
    </div>
    <div id="caixa_especificacao_produto">
        <div class="especificacao center">
            <span class="titulo_topico">Nome:</span> <?php echo($titulo_filme)?>
        </div>
        <div class="especificacao center">
            <span class="titulo_topico">Duração:</span> <?php echo($duracao)?>
        </div>
        <div class="especificacao center">
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
        <div class="especificacao center">
            <span class="titulo_topico">Gênero:</span> <?php echo($genero)?>
        </div>
        <div class="especificacao center">
            <span class="titulo_topico">Distribuidora:</span>  <?php echo($distribuidora)?>
        </div>
        <div class="especificacao center">
            <span class="titulo_topico">Classificação:</span>  <?php echo($classificacao)?>
        </div>
        <div class="especificacao center">
            <span class="titulo_topico">Preço:</span> 
            <?php
                $preco = colocar_virgula($preco_filme);
                echo($preco);
            ?>
        </div>
    </div>

    
    <div id="sinopse_modal">
        <div id="sinopse_filme_retratio" class="linha_historico center"> <!-- criando uma div 'linha' para concentrar o conteúdo da div retratio -->
            <a href="#esconde_sinopse_filme" class="hide" id="esconde_sinopse_filme"><span class="titulo_topico">▼ Sinopse</span></a> <!-- a com o link para aparecer o conteúdo -->
            <a href="#aparece_sinopse_filme" class="show" id="aparece_sinopse_filme"><span class="titulo_topico">▲ Sinopse</span></a><!-- a com o link para tirar o conteúdo -->
            <div class="caixa_conteudo_hide"><!--Div que vai ser chamado para aparecer-->
                <div class="conteudo_topico"><!--Div criada para onganizar os tópicos corretamente-->
                    <p><?php echo(nl2br($descricao))?></p>
                </div>
            </div>

        </div> 
    </div>
  

</div>