<?php
    //banco
    require_once('./db/conexao.php');
    $conexao = conexaoMysql();

    $sql =  "SELECT * FROM tbl_ator";
    $select = mysqli_query($conexao, $sql);

    $data = date('Y');

    while($rsAtor = mysqli_fetch_array($select)){    
        // pegando o ator ativo
        if($rsAtor['status'] == 1){
            // pegando tudo do ator
            $cod_ator = $rsAtor['cod_ator'];
            $nome = $rsAtor['nome_ator'];
            $atividade = $rsAtor['atividade'];
            $nascionalidade = $rsAtor['nascionalidade'];
            $data_naci = explode("-", $rsAtor['data_nacimento']);
            $data_naci_certo = $data_naci[2]."/".$data_naci[1]."/".$data_naci[0];
            $idade =  $data - $data_naci[0];
            $imagem_ator = $rsAtor['imagem_ator'];
            $bio = $rsAtor['biografia'];
        }
        
    }    


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Atores em Destaque</title>
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
                    <img class="img-size" style="border-radius: 20px;" src="./cms/img/imagem_ator/<?php echo($imagem_ator)?>" alt="Foto do ator" title="foto do ator"> 
                </div>
            </figure>
        </div>
        <div id="caixa_historico_ator">
            <!-- detalhes do ator do mês -->
            <div class="historico_ator center">
                <span class="titulo_topico">Nome:</span> <?php echo($nome);?>
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Atividade:</span> <?php echo($atividade);?>
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Nacionalidade:</span>  <?php echo($nascionalidade);?>
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Nascimento:</span> <?php echo($data_naci_certo);?>
            </div>

            <div class="historico_ator center">
                <span class="titulo_topico">Idade:</span> <?php echo($idade);?> Anos
            </div>
           
           <!-- fim do detalhes -->

        </div>
       
    </div>
 
    <!-- DIV COM MENU RETRATIO -->
    <div id="caixa_retratio_ator" class="center">

        <div class="historico_ator_retratio linha_historico center">
            <a href="#saivida" class="hide" id="saivida"><span class="titulo_topico">▼ Biografia</span></a>
            <a href="#entravida" class="show" id="entravida"><span class="titulo_topico">▲ Biografia</span></a>
            <div class="caixa_conteudo_hide">
                <div class="conteudo_topico">
                    <?php echo($bio)?>
                </div>

            </div>

        </div>

        <div class="historico_ator_retratio linha_historico center">
            <a href="#saiFoto" class="hide" id="saiFoto"><span class="titulo_topico">▼ Participações</span></a>
            <a href="#entrafoto" class="show" id="entrafoto"><span class="titulo_topico">▲ Participações</span></a>
            <div class="caixa_conteudo_hide">
                <div class="filme_participado">
                    <!-- pegando a imagem de participações dos filmes desse ator -->
                    <?php 
          
                        $sql = "SELECT filme.cod_filme,
                                filme.imagem_filme,
                                filme_ator.cod_ator
                                FROM tbl_filme AS filme INNER JOIN tbl_filme_ator AS filme_ator
                                ON filme.cod_filme = filme_ator.cod_filme INNER JOIN tbl_ator AS ator
                                ON ator.cod_ator = filme_ator.cod_ator WHERE filme_ator.cod_ator =".$cod_ator; 

                    if($select = mysqli_query($conexao, $sql)){
                        while($rsImagem_filme = mysqli_fetch_array($select)){
                    ?>

                    <figure> 
                        <div class="filmes_participados">
                            <img class="img-size border-radius-img" src="./img/ator/Arold/participacoes/<?php echo($rsImagem_filme['imagem_filme'])?>" alt="<?php echo($rsImagem_filme['imagem_filme'])?>" title="<?php echo($rsImagem_filme['imagem_filme'])?>">
                        </div>
                    </figure>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            
        </div>

    </div>



    <!-- footer em outra pagina -->
    <?php require_once('./footer.php')?>
</body>
</html>