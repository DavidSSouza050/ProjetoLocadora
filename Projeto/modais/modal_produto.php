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
<script src="js/jquery-1.11.3.min.js"></script>
<script>
    //abrindo a modal
    $(document).ready(function(){
        $(document).ready(function(){
        $('#fechar_modal_produto').click(function(){
            $('#conteiner_produto').fadeOut(300);
        });
    });

    });
</script>
<div id="card_produto">
    <!-- div com o objetivo de fechar a modal -->

    <figure>
        <div id="fechar_modal_produto">
            <a href="#" class="img-size" id="fachar_modal_produto">
                <img class="img-size" src="./cms/img/icone_sair.png" alt="sair da modal" title="sair da modal">
            </a>
        </div>
    </figure>

    <div id="caixa_imagem_produto">
        <figure>
            <div id="imagem_produto" class="center">
                <img src="./cms/img/imagem_filme/<?php echo($imagem_filme) ?>" class="img-size" alt="não tem">
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
       <div id="titulo_sinopse">
           Sinopse
       </div>
        <div id="texto_sinopse" class="scrollTexto">
            <?php echo(nl2br($descricao))?>
        </div>
            
    </div>
  

</div>