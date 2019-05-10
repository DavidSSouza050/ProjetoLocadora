<?php
    //Ativa o recurso de variavel de sessão
    require_once('./usuario_verificado.php');
    //pegando as permissões
    require_once('./util/consultar_permissoes.php');
    //chamando a função para validação
    $permissoes = consultarPermissoes();

if($permissoes['conteudo'] == 0){
    header("Location: index.php");
}
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
    </head>
    <body>
        <!-- div que está segurando tudo -->
        <div id="conteudo_cms" class="center">
            <!-- header que está com o logo e o titulo -->
            <?php require_once('./cms_header.php');?>

            <!-- caixa com o menu e o nome do usuario -->
           <?php require_once('./cms_menu_paginas_usuario.php');?>
        

            <!-- conteudo do menu do cms -->
            <div  id="conteudo_paginas_conteudo">
               
                
                <!-- conteudo do menu do cms -->
                <div id="menu_de_adm">
                    <!-- conteudo editavel -->
                    <div class="conteudo_editavel">
                       <a href="cms_atores.php"> 
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/gerenciar_ator.png" alt="Gerenciar Ator">
                                </div>
                            </figure>
                            
                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR ATOR EM DESTAQUE
                            </div>
                        </a>
                        
                    </div>

                    <div class="conteudo_editavel">
                        <a href="cms_promocao.php">
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/promocoes.png" alt="Gerenciar Promoções">
                                </div>
                            </figure>
                            
                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR PROMOÇÕES
                            </div>
                        </a>
                    </div>

                    <div class="conteudo_editavel">
                        <a href="cms_sobre_empresa.php"> 
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/editar_sobre_empresa.png" alt="Gerenciar Sobre da Empresa">
                                </div>
                            </figure>

                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR SOBRE DA EMPRESA
                            </div>
                        </a>
                    </div>

                    <div class="conteudo_editavel">
                        <a href="cms_lojas.php">
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/lojas.png" alt="Gerenciar Lojas">
                                </div>
                            </figure>
                            
                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR LOJAS
                            </div>
                        </a>
                    </div>

                    <div class="conteudo_editavel">
                        <a href="cms_filme_mes.php">
                            <!-- imagem do conteudo editavel -->
                            <figure>
                                <div class="img_conteudo_editavel">
                                    <img class="img-size" src="./img/gerenciar_filme.png" alt="Gerenciar Filme do mês">
                                </div>
                            </figure>
                            
                            <!-- texto do conteudo editavel -->
                            <div class="mensagem_conteudo_editavel">
                                GERENCIAR FILME DO MÊS
                            </div>
                        </a>
                        
                    </div>
                </div>

            </div>


            <!-- footer do cms -->
           <?php require_once('./cms_footer.php');?>
        </div>


    </body>
</html>
