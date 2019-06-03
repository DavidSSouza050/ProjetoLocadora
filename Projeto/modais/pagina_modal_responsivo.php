<?php
    require_once('../db/conexao.php');
    $conexao =  conexaoMysql();
    //formatando o preco
    require_once('../cms/util/formatar_preco.php');
    $cod_produto = $_GET['codigo'];
    $modo = $_GET['modo'];

    if($modo == 'normal'){
        $sql = "SELECT filme.titulo_filme, 
        filme.cod_filme, 
        filme.descricao,
        filme.imagem_filme,
        filme.status_produto as status_filme,
        filme.duracao,
        filme.preco_filme,
        group_concat(genero.genero separator '/') as genero,
        distribuidora.distribuidora,
        classificacao.classificacao
        FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero
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
    }elseif($modo == 'promocao'){
        $sql = "SELECT filme.titulo_filme, 
        filme.cod_filme, 
        filme.descricao,
        filme.imagem_filme,
        filme.status_produto as status_filme,
        filme.duracao,
        filme.preco_filme,
        promocao.porcentagem_desconto as desconto,
        group_concat(genero.genero separator '/') as genero,
        distribuidora.distribuidora,
        classificacao.classificacao
        FROM tbl_filme as filme INNER JOIN tbl_filme_genero_categoria as filme_genero
        ON filme_genero.cod_filme = filme.cod_filme INNER JOIN tbl_genero as genero
        ON filme_genero.cod_genero = genero.cod_genero INNER JOIN tbl_ditribuidora as distribuidora
        ON filme.cod_distribuidora = distribuidora.cod_distribuidora INNER JOIN tbl_classificacao as classificacao
        ON filme.cod_classificacao = classificacao.cod_classificacao INNER JOIN tbl_promocao as promocao
        ON filme.cod_filme = promocao.cod_filme
        WHERE filme.cod_filme =".$cod_produto;
        $select = mysqli_query($conexao,$sql);
        if($rsProduto = mysqli_fetch_array($select)){
            $titulo_filme = $rsProduto['titulo_filme'];
            $cod_filme = $rsProduto['cod_filme'];
            $descricao = $rsProduto['descricao'];
            $imagem_filme = $rsProduto['imagem_filme'];
            $desconto = $rsProduto['desconto'];
            $duracao = $rsProduto['duracao'];
            $genero = $rsProduto['genero'];
            $distribuidora = $rsProduto['distribuidora'];
            $classificacao = $rsProduto['classificacao'];
            $preco_filme = $rsProduto['preco_filme'];
        }
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Nossas Lojas</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleFonte.css" />
        <link rel="shortcut icon" href="../img/iconeDeAbaACME.png" type="image/x-png">
    </head>
    <body>
        
        

        <div id="card_produto">
            <!-- div com o objetivo de fechar a modal -->

            <figure>
                <?php $pagina = $modo == 'normal' ? 'index.php' : 'promocoes.php' ?>
                <a href="../<?= $pagina ?>" class="img-size" id="fechar_modal_produto">
                    <div id="fechar_modal_produto">        
                        <img class="img-size" src="../cms/img/icone_sair.png" alt="sair da modal" title="sair da modal">
                    </div>
                </a>
            </figure>

            <div id="caixa_imagem_produto">
                <figure>
                    <div id="imagem_produto" class="center">
                        <img src="../cms/img/imagem_filme/<?php echo($imagem_filme) ?>" class="img-size" alt="não tem">
                    </div>
                </figure>   
            </div>
            <div id="caixa_especificacao_produto">
                <div class="especificacao center">
                    <span class="titulo_topico_mobile">Nome:</span> <?php echo($titulo_filme)?>
                </div>
                <div class="especificacao center">
                    <span class="titulo_topico_mobile">Duração:</span> <?php echo($duracao)?>
                </div>
                <div class="especificacao center">
                    <span class="titulo_topico_mobile">Diretor:</span>
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
                    <span class="titulo_topico_mobile">Gênero:</span> <?php echo($genero)?>
                </div>
                <div class="especificacao center">
                    <span class="titulo_topico_mobile">Distribuidora:</span>  <?php echo($distribuidora)?>
                </div>
                <div class="especificacao center">
                    <span class="titulo_topico_mobile">Classificação:</span>  <?php echo($classificacao)?>
                </div>
                <div class="especificacao center">
                    <span class="titulo_topico_mobile">Preço:</span> 
                    <?php
                        if($modo == 'normal'){
                            $preco = colocar_virgula($preco_filme);
                            echo($preco);
                        }else{
                            $preco = colocar_virgula($preco_filme);
                            $preco_promocao = calcular_preco($desconto, $preco_filme);
                    ?>
                    De: <del><?php echo $preco; ?></del>
                    Por: <?php echo $preco_promocao; ?>
                    <?php
                        }
                    ?>
                </div>
            </div>

            
            <div id="sinopse_modal">
            <div id="titulo_sinopse">
                Sinopse
            </div>
                <div id="texto_sinopse" class="scrollTexto">
                    <?php echo(nl2br($descricao))?>
                </div>
                    
            </div>
        


        
    </body>

</html>