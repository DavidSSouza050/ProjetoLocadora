<?php
    //banco
    require_once('../db/conexao.php');
    $conexao = conexaoMysql();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>CMS - SISTEMA DE GERENCIAMENTO DO SITE</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./css/styleCms.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../css/styleFonte.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
        <link rel="shortcut icon" href="../img/iconeDeAbaACME.png" type="image/x-png">
        <script src="../js/jquery-1.11.3.min.js"></script>
        <script>

//             ativando e desativando filme
            function ativarDesativar(pagina, status, codigo){
                $.ajax({
                    type:'GET',
                    url: "./util/ativar_desativar.php",
                    data:{pagina:pagina, status:status, codigo:codigo},
                    complete: function(response){
                        location.reload();
                    },
                })
            }

        
        </script>

    </head>
    <body>
        <!-- cnotender da modal que vai abrir para mostrar o cliente por completo -->
        <div id="conteiner">
            <!-- div com o objetivo de fechar a modal -->
            <div id="segurar_fechar_modal" class="center">
                <figure>
                    <div id="fechar_modal">
                        <a href="#" class="img-size" id="fachar_modal_fale_conosco">
                            <img   class="img-size" src="./img/icone_sair.png" alt="sair da modal" title="sair da modal">
                        </a>
                    </div>
                </figure>
            </div>
            <!-- modal que vai suportar tudo o conteudo -->
            <div id="modal_larga" class="center">
                
            </div>
        </div>

        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
            
        
           
            <!-- conteudo do menu do cms -->
            <div id="conteudo_paginas_conteudo">

                <div id="segura_pagina_filme_mes">

                <!-- //fazendo o select para pegar todas os filmes e suas informações necessarias -->
                    <?php
                    //fazendo o select para pegar todas os filmes e suas informações necessarias
                        $sql = "SELECT filme.titulo_filme as titulo,
                        filme.cod_filme as cod_filme,
                        filme.duracao as duracao,
                        filme.status as status,
                        diretor.diretor as diretor,
                        group_concat(genero.genero SEPARATOR '/') as generos_filme,
                        filme.imagem_filme as imagem_filme,
                        distribuidora.distribuidora as distribuidora
                        FROM tbl_filme as filme INNER JOIN tbl_filme_diretor as filme_diretor
                        ON filme.cod_filme = filme_diretor.cod_filme INNER JOIN tbl_diretor as diretor
                        ON filme_diretor.cod_diretor = diretor.cod_diretor INNER JOIN tbl_filme_genero as filme_genero
                        ON filme.cod_filme = filme_genero.cod_filme INNER JOIN tbl_genero as genero
                        ON filme_genero.cod_genero =  genero.cod_genero INNER JOIN	tbl_ditribuidora as distribuidora
                        ON distribuidora.cod_distribuidora = filme.cod_distribuidora GROUP BY filme.cod_filme; ";
                        $select = mysqli_query($conexao, $sql);
                        while($rsFilme_mes = mysqli_fetch_array($select)){
                    ?>

                <!-- card e vai mostrar os filmes cadastrados -->
                    <div class="card_filme_mes center">
                        <figure>
                            <div class="img_filme_mes">
                                <img src="../img/ator/Arold/participacoes/<?php echo($rsFilme_mes['imagem_filme'])?>" class="img-size" alt="gerenciar ator">
                            </div>
                        </figure>
                        <!-- div que vai segurar os atributos da filme -->
                        <div class="atributos_filme_mes">
                            <!-- div com o titulo do filme -->
                            <div class="titulo_filme_mes center">
                                <?php echo($rsFilme_mes['titulo'])?>
                            </div>
                            <!-- divs que estarão o diretor, genero, classificacao e distribuidora -->
                            <div class="segura_atributos_filme">
                                <div class="atributos_filme">
                                    Diretor: <?php echo($rsFilme_mes['diretor'])?>
                                </div>
                                <div class="atributos_filme">
                                    Duração: <?php echo($rsFilme_mes['duracao'])?>
                                </div>
                            </div>
                            <div class="segura_atributos_filme">
                                <div class="atributos_filme">
                                    Gênero: <?php echo($rsFilme_mes['generos_filme'])?>
                                </div>
                                <div class="atributos_filme">
                                    Distribuidora: <?php echo($rsFilme_mes['distribuidora'])?>
                                </div>
                            </div>
                            <?php
                                $img = $rsFilme_mes['status'] == 0 ? 'icon_nao_ativo.png' : 'icon_ativo.png';
                                $altEtitle = $rsFilme_mes['status'] == 0 ? 'Não ativo' : 'Ativo';
                            ?>
                            <figure>
                                <div class="ativar_desativar_filme_mes">
                                    <img src="./img/<?php echo($img)?>" onclick="ativarDesativar('filme_mes', <?php echo($rsFilme_mes['status'])?>,<?php echo($rsFilme_mes['cod_filme'])?>)" class="img-size border-radius-img icon iconSemMargin" alt="<?php echo($altEtitle)?>" title="<?php echo($altEtitle)?>">
                                </div>
                            </figure>
                            
                        </div>

                    </div>



    
               
                <?php
                    }
                ?>
                </div>
            </div>






            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>

            
    </body>
</html>